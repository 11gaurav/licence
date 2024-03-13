<?php

    if (!defined('BASEPATH'))
    {
        exit('No direct script access allowed');
    }

    class Ilicense extends MY_Controller
    {
        public $session;
        public $Ilicense_model;
        public function __construct()
        {
           
            parent::__construct();
            $this->load->model('Ilicense_model');
            $this->load->library('session');
        }
        public function AddIlicense(){
            $data['plan_name'] = $this->load->Ilicense_model->plan_name();
            $this->load->view('IlicenseForm',$data);
        }

        public function saveLicense(){
            // validation
            $data = array(
                'company_name'=>$this->input->post('company_name'),
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'contact_name'=>$this->input->post('contact_name'),
                'contact_number'=>$this->input->post('contact_number'),
                'start_date'=>$this->input->post('start_date'),
                'end_date'=>$this->input->post('end_date'),
                'plan_id'=>$this->input->post('plan_id'),
                'user_access_token'=>$this->input->post('user_access_token'),
                'user_access_ps'=>$this->input->post('user_access_password'),
                'created_by'=>$this->session->userdata('user_id'),
                'updated_by'=>$this->session->userdata('user_id'),
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
                'status'=>'init',
            );
            $response = $this->load->Ilicense_model->savelicense($data);
            
         
            if($response){

                $this->load->library('license');
                $license = $this->license->generate();
                
                if($this->load->Ilicense_model->updateLicense($response, $license)){
                    redirect("viewLicense/" . $response);
                    exit;
                }
                
            }
            echo "Some error occurred while adding company, Please try after some time.";
            exit;

        }
        public function viewLicense($id){
            // echo "License => ";
            $data['record']= $this->load->Ilicense_model->getLicense($id);     
            $this->load->view('view-license',$data);
        }

        public function listAllLicense()
        {
            $data['getAllLicensesData'] =$this->load->Ilicense_model->getAllLicense();
            $this->load->view('licenselist',$data);
        }

        public function extendsLicense(){
            $uploadDate = $this->input->post('extentDate');
            $date = strtotime($uploadDate);
            $date = strtotime("+7 day", $date);
            $date = date('Y-m-d', $date);
        
            $linces_id =  $this->input->post('linces_id');

            $company = $this->load->Ilicense_model->getLicense($linces_id);

            $company = $company[0];

            if(empty($company["machine_id"])){
                echo "License is not activated on any machine, Hence Machine Id not provided. Please activate this License with machine and then extend";
                exit;
            }

            $this->load->library('license');
            $license = $this->license->extend($company);

            if($license){
                $data = array(
                    'linces_id'=>$this->input->post('linces_id'),
                    'start_date'=>date('Y-m-d'),
                    'end_date'=>$date,
                    'created_by'=>$this->session->userdata('user_id'),
                    'extend_date'=>date('y-m-d'),
                    'extend_user_id'=>$this->session->userdata('user_id'),
                    'extend_license_key'  =>  $license
                );
    
                $this->load->Ilicense_model->saveExtendLinces($data);
                $this->load->Ilicense_model->updateUserLinces($linces_id,$date);

                echo 'success'; exit;
            }

            echo 'fail';exit;

        }

        public function sevenDayExtend(){
            $data['getAllExtenddata'] = $this->load->Ilicense_model->getAllExtenddata(); 
        
            $this->load->view('ilicenseextend',$data);
        }
        public function extendLicenseView($id){
            $data['record']= $this->load->Ilicense_model->getLicense($id);    
            $this->load->view('extendilicenseview',$data);
        }
        public function editExtendlicense($id){
            $data['record']= $this->load->Ilicense_model->getLicense($id);    
            $data['plan_name'] = $this->load->Ilicense_model->plan_name();
            $this->load->view('editextendlicense',$data);
        }
        public function updateExtendlicense(){
            
            $id= $this->input->post('id');
            $data = array(
                'company_name'=>$this->input->post('company_name'),
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'contact_name'=>$this->input->post('contact_name'),
                'contact_number'=>$this->input->post('contact_number'),
                'start_date'=>$this->input->post('start_date'),
                'end_date'=>$this->input->post('end_date'),
                'created_by'=>$this->session->userdata('user_id'),
                'updated_by'=>$this->session->userdata('user_id'),
                'plan_id'=>$this->input->post('plan_id'),
                'user_access_token'=>$this->input->post('user_access_token'),
                'user_access_ps'=>$this->input->post('user_access_password'),
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
                'status'=>$this->input->post('status'),
            );
            $this->load->Ilicense_model->updateExtendlicense( $id,$data);
            redirect('IlicenseList');
        }
        public function add_plan_form()
        {
            $this->load->view('plan-form');
        }
        public function save_plan()
        {
            $data = array(
                'name' => $this->input->post('plan_name'),
                'trans_per_month' => $this->input->post('trans_per_month'),
                'trans_per_year' => $this->input->post('trans_per_year'),
                'created_by'=>$this->session->userdata('user_id'),
                'updated_by'=>$this->session->userdata('user_id'),
                'created_at'=>date('Y-m-d'),
                'updated_at'=>date('Y-m-d'),
                'status'=>'active',
                
            );
            $this->load->Ilicense_model->save_plan($data);
            redirect("activePlanlist");

        }
        public function update_plan($id)
        {
            $data = array(
                'name' => $this->input->post('plan_name'),
                'trans_per_month' => $this->input->post('trans_per_month'),
                'trans_per_year' => $this->input->post('trans_per_year'),
                'updated_by'=>$this->session->userdata('user_id'),
                'updated_at'=>date('Y-m-d'),
            );
            $this->load->Ilicense_model->update_plan($data,$id);
            redirect("activePlanlist");
        }
        public function activePlanlist()
        {
            $status ="active";
            $data['getAllplan'] =$this->load->Ilicense_model->getAllplan($status);
            $this->load->view('activePlanlist',$data);
        }
        public function inactivePlanlist()
        {
            $status ="inactive";
            $data['getAllplan'] =$this->load->Ilicense_model->getAllplan($status);
            $this->load->view('inactivePlanlist',$data);
        }
        public function makePlanInactive($id)
        {
            $data = array(
                'status'=>'inactive',
            );
            $this->load->Ilicense_model->makePlanInactive($data,$id);
            redirect("activePlanlist");
        }
        public function editplan($id)
        {

           $data['row'] = $this->load->Ilicense_model->getPlan_row($id);
            $this->load->view('plan-form',$data);
        }        
        public function check_plan_exist()
        {
            $plan_name =$this->input->post('plan_name');
            
            $plan_exist_status = $this->load->Ilicense_model->check_plan_exist($plan_name);
            if($plan_exist_status > 0){
                echo "exist";
            }else{
                echo "not_exist";
            }
            exit;
        }
    }
