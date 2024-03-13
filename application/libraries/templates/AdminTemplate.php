<?php

    if (!defined('BASEPATH'))
    {
        exit('No direct script access allowed');
    }
    /**
     * Default template
     */
    require_once 'template.php';

    /**
     * Default template implementation.
     *
     * It is the default renderer of all the pages if any other renderer is not used.
     */
    class AdminTemplate extends Template
    {

        public $_CI;
        public function __construct()
        {
            parent::__construct();

            $this->_CI = &get_instance();
        }

        public function render($view, array $data = array())
        {
            $this->_CI->load->model('User_model');
            $this->_CI->load->library('Commonlibrary');
            $return_val = $this->CI->load->viewPartial($view, $data);

            $data['template_content'] = $return_val;

            $css_tags = $this->collectCss("admin", isset($data['local_css']) ? $data['local_css'] : array());
            $data['template_css'] = implode("", $css_tags);
            $script_tags = $this->collectJs("admin", isset($data['local_js']) ? $data['local_js'] : array());

            $data['template_js'] = implode("", $script_tags);

            $user_data = get_loggedin_admin_user_data();
            // $user_type = $user_data['user_type'];
            $data['user_data'] = $user_data;

            $uri_segment_2 = $this->CI->uri->segment(2);

            if (empty($data['template_title']))
            {
                $data['template_title'] = '';
            }

            $this->CI->load->library('session');
            $this->CI->load->helper('url');

            $data['uri_segment_2'] = $this->CI->uri->segment(2);
            $data['uri_segment_3'] = $this->CI->uri->segment(3);

            $config_user_access = get_custom_config_item('user_access', 'menu_config');

            $user_role = $this->CI->session->userdata('user_type');

            if (!empty($user_role))
            {
//                $data['current_user_access'] = $config_user_access[$user_role];
            }
            
//            $data["sidebar"] = $this->CI->load->viewPartial($this->viewPath . 'admin-sidebar', $data);

//            p($this->CI->session->userdata('user_id'));
//            $privileges_data = $this->CI->User_model->get_user_privileges_all_view_list_by_id($this->CI->session->userdata('user_id'));
//            $privileges_data1 = $this->CI->User_model->get_user_privileges_all_view_list_by_id1($this->CI->session->userdata('user_id'));
////            p($data);
//
//            $menu = array();
//            foreach($privileges_data as $priviledge)
//            {
//                $menu[] = $priviledge['menu_name'];
//            }
//            
//
//            $data['menu_temp'] = $privileges_data1;
//            
//           // p($privileges_data1);
//            $data['menu'] = $menu;
////            p($_SESSION);
            $user_type = $this->CI->session->userdata('user_type');
//            p($user_type);
            $data['user_type'] = $user_type;
            $data['template_header'] = $this->CI->load->viewPartial($this->viewPath . 'header', $data);

            $data['template_footer'] = $this->CI->load->viewPartial($this->viewPath . 'footer', $data);

            $return_val = $this->CI->load->viewPartial($this->viewPath . $this->masterTemplate, $data);

            return $return_val;
        }

    }
    