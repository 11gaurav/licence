<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    $config['menu_config']["menu"] = array(
        'dashboard' => array(
            'menu_name' => 'dashboard',
            'path' => 'admin/dashboard',
            'icon_class' => 'icmn-home',
            'submenu' => array()
        ),
         
      
    );


    $config['menu_config']['application_modules'] = $app_modules = array_keys($config['menu_config']["menu"]);

    $menu_modules = Array
        ("dashboard", "users");

    $super_admin_modules = Array
        ("dashboard");

    $config['menu_config']['user_access'] = array(
        'Super Admin' => $super_admin_modules,
        'Site Admin' => $app_modules,
//        'Admin' => $app_modules,
    );



    