<?php

    if (!defined('BASEPATH')) exit('No direct script access allowed');
    /**
     * Default template
     */
    require_once 'template.php';

    /**
     * Default template implementation.
     * 
     * It is the default renderer of all the pages if any other renderer is not used.
     */
    class PublicTemplate extends Template
    {

        public function __construct()
        {
            parent::__construct();

            $this->_CI = & get_instance();
            $this->viewPath = "templates/public/";
        }

        public function render($view, array $data = array())
        {
            $this->CI->load->library('session');
            $this->CI->load->library('form_validation');
            $this->CI->load->helper('url');
            $this->CI->load->model('admin/Configuration_model');
            $this->CI->load->model('admin/Service_model');
            // $this->CI->load->library('Commonlib');

            $return_val = $this->CI->load->viewPartial($view, $data);

            $data['template_content'] = $return_val;

            $css_tags = $this->collectCss("public", isset($data['local_css']) ? $data['local_css'] : array());
            $data['template_css'] = implode("", $css_tags); //implode("\n", $css_tags);
            $script_tags = $this->collectJs("public", isset($data['local_js']) ? $data['local_js'] : array());

            $configuration_data = $this->CI->Configuration_model->get_web_config();
            $data['configuration_data']=$configuration_data;
            if (isset($data['template_title']))
            {
                $data['template_title'] = $data['template_title'];
            }

            $data['template_js'] = implode("", $script_tags); //implode("\n", $script_tags);

            $session_data = check_loggedin_user('member_data');
            if (!empty($session_data))
            {
                // $header = $this->CI->load->viewPartial($this->viewPath . 'hubCentreHeader', $data);
            }
            $controller = $this->CI->router->fetch_class();
            $action = $this->CI->router->fetch_method();
            
            //from backend
            $data['cms_data'] = get_cms_content('about-us'); 
            $contact_data = $this->CI->Configuration_model->get_web_config();

            $data['contact_data'] = $contact_data;
            $data['service_data'] = $this->CI->Service_model->get_all_service_data();
            
            $data['mail_id'] = get_custom_config_item('mail_id');
            //****************
//        $header = $this->CI->load->viewPartial($this->viewPath . 'header', $data);
//            $data['template_footer'] = $this->CI->load->viewPartial($this->viewPath . 'footer', $data);

            //set header accd to url
            $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $base_url = base_url();

            if ($base_url == $current_url)
            {
                $header = $this->CI->load->viewPartial($this->viewPath . 'index-header', $data);
                $footer = $this->CI->load->viewPartial($this->viewPath . 'index-footer', $data);
            }
            else
            {
                $header = $this->CI->load->viewPartial($this->viewPath . 'header', $data);
                $footer = $this->CI->load->viewPartial($this->viewPath . 'footer', $data);
            }
            
            $data['template_header'] = $header;
            $data['template_footer'] = $footer;

            $meta_data = $this->collect_meta_data(isset($data['local_meta_data']) ? $data['local_meta_data'] : array(), $arr_meta_data = array());
            $data['template_meta_data'] = implode("", $meta_data);


            $meta_data = $this->collect_meta_data(isset($data['local_meta_data']) ? $data['local_meta_data'] : array(), $arr_meta_data = array());
            $data['template_meta_data'] = implode("", $meta_data);

            $return_val = $this->CI->load->viewPartial($this->viewPath . $this->masterTemplate, $data);

            return $return_val;
        }

    }
    