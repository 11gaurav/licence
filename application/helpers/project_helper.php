<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    function check_access($module, $user_type, $permission_type, $redirect_status = false, $redirect_to = "admin/dashboard")
    {
        $CI = & get_instance();

        $return = false;

        if (!empty($module) && !empty($user_type) && !empty($permission_type))
        {
            if ($user_type == "1")
            {
                $return = true;
            }
            else
            {
                $CI->load->model("Usertype_model");
                $return = $CI->Usertype_model->get_user_permission($module, $user_type, $permission_type);
            }
        }
        if (empty($return) && !empty($redirect_status))
        {
            redirect($redirect_to);
        }
        else
            return $return;
    }

    function get_loggedin_admin_user_data()
    {
        $CI = & get_instance();
        $userdata = (array) $CI->session->userdata;
        return $userdata;
    }

    function get_date($date)
    {
        $return = '';
        if (!empty($date))
        {
            $return = date('Y-m-d', strtotime($date));
        }
        return $return;
    }

    function get_site_logo()
    {
        $ci = & get_instance();
        $ci->load->library("commonlibrary");
        $site_data = ''; // get_site_details();
        $return_logo = '';
        if (!empty($site_data))
        {
            $logo = $site_data['logo'];
            $site_logo_config = get_custom_config_item('site_logo');
            $return_logo = base_url() . $site_logo_config['upload_path'] . $site_logo_config['default'];
            if (!empty($logo))
            {
                $file = $site_logo_config['upload_path'] . $logo;
                $is_logo_valid = $ci->commonlibrary->is_file_exists($file);
                if (!empty($is_logo_valid))
                {
                    $return_logo = base_url() . $file;
                }
            }
        }
        return $return_logo;
    }

    function check_loggedin_user($key)
    {
        $CI = & get_instance();

        if (!empty($CI->session->userdata[$key]))
        {
            $return = TRUE;
        }
        else
        {
            $return = FALSE;
        }

        return $return;
    }

    function check_loggedin_userdata($key)
    {
        $CI = & get_instance();

        if (!empty($CI->session->userdata[$key]))
        {
            $return = $CI->session->userdata[$key];
        }
        else
        {
            $return = array();
        }

        return $return;
    }

    function check_email_exist($user)
    {
        $ci = & get_instance();

        $ci->load->model('admin/user_model');
        $return = $ci->User_model->check_email_exist($user);
        if ($return > 0)
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
    }

    function check_phone($number)
    {

        $result = preg_match('/^[0-9\-\(\)\ ]+$/', $number);
        if ($result == '0')
        {
            echo json_encode(FALSE);
        }
        else
        {
            echo json_encode(TRUE);
        }
    }

    function check_all_email($user)
    {
        $ci = & get_instance();

        $ci->load->model('admin/member_model');
        $return = $ci->member_model->check_email_exist($user);
        if ($return > 0)
        {
            echo json_encode(true);
        }
        else
        {
            echo json_encode(false);
        }
        //return $return;
    }

    function get_preview_link($image, $config = '', $base_url = '')
    {
        $image_custom = get_custom_config_item($config);
        $system_path = '';
        $preview_link = '';
        $tmp_base_url = '';
        if (!isset($base_url) || $base_url == '')
        {
            $tmp_base_url = base_url();
        }
        else
        {
            $tmp_base_url = $base_url;
        }
        if (!empty($image))
        {
            $system_path = set_realpath($image_custom["upload_path"]);
            $image_path = $system_path . $image;
            $img_url = base_url() . $image_custom['upload_path'] . $image;
            if (file_exists($image_path))
            {
                $preview_link = '<a rel="' . $tmp_base_url . $image . '" href="' . $img_url . '" class="preview preview_link_show">Click here to preview <i class="action-icon fa fa-image"></i></a>';
            }
        }

        return $preview_link;
    }

    function price_format($price)
    {
        $result = number_format($price);
        return '&pound;' . $result;
    }

    function get_base_url_for_email()
    {
        $url = base_url();
        $arr_url = explode('//', $url);
        $base_url = $arr_url[1];
        return $base_url;
    }

    function is_password_valid($password = '')
    {
        $ci = & get_instance();
        $password = trim($password);

        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';

        if (empty($password))
        {
            $ci->form_validation->set_message('valid_password', 'The Password field is required.');
            return FALSE;
        }
        else if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $ci->form_validation->set_message('valid_password', 'The Password field must be at least one uppercase letter.');
            return FALSE;
        }
        else if (preg_match_all($regex_number, $password) < 1)
        {
            $ci->form_validation->set_message('valid_password', 'The Password field must have at least one number.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function is_super_admin()
    {
        $CI = & get_instance();
        $userdata = (array) $CI->session->userdata;

        if (!isset($userdata['user_type']))
        {
            return false;
        }
        else
        {
            if ($userdata['user_type'] == 'Super Admin')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    function get_login_name()
    {
        $CI = & get_instance();
        $userdata = (array) $CI->session->userdata;
        if (empty($userdata))
        {
            $login_name = '';
        }
        else
        {
            $login_name = $userdata['user_name'];
        }

        return $login_name;
    }

    function get_date_d_m_y($date)
    {
        $return = '';
        if (!empty($date))
        {
            $return = date('d-m-Y', strtotime($date));
        }
        return $return;
    }

//    function get_sigth_date_F_d_Y($date)
//    {
//        $return = '';
//        if (!empty($date))
//        {
//            $return = date('F-d-Y', strtotime($date));
//        }
//        return $return;
//    }

    function get_date_d_m_y_time($date)
    {
        $return = '';
        if (!empty($date))
        {
            $return = date('d-m-Y H:i:s', strtotime($date));
        }
        return $return;
    }

    function get_ip_address()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function get_attachments($epc)
    {
        $property_epc_config = get_custom_config_item('attachment');
        $epc_url = '';
        if (!empty($epc))
        {
            $property_epc_config = get_custom_config_item('attachment');
            $file = $property_epc_config['upload_path'] . $epc;

            if (is_file($file))
            {
                $epc_url = base_url() . $property_epc_config['upload_path'] . $epc;
            }
        }
        return $epc_url;
    }
    