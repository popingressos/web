<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$_REQUEST['modS']." WHERE id='".$_REQUEST['idS']."'"));
?>
                                <div style="width:100%;">

                                     <div class="formSep">
                                        <label>Ordem</label>
                                        <select id="ordem_foto" style="width:70px;">
                                            <?
                                            $nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$_REQUEST['modS']." WHERE numeroUnico='".$rSql['numeroUnico']."'"));
                                            if($nordem==0) {
                                            ?>
                                            <option value='1'>1</option>
                                            <?
                                            } else {
                                            $ultimaOrdem = $nordem;
                                            for ($b=1; $b<=$ultimaOrdem; $b++) {
                                            ?>
                                            <option value='<?=$b?>' <? if($b==$rSql['ordem']) { echo "selected"; } ?>><?=$b?></option>
                                            <? } } ?>
                                        </select>
                                    </div>

                                    <div class="formSep">
                                        <div style="float:left;margin-right:10px;">
                                            <label class="req">Nome</label>
                                            <input value="<?=$rSql['nome']?>" style="width:350px;" type="text" id="nome_foto" />
                                        </div>
                                    </div>

                                    <div class="formSep">
                                        <button type="button" onclick="edita_foto_ajax('<?=$_REQUEST['idS']?>','<?=$_REQUEST['modS']?>');" class="btn btn-success">Salvar</button>
                                        <button type="button" class="btn btn-warning">Cancelar</button>
                                    </div>

                                </div>
