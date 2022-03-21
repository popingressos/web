<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

if(trim($_GET['tbLocalS'])=="") {
	$tbLocal = "";
} else {
	$tbLocal = $_GET['tbLocalS'];
}

if(trim($_GET['modS'])=="") {
	$mod = $mod;
} else {
	$mod = $_GET['modS'];
}

$com_sessao = "sim";

if($com_sessao=="sim") {
	
	if(trim($_SESSION["".$chave_set."_".$mod."buscaSearchS"])=="") { 
		if(trim($_GET['buscaS'])=="") { 
			$buscaGet = "";
		} else {
			$_SESSION["".$chave_set."_".$mod."buscaSearchS"] = $_GET['buscaS'];
			$buscaGet = $_SESSION["".$chave_set."_".$mod."buscaSearchS"];
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."buscaSearchS"] = $_SESSION["".$chave_set."_".$mod."buscaSearchS"];
		$buscaGet = $_SESSION["".$chave_set."_".$mod."buscaSearchS"];
	}

	if(trim($_GET['pageS'])=="") { 
		if(trim($_SESSION["".$chave_set."_".$mod."pageSessS"])=="") {
			$_SESSION["".$chave_set."_".$mod."pageSessS"] = "1";
		} else {
			$_SESSION["".$chave_set."_".$mod."pageSessS"] = $_SESSION["".$chave_set."_".$mod."pageSessS"];
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."pageSessS"] = $_GET['pageS'];
	}

	if(trim($_REQUEST['var3'])=="pagina") {
		$_SESSION["".$chave_set."_".$mod."pageSessS"] = $_REQUEST['var4'];
	} else {
		$_SESSION["".$chave_set."_".$mod."pageSessS"] = $_SESSION["".$chave_set."_".$mod."pageSessS"];
	}
	
	$page = $_SESSION["".$chave_set."_".$mod."pageSessS"];

	if(trim($_GET['ids_selecionadosS'])=="") { 
		if(trim($_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"])=="") {
			$_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"] = "";
		} else {
			$_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"] = $_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"];
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"] = $_GET['ids_selecionadosS'];
	}

} else {

	if(trim($_GET['buscaS'])=="") { 
		unset($_COOKIE["pageSessS"]);
		unset($_SESSION["".$chave_set."_".$mod."buscaSearchS"]);
		$buscaGet = "";
	} else {
		$buscaGet = $_GET['buscaS'];
		$_SESSION["".$chave_set."_".$mod."buscaSearchS"] = $buscaGet;
	}
	
	$_SESSION["".$chave_set."_".$mod."modulo_atualS"] = $mod;
}

if(trim($buscaGet)=="") { } else {
	$where = busca_item_lista("".$buscaGet."",$mod);
}

if(trim($_GET['limpaS'])=="SIM") {
	unset($_SESSION["".$chave_set."_".$mod."nomeS"]);
	unset($_SESSION["".$chave_set."_".$mod."acaoS"]);
	unset($_SESSION["".$chave_set."_".$mod."localS"]);
	unset($_SESSION["".$chave_set."_".$mod."detalheS"]);
	unset($_SESSION["".$chave_set."_".$mod."data_deS"]);
	unset($_SESSION["".$chave_set."_".$mod."data_ateS"]);
} else {

	if(trim($_GET['nomeS'])=="") {
		if(trim($_SESSION["".$chave_set."_".$mod."modulo_atualS"])=="".$mod."") { } else {
			unset($_SESSION["".$chave_set."_".$mod."nomeS"]);
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."nomeS"] = $_GET['nomeS'];
	}

	if(trim($_SESSION[''.$chave_set.'_'.$mod.'nomeS'])=="") {
		$filtro1 = "";
	} else {
		$filtro1 = " AND mod_sysusu.nome LIKE '%".$_SESSION[''.$chave_set.'_'.$mod.'nomeS']."%' ";
	}

	if(trim($_GET['acaoS'])=="") {
		if(trim($_SESSION["".$chave_set."_".$mod."modulo_atualS"])=="".$mod."") { } else {
			unset($_SESSION["".$chave_set."_".$mod."acaoS"]);
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."acaoS"] = $_GET['acaoS'];
	}

	if(trim($_SESSION[''.$chave_set.'_'.$mod.'acaoS'])=="") {
		$filtro2 = "";
	} else {
		$filtro2 = " AND mod_syslog.acao LIKE '%".$_SESSION[''.$chave_set.'_'.$mod.'acaoS']."%' ";
	}

	if(trim($_GET['localS'])=="") {
		if(trim($_SESSION["".$chave_set."_".$mod."modulo_atualS"])=="".$mod."") { } else {
			unset($_SESSION["".$chave_set."_".$mod."localS"]);
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."localS"] = $_GET['localS'];
	}

	if(trim($_SESSION[''.$chave_set.'_'.$mod.'localS'])=="") {
		$filtro3 = "";
	} else {
		$filtro3 = " AND mod_syslog.local LIKE '%".$_SESSION[''.$chave_set.'_'.$mod.'localS']."%' ";
	}

	if(trim($_GET['detalheS'])=="") {
		if(trim($_SESSION["".$chave_set."_".$mod."modulo_atualS"])=="".$mod."") { } else {
			unset($_SESSION["".$chave_set."_".$mod."detalheS"]);
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."detalheS"] = $_GET['detalheS'];
	}

	if(trim($_SESSION[''.$chave_set.'_'.$mod.'detalheS'])=="") {
		$filtro4 = "";
	} else {
		$filtro4 = " AND mod_syslog.detalhe LIKE '%".$_SESSION[''.$chave_set.'_'.$mod.'detalheS']."%' ";
	}

	if(trim($_GET['data_deS'])==""&&trim($_GET['data_ateS'])=="") {
		if(trim($_SESSION["".$chave_set."_".$mod."modulo_atualS"])=="".$mod."") { } else {
			unset($_SESSION["".$chave_set."_".$mod."data_deS"]);
			unset($_SESSION["".$chave_set."_".$mod."data_ateS"]);
		}
	} else {
		$_SESSION["".$chave_set."_".$mod."data_deS"] = $_GET['data_deS'];
		$_SESSION["".$chave_set."_".$mod."data_ateS"] = $_GET['data_ateS'];
	}
	

	if(trim($_SESSION[''.$chave_set.'_'.$mod.'data_deS'])=="") {
		if(trim($_SESSION[''.$chave_set.'_'.$mod.'data_ateS'])=="") {
			$filtro5 = "";
		} else {
			$d_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],0,2);
			$m_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],3,2);
			$a_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],6,4);
			$data_ateSet = "".$a_ate."-".$m_ate."-".$d_ate."";
			$filtro5 = " AND mod_syslog.data BETWEEN '0000-00-00 00:00:00' AND '".$data_ateSet." 23:59:59' ";
		}
	} else {
		$d_de  = substr($_SESSION["".$chave_set."_".$mod."data_deS"],0,2);
		$m_de  = substr($_SESSION["".$chave_set."_".$mod."data_deS"],3,2);
		$a_de  = substr($_SESSION["".$chave_set."_".$mod."data_deS"],6,4);
		$data_deSet = "".$a_de."-".$m_de."-".$d_de."";
		if(trim($_SESSION[''.$chave_set.'_'.$mod.'data_ateS'])=="") {
			$filtro5 = " AND mod_syslog.data BETWEEN '".$data_deSet." 00:00:00' AND '9999-12-31 23:59:59' ";
		} else {
			$d_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],0,2);
			$m_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],3,2);
			$a_ate  = substr($_SESSION["".$chave_set."_".$mod."data_ateS"],6,4);
			$data_ateSet = "".$a_ate."-".$m_ate."-".$d_ate."";
			$filtro5 = " AND mod_syslog.data BETWEEN '".$data_deSet." 00:00:00' AND '".$data_ateSet." 23:59:59' ";
		}
	}

}


