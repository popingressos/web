    <head>

        <meta charset="UTF-8">
        <title><?=$tituloSeo?></title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		
		<?=$faviconAdmin?>
        
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <meta name="robots" content="noindex">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"/>
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!--<link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/font-awesome/css/font-awesome.min.css"/>-->
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/uniform/css/uniform.default.css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/fullcalendar/fullcalendar.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/typeahead/typeahead.css">
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/clockface/css/clockface.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/dropzone/css/dropzone.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" />
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery.contextMenu.css" />
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
        
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
        
        
        <!--
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/tagit/_static/master.css" rel="stylesheet" type="text/css">
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/tagit/_static/subpage.css" rel="stylesheet" type="text/css">
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/tagit/_static/examples.css" rel="stylesheet" type="text/css">
        -->
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/tagit/css/jquery.tagit.css" rel="stylesheet" type="text/css">
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/tagit/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
        
        
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
        
        <link rel="stylesheet" href="<?=$link?>templates/<?=$layout_padrao_set?>/include/css/draganddrop.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
        
        <link rel="stylesheet" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"/>
        <link rel="stylesheet" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css"/>
        <link rel="stylesheet" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/fancybox/source/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/pages/css/portfolio.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jquery-multi-select/css/jquery.multiselect.filter.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/bootstrap-summernote/summernote.css">
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/jstree/dist/themes/default/style.min.css"/>
        
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>
        
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css"/>
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css" rel="stylesheet" type="text/css"/>
        
        <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        
        <!-- BEGIN PAGE STYLES -->
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/pages/css/tasks.css"/>
        <!-- END PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
        <!--<link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/css/components_menor.css" id="style_components"/>-->
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/css/components.css" id="style_components"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/css/colors.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/global/css/plugins_menor.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/layout/css/layout.css?<?php echo time(); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/layout/css/themes/default.css" id="style_color"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/layout/css/layout-sysmidia.css"/>
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/layout/css/themes/default-sysmidia.css" id="style_color"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/admin/layout/css/custom.css"/>
        <!-- END THEME STYLES -->
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/syschat/css/style.css"/>
        
        <link rel="stylesheet" type="text/css" href="<?=$link?>templates/<?=$layout_padrao_set?>/include/css/personalizado.css"/>
        
        
        <style>
        body {
            font-family: 'Open Sans', sans-serif !important;
        }
        
        <? if(trim($sysconfig[0]['cor_fundo_menu'])=="") { } else { ?>
        body {
            background-color: <?=$sysconfig[0]['cor_fundo_menu']?> !important;
        }
        .page-content-wrapper {
            background-color: <?=$sysconfig[0]['cor_fundo_menu']?> !important;
        }
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover, .page-sidebar {
            background-color: <?=$sysconfig[0]['cor_fundo_menu']?> !important;
        }
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .sidebar-search .input-group .form-control, .page-sidebar .sidebar-search .input-group .form-control {
            background-color: <?=$sysconfig[0]['cor_fundo_menu']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_mouseover_menu'])=="") { } else { ?>
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a, 
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a,
        .page-sidebar .page-sidebar-menu > li:hover > a,
        .page-sidebar .page-sidebar-menu > li.open > a, 
        .sub-menu > li.hover > a > i, 
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i
        {
          background: <?=$sysconfig[0]['cor_mouseover_menu']?> !important;
        }
        .sub-menu > li.hover > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li.open > a > i, .page-sidebar .page-sidebar-menu > li.active > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a, .page-sidebar .page-sidebar-menu .sub-menu > li.hover > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li.active > a, .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i {
          background: transparent !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a,
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i
         {
            color:#FFF;
            background-color: transparent !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a {
          background:rgba(220, 213, 172, 0.5) !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li.open > a {
          background: rgba(220, 213, 172, 0.5) !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a {
          background: <?=$sysconfig[0]['cor_mouseover_menu']?> !important;
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fonte_menu'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu>li.heading>h3, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.heading>h3 {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        
        
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li:hover > a, 
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.open > a {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        .page-sidebar .page-sidebar-menu > li:hover > a > i ,
        .page-sidebar .page-sidebar-menu > li.open > a > i ,
        .page-sidebar .page-sidebar-menu > li:hover > a ,
        .page-sidebar .page-sidebar-menu > li.open > a 
        {
          color: #fff;
        }
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li > a, 
        .page-sidebar .page-sidebar-menu > li > a {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a {
          color: <?=$sysconfig[0]['cor_fonte_menu']?>;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li > a {
          color: <?=$sysconfig[0]['cor_fonte_menu']?>;
        }
        .page-sidebar .page-sidebar-menu .sub-menu > li.open > a , 
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a , 
        .page-sidebar .page-sidebar-menu .sub-menu > li.hover > a , 
        .page-sidebar .page-sidebar-menu .sub-menu > li.open > a > i, 
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i, 
        .page-sidebar .page-sidebar-menu .sub-menu > li.hover > a > i
        {
          color: #000;
        }
        
        .page-sidebar .page-sidebar-menu > li > a > i,
        .page-sidebar .page-sidebar-menu .sub-menu > li > a > i 
        {
          color: <?=$sysconfig[0]['cor_fonte_menu']?>;
        }
        
        .page-sidebar .page-sidebar-menu > li > a > i :hover,
        .page-sidebar .page-sidebar-menu .sub-menu > li > a > i:hover 
        {
          color: #000;
        }
        
        .sub-menu > li.hover > a > i,
        .page-sidebar .page-sidebar-menu .sub-menu > li.open > a > i,
        .page-sidebar .page-sidebar-menu > li.active > a > i,
        .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a , 
        .page-sidebar .page-sidebar-menu .sub-menu > li.hover > a > i, 
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a , 
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i 
        {
          color: #000;
        }
        
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li > a > .arrow:before, 
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li > a > .arrow.open:before, 
        .page-sidebar .page-sidebar-menu li > a > .arrow:before, 
        .page-sidebar .page-sidebar-menu li > a > .arrow.open:before {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
          padding-top:0px;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_menu_active'])=="") { } else { ?>
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a, .page-sidebar .page-sidebar-menu > li.active > a, .page-sidebar .page-sidebar-menu > li.active.open > a {
            background: <?=$sysconfig[0]['cor_menu_active']?> !important;
            color: #FFFFFF !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fundo_rodape'])=="") { } else { ?>
        .page-footer-fixed .page-footer {
          background-color: <?=$sysconfig[0]['cor_fundo_rodape']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fundo_menu_superior'])=="") { } else { ?>
        .page-header.navbar {
          background-color: <?=$sysconfig[0]['cor_fundo_menu_superior']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fundo_submenu_superior'])=="") { } else { ?>
        .page-header.navbar .hor-menu .navbar-nav > li .dropdown-menu {
          background-color: <?=$sysconfig[0]['cor_fundo_submenu_superior']?> !important;
        }
        .page-header.navbar .hor-menu .navbar-nav > li.open > a,
        .page-header.navbar .hor-menu .navbar-nav > li > a:hover {
          background-color: <?=$sysconfig[0]['cor_fundo_submenu_superior']?> !important;
        }
        .page-header.navbar .top-menu .navbar-nav > li.dropdown.open .dropdown-toggle { 
          background-color: <?=$sysconfig[0]['cor_fundo_submenu_superior']?> !important;
        }
        .page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle:hover {
          background-color: <?=$sysconfig['cor_fundo_submenu_superior']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_menu_superior_active'])=="") { } else { ?>
        .page-header.navbar .hor-menu .navbar-nav > li .dropdown-menu li.active > a {
            background: <?=$sysconfig[0]['cor_menu_superior_active']?> !important;
            color: #FFFFFF !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_submenu_superior_active'])=="") { } else { ?>
        .page-header.navbar .hor-menu .navbar-nav > li .dropdown-menu li:hover > a {
            background: <?=$sysconfig[0]['cor_submenu_superior_active']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fonte_rodape'])=="") { } else { ?>
        .page-footer .page-footer-inner {
          color: <?=$sysconfig[0]['cor_fonte_rodape']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_link_rodape'])=="") { } else { ?>
        .page-footer .page-footer-inner a {
          color: <?=$sysconfig[0]['cor_link_rodape']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fonte_menu_superior'])=="") { } else { ?>
        .page-header.navbar .hor-menu .navbar-nav > li > a {
          color: <?=$sysconfig[0]['cor_fonte_menu_superior']?> !important;
        }
        .page-header.navbar .hor-menu .navbar-nav > li > a > i {
          color: <?=$sysconfig[0]['cor_fonte_menu_superior']?> !important;
        }
        .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > .username {
          color: <?=$sysconfig[0]['cor_fonte_menu_superior']?> !important;
        }
        .page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle > i {
          color: <?=$sysconfig[0]['cor_fonte_menu_superior']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fonte_submenu_superior'])=="") { } else { ?>
        .page-header.navbar .hor-menu .navbar-nav > li .dropdown-menu li > a {
          color: <?=$sysconfig[0]['cor_fonte_submenu_superior']?> !important;
        }
        .page-header.navbar .hor-menu .navbar-nav > li .dropdown-menu li > a > i {
          color: <?=$sysconfig[0]['cor_fonte_submenu_superior']?> !important;
        }
        <? } ?>
        
        
        .submenu_novo:hover .submenu_novo_icone {
            color:#FFF !important;
        }
        .submenu_novo:hover .submenu_novo_titulo {
            color:#FFF !important;
        }
        
        .submenu_novo.open:hover .submenu_novo_icone {
            color:#000 !important;
        }
        .submenu_novo.open:hover .submenu_novo_titulo {
            color:#000 !important;
        }
        
        .page-content {
            background-color:#EEF1F5 !important;
        }
        
        <? if(trim($sysconfig[0]['cor_fundo_logotipo'])=="") { ?>
        .cor_fundo_logotipo {
            background-color:#17C4BB !important;
        }
        <? } else { ?>
        .cor_fundo_logotipo {
            background-color:<?=$sysconfig[0]['cor_fundo_logotipo']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fonte_menu'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu>li>a>[class^=icon-], .page-sidebar .page-sidebar-menu .sub-menu>li>a>i[class*=icon-], .page-sidebar .page-sidebar-menu .sub-menu>li>a>i[class^=icon-] {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        .sub-menu > li.hover > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li.open > a > i, .page-sidebar .page-sidebar-menu > li.active > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li:hover > a, .page-sidebar .page-sidebar-menu .sub-menu > li.hover > a > i, .page-sidebar .page-sidebar-menu .sub-menu > li.active > a, .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i {
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_fundo_titulo'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu>li.heading {
          background-color: <?=$sysconfig[0]['cor_fundo_titulo']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_titulo'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu>li.heading>h3 {
          color: <?=$sysconfig[0]['cor_titulo']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_icone'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu>li>a>[class^=icon-], 
        .page-sidebar .page-sidebar-menu .sub-menu>li>a>i[class*=icon-], 
        .page-sidebar .page-sidebar-menu .sub-menu>li>a>i[class^=icon-],
        .page-sidebar .page-sidebar-menu li .sub-menu li>a>i,
        .page-sidebar .page-sidebar-menu li>a>i,
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a > i {
          color: <?=$sysconfig[0]['cor_icone']?> !important;
        }
        <? } ?>
        
        .page-sidebar .page-sidebar-menu .sub-menu li>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu li>a {
            padding: 6px 15px 6px 15px !important;
        }
        
        .page-sidebar .page-sidebar-menu>li.heading, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.heading {
            padding: 10px 15px 8px 15px !important;
        }
        
        <? if(trim($sysconfig[0]['cor_linha_menu'])=="") { } else { ?>
        .item_modulo>a {
            border-top: 1px solid <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .item_modulo:fisrt-child {
            border-top: 0px solid <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .sidebar-search .input-group .form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
          color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .sidebar-search .input-group .form-control::-moz-placeholder { /* Firefox 19+ */
          color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .sidebar-search .input-group .form-control:-ms-input-placeholder { /* IE 10+ */
          color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .sidebar-search .input-group .form-control:-moz-placeholder { /* Firefox 18- */
          color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .page-sidebar-menu>li.active.open+li>a {
            border-top-color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        .page-sidebar .page-sidebar-menu>li>a {
            border-top-color: <?=$sysconfig[0]['cor_linha_menu']?>;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_mouseover_menu'])=="") { } else { ?>
        .page-sidebar .page-sidebar-menu .sub-menu > li.open > a,
        .page-sidebar .page-sidebar-menu .sub-menu > li.active > a {
          background: <?=$sysconfig[0]['cor_mouseover_menu']?> !important;
          color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        <? } ?>
        
        <? if(trim($sysconfig[0]['cor_icone'])=="") { } else { ?>
        .campo_procurar::-webkit-input-placeholder{
          color: <?=$sysconfig[0]['cor_icone']?> !important;
        }
        .campo_procurar::-moz-placeholder {
          color: <?=$sysconfig[0]['cor_icone']?> !important;
        }​
        <? } ?>
        
        .page-sidebar .page-sidebar-menu>li>a, 
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a {
            border-top:0px !important;
        }
        
        
        .upload-demo .upload-demo-wrap,
        .upload-demo .upload-result,
        .upload-demo.ready .upload-msg {
            display: none;
        }
        .upload-demo.ready .upload-demo-wrap {
            display: block;
        }
        .upload-demo.ready .upload-result {
            display: inline-block;    
        }
        .upload-demo-wrap {
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }
        
        .upload-msg {
            text-align: center;
            padding: 50px;
            font-size: 22px;
            color: #aaa;
            width: 260px;
            margin: 50px auto;
            border: 1px solid #aaa;
        }
        
        body {
            font-family: 'Open Sans', sans-serif !important;
            font-size:13px !important;
            zoom:100%;
        }
        
        @-webkit-keyframes blinker {
          from {opacity: 1.0;}
          to {opacity: 0.0;}
        }
        .blink{
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 0.6s;
            -webkit-animation-iteration-count:infinite;
            -webkit-animation-timing-function:ease-in-out;
            -webkit-animation-direction: alternate;
        }
        
        
        .select2-container .select2-choice {
            display: block;
            height: 26px;
            padding: 0 0 0 8px;
            overflow: hidden;
            position: relative;
            border: 0px solid #aaa;
            white-space: nowrap;
            line-height: 26px;
            color: #444;
            text-decoration: none;
            border-radius: 4px;
            background-clip: padding-box;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #fff;
            background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ffffff), color-stop(0.5, #fff));
            background-image: -webkit-linear-gradient(center bottom, #eee 0%, #fff 50%);
            background-image: -moz-linear-gradient(center bottom, #eee 0%, #fff 50%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#ffffff', endColorstr = '#ffffff', GradientType = 0);
            background-image: linear-gradient(to top, #ffffff 0%, #ffffff 50%);
            margin-top: -5px;
        }
        
        .select2-drop {
            width: 100%;
            margin-top: -1px;
            position: absolute;
            z-index: 9999;
            top: 100%;
            background: #fff;
            color: #000;
            border: 1px solid #aaa;
            border-top: 0;
            border-radius: 0 0 4px 4px;
            -webkit-box-shadow: 0 4px 5px rgba(0, 0, 0, .15);
            box-shadow: 0 0px 0px rgba(0, 0, 0, .15);
        }
        
        .select2-container .select2-choice .select2-arrow {
            display: inline-block;
            width: 18px;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            border-left: 0px solid #aaa;
            border-radius: 0 4px 4px 0;
            background-clip: padding-box;
            /* background: #ccc; */
            /* background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ccc), color-stop(0.6, #eee)); */
            background-image: -webkit-linear-gradient(center bottom, #ccc 0%, #eee 60%);
            background-image: -moz-linear-gradient(center bottom, #ccc 0%, #eee 60%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#eeeeee', endColorstr = '#cccccc', GradientType = 0);
            background-image: linear-gradient(to top, #fff 0%, #fff 60%);
        }
        
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li > a > .arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li > a > .arrow.open:before, .page-sidebar .page-sidebar-menu li > a > .arrow:before, .page-sidebar .page-sidebar-menu li > a > .arrow.open:before {
            color: #dedede !important;
            padding-top: 0px !important;
        }
        .item_modulo > a {
            border-top: 0px solid #656e7a !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu {
            list-style: none;
            display: none;
            padding: 0;
            margin: 0px 0px 0px 0px !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu li>a {
            padding: 10px 15px 10px 15px !important;
        }
        .page-sidebar .page-sidebar-menu .sub-menu li {
            background: none;
            margin: 0px;
            padding: 0px;
            margin-top: 0px !important;
            border-bottom: 1px dotted rgba(0,0,0,0.2);
        }
        
        .page-sidebar .page-sidebar-menu li .sub-menu li>a>i, .page-sidebar .page-sidebar-menu li>a>i {
            color: <?=$sysconfig[0]['cor_icone']?> !important;
        }
        .page-sidebar .page-sidebar-menu > li.active > a {
            color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        .page-sidebar .page-sidebar-menu li > a > .arrow:before, .page-sidebar .page-sidebar-menu li > a > .arrow.open:before {
            padding-top:9px !important;
            color: <?=$sysconfig[0]['cor_icone']?> !important;
        }
        .page-sidebar .page-sidebar-menu > li.active > a, .page-sidebar .page-sidebar-menu > li.active.open > a {
            color: <?=$sysconfig[0]['cor_fonte_menu']?> !important;
        }
        .page-sidebar .page-sidebar-menu > li.active > a > .selected {
            border-right: 12px solid <?=$sysconfig[0]['cor_fonte_menu']?>;
        }
        
        .page-sidebar .page-sidebar-menu li>a>i {
            background-color:#445362;
            width:35px;
            height:35px;
            border-radius: 50px !important;
            padding-top: 10px !important;
        }
        
        .page-sidebar .page-sidebar-menu .sub-menu > li > a > i {
            background-color:transparent;
            width:35px !important;
            height:inherit !important;
            border-radius: 0px !important;
            padding-top: 0px !important;
            padding-right:0px;
        }
        
        .modal {
            width: inherit !important;
        }
        .page-content {
            background-color:#f3f3f4 !important;
        }
        
        .page-container {
            background-color:#f3f3f4 !important;
            margin-top: 0px !important;
        }
        
        .page-header {
            height:68px;
            display:none;
        }
        .logotipo_menu {
            background-color: #f9f9f9 !important;
            margin-top: -1px;
            position: fixed;
            z-index: 10049;
            cursor:pointer;
            width: 235px;
            padding: 10px 10px;
        }
        .menu1 {
            padding-top:70px !important;
        }
        
        .botoes_salvar_rodape {
            position:fixed;
            width:100%;
            padding:10px 10px;
            bottom:33px;
            background-color:#f3f3f4 !important;
            z-index: 99999999999999999999999999999999999999999999999999;
        }
        
        .page-sidebar .page-sidebar-menu > li.active > a > .selected {
            top: 13px !important;
        }
        
        .page-sidebar .page-sidebar-menu .sub-menu>li>a>.arrow:before {
            margin-top: -11px !important;
        }
        .fileinput-preview {
            background-color:#fafafa !important;
            padding:5px !important;
        }
        
        @media (min-width: 992px) {
            .page-sidebar-fixed .page-sidebar {
                position: fixed !important;
                margin-left: 0;
                top: 0px !important;
            }
        }
        @media (max-width: 650px) {
            .page-title {
                margin-bottom: 0px !important;
            }
            .botoes_salvar_rodape {
                position:fixed;
                width:100%;
                padding:10px 10px;
                bottom:0px;
                background-color:#f3f3f4 !important;
                z-index: 99999999999999999999999999999999999999999999999999;
            }
            .botoes_de_salvar {
                width:100% !important;
            }
            .botoes_de_salvar > button:first-child {
                margin-bottom:5px !important;
            }
            .botoes_de_salvar > button {
                width:100% !important;
            }
            
            .btn_voltar_lista {
                float:none !important;
                margin-top:10px;
                width:100% !important;
            }
            .page-container {
                margin-top: 78px !important;
            }
            .page-header {
                display:block;
            }
            .logotipo_menu {
                display:none !important;
            }
            .menu1 {
                padding-top:0px !important;
            }
        
            .page-header.navbar {
                background-color: #f9f9fc !important;
                height: 78px;
                position: fixed;
            }
        }
        
        @media screen and (min-width:1024px){
            .hide-on-desktop{display:none!important}
            .show-on-desktop{display:block}
        }
        
        @media screen and (max-width:1023px){
            .hide-on-mobile{display:none!important}
            .show-on-mobile{display:block}
        }
        
        .portlet.calendar.light .fc-button {
            top: -5px !important;
            color: #666;
            text-transform: uppercase;
            font-size: 12px;
            padding-bottom: 35px;
        }
        </style>
        
        
        <script src="https://www.gstatic.com/firebasejs/5.1.0/firebase.js"></script>
        
        <? include("templates/".$layout_padrao_set."/footer_1.php"); ?>
		
        <link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.css" />
        <link rel="Stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
        <script src="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
        
    </head>

