<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ilicense_model extends My_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function savelicense($data)
    {
        $this->db->insert('user_license', $data);
        return $this->db->insert_id();
    }

    public function updateLicense($id, $license)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_license', [
            "license_key" =>  $license,
            "status"  =>  "Active"
        ]);
    }

    public function getLicense($id)
    {

        $this->db->select('user_license.* ,admin.username ,plan.name as plan_name');
        $this->db->from('user_license');
        $this->db->join('admin', 'user_license.created_by =admin.admin_id');
        $this->db->join('plan', 'plan.id = user_license.plan_id', 'left');
        $this->db->where('user_license.id', $id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    public function getAllLicense()
    {
        $this->db->select('license.*, user.name as username,plan.name as plan_name');
        $this->db->join('admin as user', 'user.admin_id = license.created_by');
        $this->db->join('plan', 'plan.id = license.plan_id', 'left');
        return  $this->db->get('user_license as license')->result();
    }
    public function extendsLicense()
    {
        return $this->db->get('user_license')->result();
    }
    public function saveExtendLinces($data)
    {
        $this->db->insert('linces_extend', $data);
    }
    public function updateUserLinces($linces_id, $date)
    {

        $this->db->where('id', $linces_id);
        $this->db->update('user_license', array('end_date' => $date));
    }
    public function getAllExtenddata()
    {

        $this->db->select('liext.*, user.name as username,user_license.company_name');
        $this->db->join('admin as user', 'user.admin_id = liext.created_by');
        $this->db->join('user_license', 'user_license.id = liext.linces_id');
        return  $this->db->get('linces_extend as liext')->result();


        // return $this->db->get('linces_extend')->result();
    }
    public function updateExtendlicense($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_license',  $data);
    }
    public function save_plan($data)
    {
        $this->db->insert('plan', $data);
        return $this->db->insert_id();
    }
    public function update_plan($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('plan', $data);
        return $this->db->insert_id();
    }
    public function getAllplan($status)
    {
        $this->db->select('plan.*, user.name as username,updated_name.name as updated_user');
        $this->db->join('admin as user', 'user.admin_id = plan.created_by');
        $this->db->join('admin as updated_name', 'updated_name.admin_id = plan.updated_by');
        $this->db->where('plan.status',$status);
        return $this->db->get('plan')->result();
    }
    public function makePlanInactive($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('plan',  $data);
    }
    public function getPlan_row($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('plan')->result_array();
    }
    public function plan_name()
    {
        $this->db->select('name,id');
        return $this->db->get('plan')->result();
    }
    public function check_plan_exist($plan_name)
    {
        $this->db->select('name');
        $this->db->where('name',$plan_name);
        return $this->db->get('plan')->num_rows();
    }
}