$_SESSION["".$chave_set."_".$mod."modulo_atualS"] = $mod;

$monta_filtro_inline  = $filtro1.$filtro2.$filtro3.$filtro4.$filtro5;

if(trim($monta_filtro_inline)=="") {
} else {
	$where = " WHERE mod_syslog.data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$monta_filtro_inline."";
}

$idsysusuGet = $sysusu['id'];

$ordenacao_set = " mod_".$mod.".data DESC";
$itens_por_pagina = 50; 

if(trim($_GET['campoSqlS'])=="") {
	$campoSqlGet = $campoSqlGet;
} else {
	$campoSqlGet = $_GET['campoSqlS'];
}

if(trim($_GET['limitS'])=="") {
	$limit = $itens_por_pagina;
} else {
	$limit = $_GET['limitS'];
}

if(trim($_SESSION["".$chave_set."_".$mod."pageSessS"])=="") {
	if(trim($_GET['inicioS'])=="") {
		$inicioGet = $inicioGet;
	} else {
		$inicioGet = $_GET['inicioS'];
	}
} else {
	$inicioGet = $limit * ($_SESSION["".$chave_set."_".$mod."pageSessS"]-1);
}

if(trim($inicioGet)=="") {
	$limit_filtro = "LIMIT ".$limit."";
} else {
	$limit_filtro = "LIMIT ".$inicioGet.",".$limit."";
}

if(trim($_GET['filtroS'])=="") {
	$filtroGet = "";
} else {
	$filtroGet = " WHERE ".$_GET['filtroS']."";
}

