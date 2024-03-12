<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends MY_Controller
{

    private $_users_listing_headers = 'users_listing_headers';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        // $this->load->library('Datatable');
    }

    public function index()
    {
        redirect('/admin/user/validate/');
    }

    public function login()
    {
        $message = $this->session->flashdata('login_operation_message');
        $this->load->setTemplate('blank');
        $this->load->view('login-form', array("message" => $message));
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('admin/user/login', 'refresh');
    }
    public function changePassword()
    {
        $this->load->view('changepassword');
    }
    public function changePasswordSave(){
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[4]|max_length[12]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_ps', 'Confirm Password', 'trim|required|min_length[4]|max_length[12]');
        if ($this->form_validation->run() == false) {
            $data['message'] = validation_errors();
        }

        $userId =  $this->session->userdata('user_id');
        $oldPassword = md5($this->input->post('oldpassword'));
        $response = $this->User_model->checkOldPassword($userId,$oldPassword);
        if($response == true){
            $data  = array(
                'password' =>md5($this->input->post('password'))
            );
            $this->User_model->passwordUpdate($userId,$data);
            $data['success'] = "Password SuccessFully Updated";
        }
        else
        {
            $data['failure'] = "Your Enter Old Pawword Incorrect";
        }
        $this->load->view('changepassword',$data);
        
         
    }

    public function validate()
    {
        $dataArray[] = array();
        $this->form_validation->set_rules('username', 'User name', 'required'); //|min_length[4]|max_length[50]
        $this->form_validation->set_rules('password', 'Password', 'required'); //|min_length[4]|max_length[50]

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('login_operation_message', $this->lang->line('error_login_auth'));
            $this->load->view('login-form', $dataArray);
        } else {
            $encrypted_password = md5($this->input->post('password'));
            $userdata = $this->User_model->login($this->input->post('username'), $encrypted_password);

            if ($userdata === false) {
                $message = $this->lang->line('error_login_auth');
                $this->session->set_flashdata('login_operation_message', $message);
                $this->session->set_flashdata('my_op', $message);
                redirect('admin/user/login');
            } else if ($userdata == 'disabled') {
                $message = $this->lang->line('error_login_disabled_user');
                $this->session->set_flashdata('login_operation_message', $message);
                $this->session->set_flashdata('my_op', $message);
                redirect('admin/user/login');
            } else {

                $session_user_data = array(
                    'user_id' => $userdata['admin_id'],
                    'user_name' => $userdata['name'],
                    //                       'email' => $userdata['email'],
                    'user_type' => $userdata['user_type'],
                );

                $this->session->set_userdata($session_user_data);

                redirect('admin/index/dashboard/');
            }
        }
    }

    public function listusers_data()
    {
        // $this->load->library('Datatable');
        $arr = $this->config->config[$this->_users_listing_headers];
        $cols = array_keys($arr);
        $pagingParams = $this->datatable->get_paging_params($cols);
        $resultdata = $this->User_model->get_all_user($pagingParams);
        $json_output = $this->datatable->get_json_output($resultdata, $this->_users_listing_headers);

        $this->load->setTemplate('json');
        $this->load->view('json', $json_output);
    }

    function list_users()
    {

        $message = $this->session->flashdata('member_operation_message');
        $table_config = array(
            'source' => site_url('admin/user/listusers_data'),
            'datatable_class' => $this->config->config["datatable_class"],
        );
        $dataArray = array(
            'table' => $this->datatable->make_table($this->_users_listing_headers, $table_config),
            'message' => $message
        );

        $dataArray['local_css'] = array(
            'dataTables.bootstrap',
            'responsive.bootstrap',
            'buttons.bootstrap',
            'select.bootstrap',
        );

        $dataArray['local_js'] = array(
            'dataTables',
            'dataTables.FilterOnReturn',
            'dataTables.bootstrap',
            'dataTables.responsive',
            'responsive.bootstrap',
        );

        $dataArray['table_heading'] = "Users List";
        $dataArray['form_action'] = current_url();
        $dataArray['new_entry_link'] = base_url() . 'admin/user/add_user';
        $dataArray['new_entry_caption'] = "Add User";
        $this->load->view('users-list', $dataArray);
    }

    public function forgot_password()
    {
        $dataArrray = array();
        $email = $this->input->post('email');
        //get user data
        $user_data = $this->User_model->get_user_by_email($email);

        if (!empty($user_data)) {

            //generate new password
            $new_password = generateRandomString(8);
            //update user password
            $dataValues = array(
                'admin_id' => $user_data['admin_id'],
                'password' => md5($new_password)
            );
            $this->User_model->save_user($dataValues);

            //                $this->load->model('Email_template_model');
            $this->load->library('commonlibrary');
            //                $email_details = $this->Email_template_model->get_email_template_by_key('forgot_password');
            //                if (!empty($email_details))
            //                {
            $email_body = '<p>Your login info:</p>
                    <p>Username: {{user_name}}</p>
                    <p>Password: {{password}}</p>';

            $subject = "Forgot Password from PMS";
            $search = array("{{user_name}}", "{{password}}");
            //                    $search = array("{{user_name}}", "{{name}}", "{{email}}", "{{password}}", "{{user_type}}");
            //                    $replace = array($user_data['username'], $user_data['name'], $user_data['email'], $new_password, mlLang($user_data['user_type']));
            $replace = array($user_data['username'], $new_password);
            $content = str_replace($search, $replace, stripcslashes($email_body));
            $attachment = '';

            $this->commonlibrary->sendmail($user_data['email'], $user_data['username'], $subject, $content, "html", 'PMS', 'Admin', '', $attachment);
            //                }
            $return['status'] = "true";
        } else {
            $return['status'] = "false";
        }
        echo json_encode($return);
    }

    public function add_user($admin_id = null)
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] != 'Admin') {
                redirect(base_url('admin/dashboard'));
            }
        }
        $this->form_validation->set_rules("user_name", "Name", 'required');
        $this->form_validation->set_rules("username", "User Name", "required");
        
        $dataArray = array();
        // $dataArray["user_type_arr"] = add_blank_option(get_custom_config_item('user_types'), '-Select-');
        // $dataArray["arr_admin_status"] = add_blank_option(get_custom_config_item('status'), '-Select-');

        if (empty($admin_id)) {
            $this->form_validation->set_rules("password", "Password", "required");
            $this->form_validation->set_rules('user_email', 'Email', 'required|trim');
        }

        if ($this->form_validation->run() == false) {

            $dataArray['form_caption'] = "Add Users";
            $dataArray['form_action'] = current_url();

            if (!empty($admin_id)) {
                $dataArray['form_caption'] = 'Edit USer';
                $admin_data = $this->User_model->get_admin_by_id($admin_id);

                $dataArray['user_name'] = $admin_data['name'];
                $dataArray['user_email'] = $admin_data['email'];
                $dataArray['username'] = $admin_data['username'];
                $dataArray['admin_id'] = $admin_id;
            }

            $this->load->view('userform', $dataArray);
        } else {
            $password = $this->input->post('password');
            $dataValues = array(
                'name' => $this->input->post('user_name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('user_email'),
            );

            if (!empty($password)) {
                $dataValues['password'] = MD5($password);
            }

            if (!empty($admin_id)) {
                $dataValues['admin_id'] = $admin_id;
            } else {
                $dataValues['created_at'] = date('Y-m-d H:i:s');
                $dataValues['user_type'] = 'User';
            }
            $this->User_model->save_admin($dataValues);
            $this->session->set_flashdata('member_operation_message', 'User saved successfully.');
            redirect(base_url('userlist'));
        }
    }

    function delete_user($admin_id)
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] != 'Admin') {
                redirect(base_url('admin/dashboard'));
            }
        }
        $status = $this->User_model->delete_user_by_id($admin_id);
        if ($status == true) {
            $this->session->set_flashdata('member_operation_message', 'User deleted successfully');
            redirect('userlist');
        } else {
            show_error('The User Details you are trying to delete does not exist.');
        }
    }

    public function change_user_status()
    {
        $dataValues = array();
        $id = $this->input->post("id");
        $status = $this->input->post("status");

        $dataArray = array(
            "admin_id" => $id,
            "status" => $status == "Active" ? "Disabled" : "Active",
        );
        $admin_id = $this->User_model->save_user($dataArray);
        $dataValues['active_id'] = "active_status_" . $admin_id;
        $dataValues['add_class_name'] = $status == "active" ? "fa-toggle-off" : "fa-toggle-on";
        $dataValues['remove_class_name'] = $status == "active" ? "fa-toggle-on" : "fa-toggle-off";
        $dataValues['data_attr'] = ($status == "active") ? "disabled" : "active";
        if (!empty($admin_id)) {
            $dataValues['message'] = "<div class='alert alert-success'>Update Successfully</div>";
        } else {
            $dataValues['message'] = "<div class='alert alert-danger'>Cannot update please try again later</div>";
        }
        echo json_encode($dataValues);
    }

    function exportUserList()
    {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "AllUsersList.csv";

        $result = $this->User_model->prepareAllUsersCsv();
    }

    function check_email_remote($admin_id = Null)
    {
        $user['email'] = $this->input->post('email');
        $user['id'] = $admin_id;
        return check_email_exist($user);
    }

    public  function listAlluser()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] != 'Admin') {
                redirect(base_url('admin/dashboard'));
            }
        }
        $data['user_list'] = $this->User_model->getAllUserData();
        $this->load->view("listAlluser", $data);
        // p($data['user_list']);
    }
    public function make_user_inactive($id)
    {
        $data = array(
            'status' => 'Inactive',
        );
        $this->load->User_model->update_user_status($data, $id);
        redirect(base_url('userlist'));
    }
    public function make_user_active($id)
    {
        $data = array(
            'status' => 'Active',
        );
        $this->load->User_model->update_user_status($data, $id);
        redirect(base_url('userlist'));
    }
}
