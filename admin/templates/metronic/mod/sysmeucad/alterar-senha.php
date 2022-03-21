				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

							<li class="active"><a data-toggle="tab" href="#tab_form">Editando Minha Senha</a></li>

                        </ul>
    
                        <div class="tab-content">
                                
                                <div class="tab-pane active" id="tab_form">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-body form">
                                                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">
                                                    <input type="hidden" name="aba" id="aba" value="dados-principais" />
                                                    
                                                    <input type="hidden" name="subMod" value="" />

                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="alterar-senha" />
                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                    <input type="hidden" name="iditem" id="iditem_set" value="<?=$sysusu['id']?>" />
        
                                                    <? 
                                                    $numeroUnicoGerado = $row['numeroUnico']; 
                                                    ?>
                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                    <div class="tab-content">
    
                                                        <div id="dados-principais" class="tab-pane active" style="min-height:350px;">
            
                                                            <div class="col-md-12">
                                                                <div class="note note-success">
                                                                    <h3>INFORMAÇÕES</h3>
                                                                    <p>Não utilizar caracteres especiais para a criação da senha, tais como: * (asterisco), acentuação, espaços e símbolos especiais.</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nova Senha</label>
                                                                <div class="col-md-10">
                                                                    <input value="" style="width:350px;" type="text" name="senha" id="senha" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Confirmação de Nova Senha</label>
                                                                <div class="col-md-10">
                                                                    <input value="" style="width:350px;" type="text" id="conf_senha" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                        <!-- END dados_principais -->

                                                    </div>
    
                                                </div>
                                                <!-- END form-body -->

                                                <div style="border:0px;position:fixed;bottom:35px;background-color:#f6f6f6;padding:10px;">
                                                    <div class="col-md-12">
                                                        <button type="button" onclick="javascript:enviarNovaSenha();" style="margin-left:20px;" class="btn green-turquoise"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                        <button type="button" onclick="javascript:window.open('<?=$link?>','_self','');" id="btn_cancelar" class="btn yellow-casablanca"><i class="fa fa-minus-circle"></i> Cancelar</button>
                                                    </div>
                                                </div>

                                                </form>
                                                
        
                                            </div>
                                            </div>
    
                                        </div>
                                        <!-- END COL-10-->

                                     </div>
                                     <!-- END ROW-->
                                        
                                </div>
                                <!-- END TAB_FORM-->

                        </div>
                        <!-- END TAB CONTENT-->

                    </div>
				</div>
                <!-- FIM COL-MD-12-->
                
                <script>
				function enviarNovaSenha() {
					if($.trim($("#senha").val())=="") {
						alert("Campo 'Senha' deve ser preenchido");
						$("#senha").focus();
					} else {
						if($.trim($("#conf_senha").val())=="") {
							alert("Campo 'Confirmação de Senha' deve ser preenchido");
							$("#conf_senha").focus();
						} else {
							if($.trim($("#conf_senha").val())!=$.trim($("#senha").val())) {
								alert("As senhas não conferem!");
							} else {
								document.forms.submit();
							}
						}
					}
				}
				var Componentes = function () {
				
					var handle_COR = function() {
						$('.color_campo').each(function() {
							//
							// Dear reader, it's actually very easy to initialize MiniColors. For example:
							//
							//  $(selector).minicolors();
							//
							// The way I've done it below is just for the demo, so don't get confused
							// by it. Also, data- attributes aren't supported at this time...they're
							// only used for this demo.
							//
							$(this).minicolors({
								control: $(this).attr('data-control') || 'hue',
								defaultValue: $(this).attr('data-defaultValue') || '',
								inline: $(this).attr('data-inline') === 'true',
								letterCase: $(this).attr('data-letterCase') || 'lowercase',
								opacity: $(this).attr('data-opacity'),
								position: $(this).attr('data-position') || 'bottom left',
								change: function(hex, opacity) {
									if (!hex) return;
									if (opacity) hex += ', ' + opacity;
									if (typeof console === 'object') {
										console.log(hex);
									}
								},
								theme: 'bootstrap'
							});
				
						});
					}

					var handleColorPicker = function () {
						if (!jQuery().colorpicker) {
							return;
						}
						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
					}
				
					var handleDatePickers = function () {
				
						if (jQuery().datepicker) {
							$('.date-picker').datepicker({
								rtl: Metronic.isRTL(),
								orientation: "top",
								autoclose: true
							});
							//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
						}
				
						/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
					}

					return {
				
						//main function to initiate the module
						init: function () {
							
							handle_COR();
							
							handleColorPicker();
							
							handleDatePickers();
						}
				
					};
				
				}();

				jQuery(document).ready(function() {    
					Componentes.init();
				});
                </script>





