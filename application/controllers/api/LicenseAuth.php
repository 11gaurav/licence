<?php
//https://www.itsolutionstuff.com/post/codeigniter-3-restful-api-tutorialexample.html
require APPPATH . 'libraries/REST_Controller.php';

class LicenseAuth extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    const DIFF_CHARS = "123456789ABCDEFG";
    const REQUIRED_MACHINE_LENGTH = 16;
    /**
     * Authenticate APi Key
     *
     * @return Response
    */
	public function auth_post()
	{

        $input = $this->input->post();
        
        $requiredFields = ["machine_id", "license_key"];

        $errorArray = [];
        if(!array_key_exists("machine_id", $input) || empty($input["machine_id"])){
            $errorArray[] = "machine_id";
        }
        if(!array_key_exists("license_key", $input) || empty($input["license_key"])){
            $errorArray[] = "license_key";
        }

        if(!empty($errorArray)){
            return $this->response([
                "message"   =>  "Please provide all given fields, that are mandatory to process request",
                "status"    =>  false,
                "data" =>  $errorArray
            ], REST_Controller::HTTP_BAD_REQUEST);
            exit;
        }

        $companyData = $this->db->get_where("user_license", ['license_key' => $input["license_key"]])->row_array();

        if(empty($companyData)){
            return $this->response([
                "message"   =>  "Invalid License key",
                "status"    =>  false,
                "data" =>  $input
            ], REST_Controller::HTTP_UNAUTHORIZED);
            exit;
        }

        $currentDate = strtotime(date("Y-m-d"));
        $endDate = strtotime($companyData["end_date"]);
        $startDate = strtotime($companyData["start_date"]);

        if($currentDate < $startDate){
            return $this->response([
                "message"   =>  "Your license will be activated from ". $companyData["start_date"] .", Please contact to customer support",
                "status"    =>  false,
                "data" =>  $input
            ], REST_Controller::HTTP_UNAUTHORIZED);
            exit;            
        }

        if($currentDate > $endDate){
            return $this->response([
                "message"   =>  "Your license was expired on ". $companyData["end_date"] .", Please contact to customer support",
                "status"    =>  false,
                "data" =>  $input
            ], REST_Controller::HTTP_UNAUTHORIZED);
            exit;
        }
        //TODO
        // check for status Inactive/init
        if($companyData["status"] !== 'Active'){
            return $this->response([
                "message"   =>  "Your license is InActive, Please contact to customer support",
                "status"    =>  false,
                "data" =>  $input
            ], REST_Controller::HTTP_UNAUTHORIZED);
            exit;
        }

        $providedMachineId = self::getMachineId($input["machine_id"]);

        if(empty($companyData["machine_id"])){
            $this->db->update('user_license', [
                "machine_id"    =>  $providedMachineId,
                "original_machine_id"   =>  $input["machine_id"]
            ], array('id'   =>  $companyData["id"]));
        }else{
            if($providedMachineId !== $companyData["machine_id"]){
                return $this->response([
                    "message"   =>  "This license key is already activated with this License key on another device, Please login via same device",
                    "status"    =>  false,
                    "data" =>  $input
                ], REST_Controller::HTTP_UNAUTHORIZED);
                exit;
            }
        }

        $updatedCompanyData = $this->db->get_where("user_license", ['license_key' => $input["license_key"]])->row_array();

        if(isset($updatedCompanyData["plan_id"]) && !is_null($updatedCompanyData["plan_id"])){
            $planData = $this->db->get_where("plan", ['id' => $updatedCompanyData["plan_id"]])->row_array();

            if(!empty($planData)){
                $updatedCompanyData["plan_name"] = $planData["name"];
                $updatedCompanyData["trans_per_month"] = $planData["trans_per_month"];
                $updatedCompanyData["trans_per_year"] = $planData["trans_per_year"];
            }
        }

        $responseData = $updatedCompanyData;
        unset($responseData["created_by"]);
        unset($responseData["updated_by"]);
        unset($responseData["created_at"]);
        unset($responseData["uodated_at"]);
        unset($responseData["machine_id"]);

        return $this->response([
            "message"   =>  "License Verified",
            "status"    =>  true,
            "data" =>  $responseData
        ], REST_Controller::HTTP_OK);
        exit;
	}


    private function getMachineId($machineId)
    {
        if(strlen($machineId) < self::REQUIRED_MACHINE_LENGTH){
            $diff = self::REQUIRED_MACHINE_LENGTH - strlen($machineId);
            $diffChars = substr(self::DIFF_CHARS, 0, $diff);
            $full_machineId = $machineId . $diffChars;
        }else if(strlen($machineId) > self::REQUIRED_MACHINE_LENGTH){
            $full_machineId = substr($machineId, 0, self::REQUIRED_MACHINE_LENGTH);
        }else{
            $full_machineId = $machineId;
        }

        return $full_machineId;
    }

}