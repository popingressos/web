<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/_construtor_template/js/scripts.js?<?php echo time(); ?>"></script>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/sysgrupousuario/js/scripts.js?<?php echo time(); ?>"></script>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/include/js/mascaras.js?<?php echo time(); ?>"></script>

<script>
$(document).on('keypress', 'input', function(ev){
	seta_altera_campo();
});

$(document).on('change', 'select', function(ev){
	seta_altera_campo();
});

$('#TI_modulo_empresa_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_empresa').val(""+$('#TI_modulo_empresa').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_empresa_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_empresa_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_empresa').val($('#TI_modulo_empresa').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_eventos_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_eventos').val(""+$('#TI_modulo_eventos').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_eventos_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_eventos_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_eventos').val($('#TI_modulo_eventos').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_produtos_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_produtos').val(""+$('#TI_modulo_produtos').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_produtos_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_produtos_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_produtos').val($('#TI_modulo_produtos').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_envio_de_notificacao_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_envio_de_notificacao').val(""+$('#TI_modulo_envio_de_notificacao').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_envio_de_notificacao_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_envio_de_notificacao_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_envio_de_notificacao').val($('#TI_modulo_envio_de_notificacao').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_pessoas_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_pessoas').val(""+$('#TI_modulo_pessoas').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_pessoas_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_pessoas_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_pessoas').val($('#TI_modulo_pessoas').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_atendimento_de_balcao_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_atendimento_de_balcao').val(""+$('#TI_modulo_atendimento_de_balcao').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_atendimento_de_balcao_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_atendimento_de_balcao_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_atendimento_de_balcao').val($('#TI_modulo_atendimento_de_balcao').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_modulo_gerador_de_relatorios_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_modulo_gerador_de_relatorios').val(""+$('#TI_modulo_gerador_de_relatorios').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_modulo_gerador_de_relatorios_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_modulo_gerador_de_relatorios_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_modulo_gerador_de_relatorios').val($('#TI_modulo_gerador_de_relatorios').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});

$('#TI_plataformas_itens').multiSelect({
  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
  afterInit: function(ms){
	var that = this,
		$selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
	.on('keydown', function(e){
	  if (e.which === 40){
		that.$selectableUl.focus();
		return false;
	  }
	});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
	.on('keydown', function(e){
	  if (e.which == 40){
		that.$selectionUl.focus();
		return false;
	  }
	});
  },
	afterSelect: function(values){
		$('#TI_plataformas').val(""+$('#TI_plataformas').val()+''+values+'');
		
		seta_altera_campo();

		$("#ms-TI_plataformas_itens :input").each(function(e){	
		  $(this).val("");
		});

		$("#ms-TI_plataformas_itens .ms-selectable .ms-list li").each(function(e){	
		  $(this).css({"display":"block"});
		});
	},
	afterDeselect: function(values){
		$('#TI_plataformas').val($('#TI_plataformas').val().replace(''+values+'',''));
		seta_altera_campo();
	}
});
</script>
