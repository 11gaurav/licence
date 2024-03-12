<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    /*
      | -------------------------------------------------------------------------
      | URI ROUTING
      | -------------------------------------------------------------------------
      | This file lets you re-map URI requests to specific controller functions.
      |
      | Typically there is a one-to-one relationship between a URL string
      | and its corresponding controller class/method. The segments in a
      | URL normally follow this pattern:
      |
      |	example.com/class/method/id/
      |
      | In some instances, however, you may want to remap this relationship
      | so that a different class/function is called than the one
      | corresponding to the URL.
      |
      | Please see the user guide for complete details:
      |
      |	https://codeigniter.com/user_guide/general/routing.html
      |
      | -------------------------------------------------------------------------
      | RESERVED ROUTES
      | -------------------------------------------------------------------------
      |
      | There are three reserved routes:
      |
      |	$route['default_controller'] = 'welcome';
      |
      | This route indicates which controller class should be loaded if the
      | URI contains no data. In the above example, the "welcome" class
      | would be loaded.
      |
      |	$route['404_override'] = 'errors/page_missing';
      |
      | This route will tell the Router which controller/method to use if those
      | provided in the URL cannot be matched to a valid route.
      |
      |	$route['translate_uri_dashes'] = FALSE;
      |
      | This is not exactly a route, but allows you to automatically route
      | controller and method names that contain dashes. '-' isn't a valid
      | class or method name character, so it requires translation.
      | When you set this option to TRUE, it will replace ALL dashes in the
      | controller and method URI segments.
      |
      | Examples:	my-controller/index	-> my_controller/index
      |		my-controller/my-method	-> my_controller/my_method
     */
    $route['default_controller'] = 'admin/user/login';

    /*     * **********************************Admin Side*************************************** */
    $route['/'] = 'admin/user/login';
    $route['admin'] = 'admin/user/login';
    $route['admin/dashboard'] = 'admin/index/dashboard';
    // $route['admin/change-password'] = 'admin/useraccount/change_password';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;
    $route['saveLicense']='admin/Ilicense/saveLicense';
    $route['viewLicense/(:num)']='admin/Ilicense/viewLicense/$1';
    $route['IlicenseList']='admin/Ilicense/listAllLicense';
    $route['add-user-form']='admin/User/add_user';
    $route['editUser/(:num)']='admin/User/add_user/$1';
    $route['deleteUser/(:num)']='admin/User/delete_user/$1';
    // $route['saveuser']='admin/User/save_user';
    $route['user_list']='admin/User/user_list';
    $route['userlist']='admin/User/listAlluser';
    $route['makeUserActive/(:num)']='admin/User/make_user_active/$1';
    $route['makeUserInactive/(:num)']='admin/User/make_user_inactive/$1';
    
    $route['changePasswordSave']='admin/User/changePasswordSave';
    $route['extendsLicense']='admin/Ilicense/extendsLicense';
    $route['sevenDayExtend']='admin/Ilicense/sevenDayExtend';
    $route['extendLicenseView/(:num)']='admin/Ilicense/extendLicenseView/$1';
    $route['editExtendlicense/(:num)']='admin/Ilicense/editExtendlicense/$1';
    $route['updateExtendlicense']='admin/Ilicense/updateExtendlicense';

   // plan
   $route['add-plan-form']='admin/Ilicense/add_plan_form';
   $route['saveplan']='admin/Ilicense/save_plan';
   $route['updateplan/(:num)']='admin/Ilicense/update_plan/$1';
   $route['activePlanlist']='admin/Ilicense/activePlanlist';
   $route['inactivePlanlist']='admin/Ilicense/inactivePlanlist';
   $route['makePlanInactive/(:num)']='admin/Ilicense/makePlanInactive/$1';
   $route['editplan/(:num)']='admin/Ilicense/editplan/$1';
   $route['check-plan-exist']='admin/Ilicense/check_plan_exist';