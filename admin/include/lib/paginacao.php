<?
if(trim($_SESSION['mod2'])=="") {
	$modPagina = $_SESSION['mod'];
} else {
	$modPagina = $_SESSION['mod2'];
}

if(trim($modPagina)=="cepbr_bairro") {
	$modPagina = "bairros";
}

$page = $_SESSION[''.$modPagina.'pagina'];
if(trim($page)==""||trim($page)=="0") { $paginaAtual=1; } else {  $paginaAtual= (int)$page;}
?>

<ul class="pagination pagination-sm">
    <li>
        <a href="javascript:void(0);" onclick="javascript:paginacao('1','<?=$modPagina?>','<?=$_SESSION['acoes']?>');">
            <i class="fa fa-angle-double-left"></i>
        </a>
    </li>

<? if($page==1) { ?>
    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>
<? } else { ?>
    <li>
        <a href="javascript:void(0);" onclick="javascript:paginacao('<?=$paginaAtual - 1 ?>','<?=$modPagina?>','<?=$_SESSION['acoes']?>');">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>
<? } ?>

<?
$qtdPaginas = 10;
$inicio_set = 0;
$totPaginas = $nSql[0] / $itens_por_pagina;

if (is_int($totPaginas)) {
	$totPaginasInt = (int)$totPaginas;
} else {
	$totPaginasInt = (int)$totPaginas;
}


$divisorReal = $divisorInt - ($page - 1);
$somaLimit = $limitador + $paginaAtual;
if($somaLimit>$divisorInt) { $correcao = $divisorInt-$paginaAtual; $limitadorCorreto=$correcao+1; } else { $limitadorCorreto=$limitador; }

$valorI = $paginaAtual-1;

$limitador = $valorI + 9;

if($limitador>$totPaginasInt) { $limitador=$totPaginasInt; } else { $limitador=$limitador; }

$soma1 = $totPaginasInt - $qtdPaginas;
if($valorI<=0||$soma1<=0) { 
	$valorI=0; 
} else { 
	if($valorI>$soma1) { 
		$valorI=$soma1; 
	} else { 
		$valorI=$valorI; 
	}
}

if($totPaginas>$qtdPaginas) {
	if($paginaAtual==1||$paginaAtual==2||$paginaAtual==3||$paginaAtual==4||$paginaAtual==5||$paginaAtual==6) {
		$pagina_menos = $paginaAtual-1;
		$limite_j = $paginaAtual-5;
		$soma_page_extra = $limitador-($paginaAtual-1);
	} else {
		$pagina_menos = $paginaAtual-1;
		$limite_j = $paginaAtual-4;
		$soma_page_extra = $limitador-5;
	}

	$valor_somado = ($soma_page_extra)-$valorI;
	$outro_valor_somado = (($soma_page_extra)-$valorI) + $paginaAtual;
	if($valor_somado<5 || $outro_valor_somado==10) {
		$mostra_anterior=1;
	} else {
		$mostra_anterior=0;
	}

	if($mostra_anterior==1) {
		for($j=$limite_j;$j<=$pagina_menos;$j++) {
			$pagei = ($j);
			$inicio_set = ($pagei + $j) * $limit;
	
			if($j<=0) { } else {
				echo "<li><a href=\"javascript:void(0);\" onclick=\"javascript:paginacao('".$pagei."','".$modPagina."','".$_SESSION['acoes']."');\">".$pagei."</a></li>";
			}
		}
	}

	if($paginaAtual==1||$paginaAtual==2||$paginaAtual==3||$paginaAtual==4||$paginaAtual==5||$paginaAtual==6) {
		$soma_page_extra = $limitador-($paginaAtual-1);
	} else {
		if(($soma_page_extra)-$valorI<5) {
			$soma_page_extra = $soma_page_extra;
		} else {
			$soma_page_extra = $soma_page_extra + 5;
		}
	}
	
} else {
	$soma_page_extra = $totPaginasInt;
}


for($i=$valorI;$i<=$soma_page_extra;$i++) {
$pagei = ($i + 1);
$inicio_set = ($pagei - 1) * $limit;
?>

	<? $page_next = $paginaAtual + 1; ?>

	<? if($pagei==$paginaAtual) { ?>
    <li><a href="javascript:void(0);" style="background-color:#366D83;color:#FFF;"><?= $pagei ?></a></li>
	<? } else { ?>
    <li><a href="javascript:void(0);" onclick="javascript:paginacao('<?= $pagei ?>','<?=$modPagina?>','<?=$_SESSION['acoes']?>');"><?= $pagei ?></a></li>
	<? } ?>

<? } ?>

<? if($paginaAtual==($totPaginasInt+1)) { ?>
    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>
<? } else { ?>
    <li>
        <a href="javascript:void(0);" onclick="javascript:paginacao('<?= $paginaAtual+1 ?>','<?=$modPagina?>','<?=$_SESSION['acoes']?>');">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>
<? } ?>

<? $pageFim = $totPaginasInt + 1; $limiteFim = $totPaginasInt * $limit; ?>
    <li>
        <a href="javascript:void(0);" onclick="javascript:paginacao('<?= $pageFim ?>','<?=$modPagina?>','<?=$_SESSION['acoes']?>');">
            <i class="fa fa-angle-double-right"></i>
        </a>
    </li>
</ul>
