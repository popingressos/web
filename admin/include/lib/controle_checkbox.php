									
									<script>

                                    $('.group-checkable').click(function () {
                        
                                        var set = $('tbody > tr > td:nth-child(1) input[type="checkbox"]');
                                        var checked = $(this).is(":checked");
                                        $("#qtd_itens_selecionados").val("0");
                                        $(set).each(function() {
                        
                                            elemento = $(this).parents('tr:eq(0)');
                                            classe_do_elemento = elemento.attr('class');
                            
											
											if(checked===true) {
                                                $(this).attr("checked", checked);
                        
                                                $(this).parent().addClass('checked');
                                                elemento.css("background-color", "#e2ecf6");
                                                
												var res = $("#lista_checkboxes").val().match("/|"+this.value+"|/gi");
												console.log("["+$("#lista_checkboxes").val()+"] ["+this.value+"] ["+res+"]");

                                                if(this.value==res) { } else {
													$("#lista_checkboxes").val("|"+this.value+"|"+$("#lista_checkboxes").val()+"");
												}
                        
                                                var soma_itens = parseInt($("#qtd_itens_selecionados").val()) + 1;
                                                $("#qtd_itens_selecionados").val(""+soma_itens+"");

                                                if($.trim($("#lista_checkboxes").val())=="") {
                                                    $("#btn-copiar-modulo").fadeOut();
                                                } else {
                                                    $("#btn-copiar-modulo").fadeIn();
                                                }
                                            } else {
                                                $(this).attr("checked", false);

                                                $(this).parent().removeClass('checked');
                                                elemento.css("background-color", ""+elemento.attr('cor_anterior')+"");
                            
                                                $("#lista_checkboxes").val("");
                        
                                                if($.trim($("#lista_checkboxes").val())=="") {
                                                    $("#btn-copiar-modulo").fadeOut();
                                                } else {
                                                    $("#btn-copiar-modulo").fadeIn();
                                                }
                                            }

											if($.trim($("#lista_checkboxes").val())=="") {
												$("#qtd_itens_selecionados").val("0")
											} else {
												var valor_set = $("#lista_checkboxes").val();
												for (i = 0; i < 1000; i++) {
													valor_set = valor_set.replace("||", ",");
												}
												for (i = 0; i < 1000; i++) {
													valor_set = valor_set.replace("|", "");
												}
												var retorno = valor_set.split(",");
	
												$("#qtd_itens_selecionados").val(""+retorno.length+"")
											}

                                            if(parseInt($("#qtd_itens_selecionados").val())>1) {
                                                var frase = "itens selecionados";
                                            } else {
                                                var frase = "item selecionado";
                                            }
                                            $("#info-itens").html(""+$("#qtd_itens_selecionados").val()+" "+frase+"");
	
											atualiza_selecionados();

                                        });
                        
                                    });


									$('table tbody tr').live('click', function() {

										var id_setado = $(this).attr('id_linha');
										
										//var existe_classe = $(this).hasClass("block_live_click").toString();
										
										var status = $("#check_"+id_setado+"").is(":checked");

										//var existe_input = $(this).find('input').length;

                                        elemento = $(this);
                                        classe_do_elemento = elemento.attr('class');

									    if(status===false) {
											$("#check_"+id_setado+"").attr("checked", true);
											
											$("#lista_checkboxes").val("|"+id_setado+"|"+$("#lista_checkboxes").val()+"");
                                            
                                            elemento.css("background-color", "#e2ecf6");
                        
                                            var soma_itens = parseInt($("#qtd_itens_selecionados").val()) + 1;
                                            $("#qtd_itens_selecionados").val(""+soma_itens+"");

                                            if($.trim($("#lista_checkboxes").val())=="") {
                                                $("#btn-copiar-modulo").fadeOut();
                                            } else {
                                                $("#btn-copiar-modulo").fadeIn();
                                            }
                                        } else {
                                            $("#check_"+id_setado+"").attr("checked", false);
                        
                                            elemento.css("background-color", ""+elemento.attr('cor_anterior')+"");
                        
                                            var val = $("#lista_checkboxes").val();
                                            $("#lista_checkboxes").val(val.replace("|"+id_setado+"|",""));
                        
                                            var soma_itens = parseInt($("#qtd_itens_selecionados").val()) - 1;
                                            $("#qtd_itens_selecionados").val(""+soma_itens+"");

                                            if($.trim($("#lista_checkboxes").val())=="") {
                                                $("#btn-copiar-modulo").fadeOut();
                                            } else {
                                                $("#btn-copiar-modulo").fadeIn();
                                            }
                                        }

										if($.trim($("#lista_checkboxes").val())=="") {
											$("#qtd_itens_selecionados").val("0")
										} else {
											var valor_set = $("#lista_checkboxes").val();
											for (i = 0; i < 1000; i++) {
												valor_set = valor_set.replace("||", ",");
											}
											for (i = 0; i < 1000; i++) {
												valor_set = valor_set.replace("|", "");
											}
											var retorno = valor_set.split(",");

											$("#qtd_itens_selecionados").val(""+retorno.length+"")
										}


										if(parseInt($("#qtd_itens_selecionados").val())>1) {
                                            var frase = "itens selecionados";
                                        } else {
                                            var frase = "item selecionado";
                                        }
                                        $("#info-itens").html(""+$("#qtd_itens_selecionados").val()+" "+frase+"");

										atualiza_selecionados();

										e.stopPropagation();
									});

									$('.check_<?=$_SESSION['mod']?>').click(function (e) {
                                        var checked = $(this).is(":checked");
                        
                                        elemento = $(this).parents('tr:eq(0)');
                                        classe_do_elemento = elemento.attr('class');

                                        if(checked===true) {
                                            $("#lista_checkboxes").val("|"+this.value+"|"+$("#lista_checkboxes").val()+"");
                                            
                                            elemento.css("background-color", "#e2ecf6");
                        
                                            var soma_itens = parseInt($("#qtd_itens_selecionados").val()) + 1;
                                            $("#qtd_itens_selecionados").val(""+soma_itens+"");

                                            if($.trim($("#lista_checkboxes").val())=="") {
                                                $("#btn-copiar-modulo").fadeOut();
                                            } else {
                                                $("#btn-copiar-modulo").fadeIn();
                                            }
                                        } else {
                        
                                            elemento.css("background-color", ""+elemento.attr('cor_anterior')+"");
                        
                                            var val = $("#lista_checkboxes").val();
                                            $("#lista_checkboxes").val(val.replace("|"+this.value+"|",""));
                        
                                            var soma_itens = parseInt($("#qtd_itens_selecionados").val()) - 1;
                                            $("#qtd_itens_selecionados").val(""+soma_itens+"");

                                            if($.trim($("#lista_checkboxes").val())=="") {
                                                $("#btn-copiar-modulo").fadeOut();
                                            } else {
                                                $("#btn-copiar-modulo").fadeIn();
                                            }
                                        }

										if($.trim($("#lista_checkboxes").val())=="") {
											$("#qtd_itens_selecionados").val("0")
										} else {
											var valor_set = $("#lista_checkboxes").val();
											for (i = 0; i < 1000; i++) {
												valor_set = valor_set.replace("||", ",");
											}
											for (i = 0; i < 1000; i++) {
												valor_set = valor_set.replace("|", "");
											}
											var retorno = valor_set.split(",");

											$("#qtd_itens_selecionados").val(""+retorno.length+"")
										}

                                        if(parseInt($("#qtd_itens_selecionados").val())>1) {
                                            var frase = "itens selecionados";
                                        } else {
                                            var frase = "item selecionado";
                                        }
                                        $("#info-itens").html(""+$("#qtd_itens_selecionados").val()+" "+frase+"");

										atualiza_selecionados();

										e.stopPropagation();
									});

									$('.block_check_click').click(function (e) {
										e.stopPropagation();
									});

									$(".checkboxes").each(function() {
					
										if ($(this).is(':checked')) {
											$(this).parent().addClass('checked');
											$(this).parent().parent().css("background-color", "#e2ecf6");
										} else {
											$(this).parent().removeClass('checked');
											$(this).parent().parent().css("background-color", ""+$(this).parent().parent().attr('cor_anterior')+"");
						
										}

									});
                                    </script>