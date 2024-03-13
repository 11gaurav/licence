<?php

    if (!defined('BASEPATH'))
    {
        exit('No direct script access allowed');
    }

    class My_Controller extends CI_Controller
    {

        /**
         * $ajaxRequest : this is the variable which contains the requested page is via ajax call or not. by default it is false and will be set as false and will be set as true in constructor after validating the request type.
         *
         */
        public $ajaxRequest = false;
        public $template = NULL;

        public function __construct()
        {
            parent::__construct();

            /**
             * validating the request type is ajax or not and setting up the $ajaxRequest variable as true/false.
             *
             * */
            $requestType = $this->input->server('HTTP_X_REQUESTED_WITH');
            $this->ajaxRequest = strtolower($requestType ?? "") == 'xmlhttprequest';
            /**
             * set the default template as blank when the request type is ajax
             */
            if ($this->ajaxRequest === true)
            {
                $this->load->setTemplate('blank');
            }

            $module = $this->router->fetch_module();

            switch ($module)
            {
                case 'public':
                    $this->load->setTemplate('public');
                    break;
            }
        }

        public function _remap($method, $params = array())
        {
            $this->load->helper('url');

            $module = $this->router->fetch_module();
            $class = $this->router->fetch_class();


            if ($module == 'admin')
            {
                $redirectToLogin = true;

                if (($method == 'login' && is_array($params) && count($params) == 1 && $params[0] == 'redirectForcefully') ||
                    ($method == 'validate' && is_array($params) && count($params) == 1 && $params[0] == 'redirectForcefully') ||
                    ($method == 'forgot_password')
                )
                {
                    $redirectToLogin = false;
                }

                $method_check = array('', 'login', 'logout', 'validate');
                $uri_method = $this->uri->segment(3);

                if ($redirectToLogin == true)
                {

                    $loggedin = $this->session->userdata('user_id');
                    if (empty($loggedin))
                    {
                        $message = $this->session->flashdata('login_operation_message');
                        if (!empty($message))
                        {
                            $this->session->set_flashdata('login_operation_message', $message);
                        }
                        redirect('admin/user/login/redirectForcefully/');
                    }
                }

                if (!empty($_SESSION['user_id']) && $_SESSION['user_type'] == 'User')
                {
                    $menu = array();
                    $menu_temp = array();
                    $privileges_data = array();
                    $this->load->model('User_model');
                    $privileges_data = $this->User_model->get_user_privileges_all_view_list_by_id($_SESSION['user_id']);
                    $privileges_data1 = $this->User_model->get_user_privileges_all_view_list_by_id1($this->session->userdata('user_id'));
                    foreach ($privileges_data1 as $key => $value1)
                    {
                        $menu_temp[$value1['menu_name']][] = $value1['privilege_name'];
                    }

                    foreach ($privileges_data as $priviledge)
                    {
                        $menu[] = $priviledge['menu_name'];
                    }
                    $menu[] = 'dashboard';
                    $menu_temp['dashboard'] = array('dashboard');

                    if ($method != 'dashboard' && $method != 'logout' && $method != 'change_password')
                    {
                        $url_string = uri_string();
                        $url_id = null;
                        $url_id = strstr($url_string, 'add_' . $class);


                        if (!(in_array($class, $menu)))
                        {
                            redirect('admin/dashboard');
                        }
                    }
                }
            }
            elseif ($module == 'public')
            {
                /*                 * *******User authentication code ********** */
                $arr = array(
                );
                $method_class = ucfirst($class) . '|' . $method;


                if (in_array($method_class, $arr))
                {
                    redirect(base_url());
                }
                /*                 * *******User authentication code ********** */
            }

            if (method_exists($this, $method))
            {
                call_user_func_array(array($this, $method), $params);
            }
            else
            {
                show_404();
            }
        }

        public function _check_user_role($method, $module)
        {

            $config_user_access = get_custom_config_item('user_access', 'menu_config');
            $url_class = $this->uri->segment(2);

            if (!empty($_SESSION['user_type']) &&
                in_array($url_class, $config_user_access[$_SESSION['user_type']])
            )
            {
                
            }
            else
            {
                redirect('admin/dashboard');
            }
        }

    }
    