if(trim($_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"])=="") {
	$ids_selecionadosGet = "";
} else {
	$ids_selecionadosGet = " WHERE ".$_SESSION["".$chave_set."_".$mod."ids_selecionadosSessS"]."";
}

?>


                                    <table class="table table-striped table-bordered table-hover display table-header-fixed" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Usuário</th>
                                                <th>Ação</th>
                                                <th>Local</th>
                                                <th>Descrição</th>
                                                <th style="width:150px;">Data</th>
                                            </tr>

                                            <tr role="row" class="filter">
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" id="nome_search" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'nomeS']?>"> 
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" id="acao_search" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'acaoS']?>"> 
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" id="local_search" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'localS']?>"> 
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" id="detalhe_search" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'detalheS']?>"> 
                                                </td>

                                                <td rowspan="1" colspan="1">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm" id="data_de_search" placeholder="De" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'data_deS']?>">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm" id="data_ate_search" placeholder="Até" value="<?=$_SESSION[''.$chave_set.'_'.$mod.'data_ateS']?>">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <button type="button" onclick="busca_inline('<?=$chave_set?>','<?=$mod?>','<?=$_GET['tbLocalS']?>');" style="margin-bottom:5px;width:109px;" class="btn blue"><i class="fa fa-search"></i> Filtrar</button>
                                                    <button type="button" onclick="busca_inline_limpa('<?=$chave_set?>','<?=$mod?>','<?=$_GET['tbLocalS']?>');" class="btn yellow-casablanca"><i class="fa fa-minus-circle"></i> Limpar Busca</button>
                                                </td>

                                            </tr>

                                        </thead>

										<? $campoSqlGet = $lista_campo_listagem; ?>
										<input type="hidden" id="lista_campo_sql" value="<?=$campoSqlGet?>" />
                                        <tbody>
											<?
											// Salva lista de usuários para consulta posterior, evitando múltiplos acessos a tabela de usuários a cada linha da listagem
											$users = getListaDeUsuarios();

											$strSql = "SELECT mod_syslog.id,
															  mod_syslog.perfil,
															  mod_syslog.idsysusu,
															  mod_syslog.local, 
															  mod_syslog.acao, 
															  mod_syslog.detalhe, 
															  mod_syslog.data
															  
													   FROM ".$linguagem_set."".$mod." AS mod_syslog  ". 
													  "LEFT JOIN sysusu AS mod_sysusu ON (mod_sysusu.id = mod_syslog.idsysusu) " .
												      "".$where."";
																
											$nSql = mysql_num_rows(mysql_query($strSQL));
											
											if($sysusu['id']=="99") {
											#echo "".$strSql." ORDER BY ".$ordenacao_set." ".$limit_filtro." ";
											}
											
											#echo "<br>[".$limit."]<br>";
											
                                            $qSql = mysql_query("".$strSql." ORDER BY ".$ordenacao_set." ".$limit_filtro." ");
                                            while($rSql = mysql_fetch_array($qSql)) {

												$usuario_set = $users[$rSql['idsysusu']];
				
                                            ?>
                                            <tr cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">

                                                <td><?=$usuario_set['nome']?></td>
                                                <td><?=$rSql['acao']?></td>
                                                <td><?=$rSql['local']?></td>
                                                <td><?=$rSql['detalhe']?></td>
                                                <td><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>

                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>

                                    <!--
                                    <div class="row">
                                        <? if($nSql<=$limit) { ?>
                                        <div class="col-md-6"><i>Exibindo <?=$nSql?> itens</i></div>
                                        <? } else { ?>
                                        <div class="col-md-6"><i>Exibindo <?=$itens_por_pagina?> de <span id="n_exibindo"><?=$nSql?></span> itens</i></div>
                                        <? } ?>
                                    </div>
                                    -->
                                            

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-inline" style="width:180px;margin-top:5px;">
                                                <div class="form-group" style="border:0px;width:80px;">
                                                    <input value="" style="width: 100%;height: 29px;"  class="form-control" type="text" id="ir_para" onKeyPress="return submitarEnterIrPara('<?=$chave_set?>','<?=$mod?>','<?=$limit?>','<?=$filtroGet?>','<?=$_GET['tbLocalS']?>',event)" autocomplete="off" />
                                                </div>
                                                <div class="form-group" style="border:0px;">
                                                    <button type="button" onclick="javascript:paginacao_ir_para('<?=$chave_set?>','<?=$mod?>','<?=$limit?>','<?=$filtroGet?>','<?=$_GET['tbLocalS']?>');" class="btn blue">Ir para</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" id="paginacao" style="text-align:center;">
                                            <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/paginacao.php"); ?>
                                        </div>
                                        <div class="col-md-2" id="paginacao">
                                        </div>
                                    </div>
                                        
