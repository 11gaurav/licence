<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!isset($config)) {
    $config = array();
}

$config['datatable_class'] = "dyntable table dt-responsive nowrap dataTable no-footer dtr-inline";

// $config['class_listing_headers'] = array(
//     'class_name' => array(
//         'isSortable' => TRUE,
//         'jsonField' => 'class_name',
//         'width' => '90%'
//     ),
//     'edit' => array(
//         'isSortable' => FALSE,
//         'systemDefaults' => TRUE,
//         'type' => 'EDIT_ICON',
//         'isLink' => TRUE,
//         'linkParams' => array('class_id'),
//         'linkTarget' => 'admin/student/add_student/',
//         'width' => '5%',
//         'align' => 'center'
//     ),
//     'delete' => array(
//         'isSortable' => FALSE,
//         'systemDefaults' => TRUE,
//         'type' => 'DELETE_ICON',
//         'confirmBox' => TRUE,
//         'isLink' => TRUE,
//         'linkParams' => array('class_id'),
//         'linkTarget' => 'admin/student/delete_student/',
//         'width' => '5%',
//         'align' => 'center'
//     ),

// );
$config['section_listing_headers'] = array(
    'Section_id' => array(
        'isSortable' => TRUE,
        'jsonField' => 'section_id',
        'width' => '90%'
    ),
    'section_name' => array(
        'isSortable' => TRUE,
        'jsonField' => 'section_name',
        'width' => '90%'
    ),
    'type' => array(
        'isSortable' => TRUE,
        'jsonField' => 'type',
        'width' => '90%'
    ),
    'Gender' => array(
        'isSortable' => TRUE,
        'jsonField' => 'gender',
        'width' => '90%'
    ),
    'edit' => array(
        'isSortable' => FALSE,
        'systemDefaults' => TRUE,
        'type' => 'EDIT_ICON',
        'isLink' => TRUE,
        'linkParams' => array('section_id'),
        'linkTarget' => 'admin/section/add_section/',
        'width' => '5%',
        'align' => 'center'
    ),
    'delete' => array(
        'isSortable' => FALSE,
        'systemDefaults' => TRUE,
        'type' => 'DELETE_ICON',
        'confirmBox' => TRUE,
        'isLink' => TRUE,
        'linkParams' => array('section_id'),
        'linkTarget' => 'admin/Section/delete_section/',
        'width' => '5%',
        'align' => 'center'
    ),
);
$config['class_listing_headers'] = array(
    'class_id' => array(
        'isSortable' => TRUE,
        'jsonField' => 'class_id',
        'width' => '90%'
    ),
    'class_name' => array(
        'isSortable' => TRUE,
        'jsonField' => 'class_name',
        'width' => '90%'
    ),
    'edit' => array(
        'isSortable' => FALSE,
        'systemDefaults' => TRUE,
        'type' => 'EDIT_ICON',
        'isLink' => TRUE,
        'linkParams' => array('section_id'),
        'linkTarget' => 'admin/section/add_class/',
        'width' => '5%',
        'align' => 'center'
    ),
    'delete' => array(
        'isSortable' => FALSE,
        'systemDefaults' => TRUE,
        'type' => 'DELETE_ICON',
        'confirmBox' => TRUE,
        'isLink' => TRUE,
        'linkParams' => array('section_id'),
        'linkTarget' => 'admin/Section/delete_section/',
        'width' => '5%',
        'align' => 'center'
    ),
);
