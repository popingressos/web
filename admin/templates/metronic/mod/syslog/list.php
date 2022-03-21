				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

                            <li class="active"><a data-toggle="tab" href="#tab_operacoes">Histórico de Operações</a></li>

                        </ul>
    
                        <div class="tab-content">
                                
                                
                                <div class="tab-pane active" id="tab_operacoes">

                                    <div id="datatable_ajax_tbody">
										<? 
										$_GET['tbLocalS'] = "".$mod."";
										$_GET['modS'] = $mod; 
										if(trim($_SESSION["".$chave_url."_".$mod."modulo_atualS"])=="".$mod."") { } else { unset($_SESSION["".$chave_url."_".$mod."buscaSearchS"]); }
										include("./templates/".$layout_padrao_set."/acoes/syslog/tabela-tbody.php"); 
                                        ?>
                                    </div>

                                </div>
                                <!-- END TAB_OPERACOES -->

                        </div>
                        <!-- END TAB CONTENT-->

                    </div>
				</div>
                <!-- FIM COL-MD-12-->
                
				<script>
				var Componentes = function () {
				
					var handleDatePickers = function () {
				
						if (jQuery().datepicker) {
							$('.date-picker').datepicker({
								rtl: Metronic.isRTL(),
								orientation: "top",
								autoclose: true
							}).on("changeDate", function (e) {
								seta_altera_campo();
							});
								//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
						}

						/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
					}

					return {
						//main function to initiate the module
						init: function () {            

							handleDatePickers();
						
						}
					};
				}();  

                </script>
				<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/syslog/js/scripts.js"></script>
