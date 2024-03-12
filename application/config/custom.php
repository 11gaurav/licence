<?php

//    define('EMAIL_FROM_NAME', 'e-Invoicing');
//    define('EMAIL_FROM_EMAIL', 'sonalirathi52@gmail.com');

    $config['custom']['meta_data'] = array(
        'meta:title' => 'e-Invoicing',
        'meta:description' => '',
        'meta:keywords' => '',
        'meta:robots' => 'all'
    );

    //***********************************

    $config['custom']['user_types'] = array(
        'Admin' => 'Admin',
        'User' => 'User',
    );


    $config['custom']['status'] = array(
        'Prospect' => 'Prospect',
        'Interview' => 'Interview',
        'Called' => 'Called',
        'Not Matching' => 'Not Matching',
        'Others' => 'Others',
    );


    $config['custom']["attachment"] = array(
        'upload_path' => 'assets/uploads/attachments/',
        'allowed_types' => 'pdf',
        'overwrite' => TRUE,
        'default' => ''
    );


    