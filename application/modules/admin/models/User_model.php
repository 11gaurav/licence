<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends My_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // public function get_all_user($paging_params = array())
    // {
    //     $this->db->select('SQL_CALC_FOUND_ROWS 1', false);
    //     $this->db->select('a.*');
    //     $this->db->from('admin as a');
    //     $this->db->order_by('a.admin_id', 'ASC');

    //     if (!empty($paging_params['order_by']))
    //     {

    //         if (empty($paging_params['order_direction']))
    //         {
    //             $paging_params['order_direction'] = '';
    //         }

    //         switch ($paging_params['order_by'])
    //         {
    //             default:
    //                 $this->db->order_by($paging_params['order_by'], $paging_params['order_direction']);
    //                 break;
    //         }
    //     }
    //     $search = $paging_params['search'];
    //     if (!empty($search))
    //     {

    //         $this->db->like('name', $search);
    //     }


    //     $return = $this->get_with_count(null, $paging_params['records_per_page'], $paging_params['offset']);
    //     return $return;
    // }

    // function save_user($arr_user)
    // {
    //     $return = null;
    //     if (isset($arr_user['admin_id']))
    //     {
    //         $this->db->where('admin_id', $arr_user['admin_id']);
    //         $this->db->update('admin', $arr_user);
    //         $return = $arr_user['admin_id'];
    //     }
    //     else
    //     {
    //         $this->db->insert('admin', $arr_user);
    //         $return = $this->db->insert_id();
    //     }

    //     return $return;
    // }
    function save_user($data)
    {
        $this->db->insert('admin', $data);
        return "success";
    }

    function checkOldPassword($userId, $oldPassword)
    {
        $this->db->where('admin_id', $userId);
        $this->db->where('password', $oldPassword);
        return $this->db->get('admin')->row_array();
    }


    public function checkOldPass($userId, $old_password)
    {

        $this->db->where('admin_id', $userId);
        $this->db->where('password', $old_password);
        return $query = $this->db->get('admin');
    }

    function  passwordUpdate($userId, $data)
    {

        $this->db->where('admin_id', $userId);
        $this->db->update('admin', $data);
        // p($this->db->last_query());
    }

    // function get_user_by_id($admin_id)
    // {
    //     $return = array();
    //     if (!empty($admin_id))
    //     {
    //         $this->db->select('*');
    //         $this->db->from('admin');
    //         $this->db->where('admin_id', $admin_id);
    //         $return = $this->db->get()->row_array();
    //     }
    //     return $return;
    // }

    function get_user_by_email($email)
    {
        $return = array();
        if (!empty($email)) {
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('email', $email);
            $return = $this->db->get()->row_array();
        }

        return $return;
    }

    function delete_user_by_id($user_id)
    {
        $return = FALSE;
        if (!empty($user_id)) {
            $this->db->where('admin_id', $user_id);
            $this->db->delete('admin');
            $return = TRUE;
        }
        return $return;
    }

    /*
         * User Login
         */

    public function login($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('status', 'Active');
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {

            $row = $query->row_array();
            return $row;
        } else {

            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get('admin');
            if ($query->num_rows() > 0) {
                return 'disabled';
            } else {
                return false;
            }
            //return FALSE;
        }
    }

    function get_count_co_form($table, $editor_data = array(), $project_data = array(), $project = "")
    {
        //p($project);
        $count = 0;
        $this->db->select('count(id) as count');
        $this->db->from($table);
        $this->db->where('archived', 'no');
        if ($this->session->userdata('user_type') == 'editor') {
            $this->db->where('editor_id', $this->session->userdata('user_id'));
        }

        if ($this->session->userdata('user_type') == 'client') {
            $this->db->where('client_name', $this->session->userdata('user_id'));
        }

        if (!empty($editor_data)) {
            foreach ($editor_data as $editor) {
                $editor_id[] = $editor['editor_id'];
            }
            $this->db->where_in('editor_id', $editor_id);
        }

        if (!empty($project_data)) {
            foreach ($project_data as $projects) {
                $project_id[] = $projects['project_id'];
            }

            $this->db->where_in('project_name', $project_id);
        }
        if (!empty($project)) {
            $this->db->where('project_name', $project);
        }

        $return = $this->db->get()->row_array();

        return $return['count'];
    }

    function prepareAllUsersCsv()
    {
        $all_users_list = $this->allUsers();
        //p($co_form_list);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"COFormList.csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        //            fputcsv($handle, array(
        //                'RC PO Number', 'Change Order No.', 'Date', 'Original PO Value($)', 'Amount Requested($)', 'Revised PO Budget(if approved)($)', 'Brief Description Of Change', 'Approval Status', 'Date', 'Issued to RC', 'Client Approval Status', 'Date'
        //            ));
        fputcsv($handle, array(
            'Name', 'Email', 'User Type', 'Status'
        ));

        foreach ($all_users_list as $record) {
            $resultarray['name'] = $record->name;
            $resultarray['email'] = $record->email;
            $resultarray['user_type'] = $record->user_type;
            $resultarray['status'] = $record->status;
            //p($resultarray);
            if ($resultarray) {
                fputcsv($handle, $resultarray);
                //p("hfhh");
            }
        }

        fclose($handle);
    }

    public function allUsers()
    {
        $return = NULL;
        $this->db->select('u.*');
        $this->db->from('admin as u');
        $return = $this->db->get()->result();
        //p($this->db->last_query());

        return $return;
    }

    //        //***************************
    //        public function get_outlet_by_user_id($admin_id)
    //        {
    //            $return = array();
    //            $this->db->select('outlet_id');
    //            $this->db->from('user_oulet_trans');
    //            $this->db->where('user_id', $admin_id);
    //            $result = $this->db->get()->row_array();
    //            return $result;
    //        }
    //    public function get_admin_by_id($admin_id)
    //    {
    //        $return = NULL;
    //        if (!empty($admin_id))
    //        {
    //            $this->db->select('a.*');
    //            $this->db->from('admin as a');
    //            $this->db->where('admin_id', $admin_id);
    //            $return = $this->db->get()->row_array();
    //        }
    //        return $return;
    //    }

    public function get_admin_by_id($admin_id)
    {
        $return = NULL;
        if (!empty($admin_id)) {
            $this->db->select('a.*');
            $this->db->from('admin as a');
            $this->db->where('admin_id', $admin_id);
            $return = $this->db->get()->row_array();
        }
        return $return;
    }

    public function save_admin($dataValue, $user_privilege = null)
    {
        //            p($dataValue);
        $return = null;
        if (!empty($dataValue)) {
            if (!empty($dataValue['admin_id'])) {
                $this->db->where('admin_id', $dataValue['admin_id']);
                $this->db->update('admin', $dataValue);
                $return = $dataValue['admin_id'];
            } else {
                $this->db->insert('admin', $dataValue);
                $return = $this->db->insert_id();
            }
            // if (!empty($return))
            // {
            //     if (!empty($user_privilege))
            //     {
            //         $this->save_privilege_trans($return, $user_privilege);
            //     }
            // }
        }
        return $return;
    }

    //        function save_outlet_trans($admin_id, $outlet_arr)
    //        {
    //            $return = null;
    //            if (!empty($outlet_arr) && !empty($admin_id))
    //            {
    //                $this->db->where('user_id', $admin_id);
    //                $this->db->delete('user_oulet_trans');
    //                if (!empty($outlet_arr))
    //                {
    //                    $this->db->insert("user_oulet_trans", $outlet_arr);
    //                    $return[] = $this->db->insert_id();
    //                }
    //            }
    //            return $return;
    //        }

    function save_privilege_trans($admin_id, $privilege_arr)
    {
        $return = null;
        if (!empty($privilege_arr) && !empty($admin_id)) {
            $this->db->where('user_id', $admin_id);
            $this->db->delete('user_privileges');

            //                $this->db->where('user_id', $admin_id);
            //                $this->db->delete('report_lists');

            if (!empty($privilege_arr['userrights'])) {
                foreach ($privilege_arr['userrights'] as $menu => $privileges) {
                    $data = array(
                        'menu_name' => $menu,
                        'user_id' => $admin_id,
                    );
                    foreach ($privileges as $privilege_name => $value) {
                        $data['privilege_name'] = $privilege_name;
                        $this->db->insert('user_privileges', $data);
                    }
                    $return = $this->db->insert_id();

                    //                        if ($menu == 'report')
                    //                        {
                    //                            foreach ($privilege_arr['reports'] as $report_name)
                    //                            {
                    //                                $data_trans = array(
                    //                                    'report_name' => $report_name,
                    //                                    'privilege_id' => $return,
                    //                                    'user_id' => $admin_id,
                    //                                );
                    //                                $this->db->insert('report_lists', $data_trans);
                    //                            }
                    //                        }
                }
            }
        }
        return $return;
    }

    public function check_email_exist($user)
    {
        $return = null;
        if (!empty($user)) {
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('email', $user['email']);
            if (!empty($user['admin_id'])) {
                $this->db->where('admin_id !=', $user['admin_id']);
            }
            $return = $this->db->get()->num_rows();
        }
        return $return;
    }

    public function get_user_array()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->order_by('username');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $data[$row['admin_id']] = $row['username'];
        }
        return $data;
    }

    //        public function get_menu_by_name($menu_name)
    //        {
    //            $return = array();
    //            $this->db->select('menu_id');
    //            $this->db->from('menu');
    //            $this->db->where('menu_name', $menu_name);
    //            $result = $this->db->get()->row_array();
    //            return $result;
    //        }

    public function get_privilege_by_name($privilege_name)
    {
        $return = array();
        $this->db->select('privilege_id');
        $this->db->from('privilege');
        $this->db->where('privilege_name', $privilege_name);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_user_privileges_by_id($user_id)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_user_privileges_all_view_list_by_id($user_id)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $this->db->where('u.privilege_name', 'view');
        $result = $this->db->get()->result_array();

        return $result;
    }

    public function get_user_privileges_all_view_list_by_id1($user_id)
    {
        $return = array();
        $this->db->select('u.menu_name, u.privilege_name');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_user_privileges_view_list_by_id($user_id, $menu_name)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $this->db->where('u.privilege_name', 'view');
        $this->db->where('u.menu_name', $menu_name);
        $result = $this->db->get()->row_array();
        //             p($this->db->last_query());
        return $result;
    }

    public function get_user_privileges_add_list_by_id($user_id, $menu_name)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $this->db->where('u.privilege_name', 'add');
        $this->db->where('u.menu_name', $menu_name);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_user_privileges_edit_list_by_id($user_id, $menu_name)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $this->db->where('u.privilege_name', 'edit');
        $this->db->where('u.menu_name', $menu_name);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_user_privileges_delete_list_by_id($user_id, $menu_name)
    {
        $return = array();
        $this->db->select('u.*');
        $this->db->from('user_privileges as u');
        $this->db->where('u.user_id', $user_id);
        $this->db->where('u.privilege_name', 'delete');
        $this->db->where('u.menu_name', $menu_name);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_user_privileges($admin_id)
    {
        $return = array();
        $result_arr = array();
        $this->db->select('*');
        $this->db->from('user_privileges');
        $this->db->where('user_id', $admin_id);
        $result = $this->db->get()->result_array();
        //            p($result);
        if (!empty($result)) {
            foreach ($result as $details) {
                $menu_name = $details["menu_name"];
                $privilege_name = $details["privilege_name"];

                $result_arr[$menu_name]["privileges"][] = $privilege_name;
            }
        }

        return $result_arr;
    }

    public function get_total_user()
    {
        $count = $this->db->count_all_results('admin');
        return $count;
    }





    public function add_student($class_id = null, $page = null)
    {
        $this->form_validation->set_rules('class_name', 'Class Name', 'required|trim|unique[class.class_name.class_id.' . $this->input->post('class_id') . ' ]');

        $dataArray = array();

        if ($this->form_validation->run() == false) {
            $dataArray['form_caption'] = "Add Class";
            $dataArray['form_action'] = current_url();

            if (!empty($class_id)) {
                $dataArray['form_caption'] = 'Edit Class';
                $student_data = $this->Student_model->get_class_by_id($class_id);
                $dataArray['class_name'] = $student_data['class_name'];
                $dataArray['class_id'] = $class_id;
            }

            $dataArray['local_css'] = array();
            $dataArray['local_js'] = array();

            $this->load->view('student-form', $dataArray);
        } else {
            $class_id = $this->input->post('class_id');
            $dataValues = array(
                'class_name' => $this->input->post('class_name'),
            );
            if ($class_id != "") {
                $dataValues['class_id'] = $class_id;
            } else {
                $dataValues['created_at'] = date('Y-m-d H:i:s');
            }

            $this->Student_model->save_class($dataValues);

            $this->session->set_flashdata('student_operation_message', 'Species saved successfully.');

            if (empty($page)) {
                redirect('admin/student/list_student');
            } else {
                redirect('admin/' . $page);
            }
        }
    }

    public function list_student_data()
    {
        $this->load->library('Datatable');
        $arr = $this->config->config[$this->_class_listing_headers];
        $cols = array_keys($arr);
        $pagingParams = $this->datatable->get_paging_params($cols);
        $resultdata = $this->Student_model->get_all_class($pagingParams);
        $json_output = $this->datatable->get_json_output($resultdata, $this->_class_listing_headers);
        $this->load->setTemplate('json');
        $this->load->view('json', $json_output);
    }

    function list_student()
    {
        $this->load->library('Datatable');
        $message = $this->session->flashdata('student_operation_message');
        $table_config = array(
            'source' => site_url('admin/student/list_student_data'),
            'datatable_class' => $this->config->config["datatable_class"],
        );
        $dataArray = array(
            'table' => $this->datatable->make_table($this->_class_listing_headers, $table_config),
            'message' => $message
        );

        $dataArray['local_css'] = array(
            'dataTables.bootstrap',
        );

        $dataArray['local_js'] = array(
            'dataTables',
            'dataTables.bootstrap',
        );

        $dataArray['table_heading'] = 'Breed List';
        $dataArray['form_action'] = current_url();
        $dataArray['new_entry_link'] = base_url() . 'admin/student/add_student';
        $dataArray['new_entry_caption'] = "Add class";

        $this->load->view('student-list', $dataArray);
    }

    public function getAllUserData()
    {

        $this->db->select('*');
        $this->db->from('admin');
        // $this->db->where('user_type', 'User');
        $this->db->order_by('admin_id', "DESC");
        return  $this->db->get()->result();
    }
    public function update_user_status($data, $id)
    {
        $this->db->where('admin_id', $id);
        $this->db->update('admin',  $data);
    }
}
