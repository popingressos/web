<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/sysdashboard/js/scripts.js?<?php echo time(); ?>"></script>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/personal/js/scripts.js?<?php echo time(); ?>"></script>

<script>
$(document).on('keypress', 'input', function(ev){
	seta_altera_campo();
});

$(document).on('change', 'select', function(ev){
	seta_altera_campo();
});

</script>

    
    