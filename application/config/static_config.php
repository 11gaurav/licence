<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    $CI = & get_instance();
    $CI->load->library('session'); //if it's not autoloaded in your CI setup
    $site_lang = $CI->session->userdata('site_lang');


    $config['public_default_css'] = array(
    );

    $config['public_default_js'] = array(
    );

//----- Admin Assets -----

    $config['admin_default_css'] = array(
        'bootstrap-min' => array('name' => 'assets/css/bootstrap.min.css'),
        'icons-min-css' => array('name' => 'assets/css/icons.min.css'),
        'app-min' => array('name' => 'assets/css/app.min.css'),
        'font-awesome' => array('name' => 'assets/css/vendor/font-awesome/css/font-awesome.min.css'),
        'custom-min' => array('name' => 'assets/css/custom.css'),
        'AdminLTE' => array('name' => 'assets/css/AdminLTE.css'),
        '_left-menu' => array('name' => 'assets/css/_left-menu.scss'),
        '_page-head' => array('name' => 'assets/css/_page-head.scss'),
        '_topbar' => array('name' => 'assets/css/_topbar.scss'),
    );
    $config['admin_default_js'] = array(
        'app.min' => array('name' => 'assets/js/app.min.js'),
        'jquery.blockUI' => array('name' => 'assets/js/jquery.blockUI.js'),
        'general' => array('name' => 'assets/js/general.js'),
        'jquery-validate' => array('name' => 'assets/js/jquery-validate/jquery.validate.js'),
        'jquery-validate-additional-methods' => array('name' => 'assets/js/jquery-validate/additional-methods.js'),
        'jquery-ui' => array('name' => 'assets/js/jquery-ui.min.js'),
    );

    $config['css_arr'] = array(
        'dataTables.bootstrap' => array('name' => 'assets/css/vendor/dataTables.bootstrap4.css'),
        'responsive.bootstrap' => array('name' => 'assets/css/vendor/responsive.bootstrap4.css'),
        'buttons.bootstrap' => array('name' => 'assets/css/vendor/buttons.bootstrap4.css'),
        'select.bootstrap' => array('name' => 'assets/css/vendor/select.bootstrap4.css'),
        'jquery.contextMenu' => array('name' => 'assets/js/vendor/jquery-contextMenu/jquery.contextMenu.min.css'),
        'jquery-ui' => array('name' => 'assets/css/jquery-ui.css'),
        'dropzone' => array('name' => 'assets/css/dropzone.css'),
        'datepicker' => array('name' => 'assets/js/vendor/datepicker/bootstrap-datepicker.min.css'),
        'colorbox' => array('name' => 'assets/colorbox/colorbox.css'),
        'timepicker' => array('name' => 'assets/js/vendor/jquery-timepicker/jquery.timepicker.min.css'),
        '_left-menu' => array('name' => 'assets/css/_left-menu.scss'),
        '_page-head' => array('name' => 'assets/css/_page-head.scss'),
        '_topbar' => array('name' => 'assets/css/_topbar.scss'),
    );

    $config['js_arr'] = array(
        'dataTables' => array('name' => 'assets/js/vendor/jquery.dataTables.js'),
        'dataTables.FilterOnReturn' => array('name' => 'assets/js/vendor/dataTables.FilterOnReturn.js'),
        'dataTables.bootstrap' => array('name' => 'assets/js/vendor/dataTables.bootstrap4.js'),
        'dataTables.responsive' => array('name' => 'assets/js/vendor/dataTables.responsive.min.js'),
        'responsive.bootstrap' => array('name' => 'assets/js/vendor/responsive.bootstrap4.min.js'),
        'dataTables.buttons' => array('name' => 'assets/js/vendor/dataTables.buttons.min.js'),
        'buttons.bootstrap' => array('name' => 'assets/js/vendor/buttons.bootstrap4.min.js'),
        'buttons.html5' => array('name' => 'assets/js/vendor/buttons.html5.min.js'),
        'buttons.flash' => array('name' => 'assets/js/vendor/buttons.flash.min.js'),
        'dropzone' => array('name' => 'assets/js/dropzone.js'),
        'colorbox' => array('name' => 'assets/colorbox/jquery.colorbox-min.js'),
        'buttons.print' => array('name' => 'assets/js/vendor/buttons.print.min.js'),
        'jquery.ip-address' => array('name' => 'assets/js/vendor/jquery.input-ip-address-control-1.0.min.js'),
        'jquery.contextMenu' => array('name' => 'assets/js/vendor/jquery-contextMenu/jquery.contextMenu.min.js'),
        'jquery.ui.position' => array('name' => 'assets/js/vendor/jquery-contextMenu/jquery.ui.position.min.js'),
        'jquery.caret' => array('name' => 'assets/js/vendor/jquery.caret-1.5.2.min.js'),
        'ipformat' => array('name' => 'assets/js/ipformat.js'),
        'datepicker' => array('name' => 'assets/js/vendor/datepicker/bootstrap-datepicker.min.js'),
        'blockUI' => array('name' => 'assets/js/jquery-block-ui.js'),
        'bootbox' => array('name' => 'assets/js/bootbox.min.js'),
        'ckeditor' => array('name' => 'assets/ckeditor/ckeditor.js'),
        'timepicker' => array('name' => 'assets/js/vendor/jquery-timepicker/jquery.timepicker.min.js'),
        'brand' => array('name' => 'assets/js/brand.js'),
        'collection' => array('name' => 'assets/js/collection.js'),
        'model' => array('name' => 'assets/js/model.js'),
    );

//----- Login Assets -----

    $config['login_register_css'] = array(
        'font-awesome' => array('name' => 'assets/css/font-awesome.min.css'),
        'bootstrap' => array('name' => 'assets/bootstrap/css/bootstrap.min.css'),
        'prettyPhoto' => array('name' => 'assets/css/prettyPhoto.css'),
        'animate' => array('name' => 'assets/css/animate.css'),
        'responsive' => array('name' => 'assets/css/responsive.css'),
        'custom' => array('name' => 'assets/css/custom.css'),
        '_left-menu' => array('name' => 'assets/css/_left-menu.scss'),
        '_page-head' => array('name' => 'assets/css/_page-head.scss'),
        '_topbar' => array('name' => 'assets/css/_topbar.scss'),
    );

    $config['login_register_js'] = array(
        'jquery' => array('name' => 'assets/plugins/jQuery/jQuery-2.1.4.min.js'),
        'bootstrap' => array('name' => 'assets/bootstrap/js/bootstrap.min.js'),
        'jquery.validate' => array('name' => 'assets/plugins/validation/jquery.validate.min.js'),
        'fastclick' => array('name' => 'assets/plugins/fastclick/fastclick.min.js'),
        'app' => array('name' => 'assets/js/app.min.js'),
        'bootbox' => array('name' => 'assets/js/bootbox.js'),
        'general' => array('name' => 'assets/js/general.js'),
        'custom' => array('name' => 'assets/js/custom.js'),
        'blockUI' => array('name' => 'assets/js/jquery-block-ui.js'),
    );
    