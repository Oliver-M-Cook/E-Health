<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewquest extends CI_Controller{
    public function __construct(){
		parent::__construct();
        //This is the model used in this controller
		$this->load->model('Viewquest_model');
        session_start();
	}

    /* 
    Function calls the view that the user should see when first loading this controller
    it collects all the patients details and stores them in their respective 
    array
    */
    public function index(){ 
        if(isset($_SESSION['username'])){
           if(isset($_SESSION['admin'])){
               if(!$_SESSION['admin']){
                    $_SESSION['patientID'] = $_SESSION['userID'];
               }
               $data['userDetails'] = $this->Viewquest_model->getDetails($_SESSION['patientID']);
               $data['medication'] = $this->Viewquest_model->getMedication($_SESSION['patientID']);
               $data['smoking'] = $this->Viewquest_model->getSmoking($_SESSION['patientID']);
               $data['auditScore'] = $this->Viewquest_model->getAuditScore($_SESSION['patientID']);
               $data['medical_history'] = $this->Viewquest_model->getMedicalHistory($_SESSION['patientID']);
               $data['allergies'] = $this->Viewquest_model->getAllergies($_SESSION['patientID']);
               $data['lifestyle'] = $this->Viewquest_model->getLifestyle($_SESSION['patientID']);
               $this->load->view('viewQuestionaire', $data);
           }
        }
        else{
            redirect('');
        }
	}

    /* 
    This is called when the admin chooses to reject or accept and questionaire
    the action is posted to a model that decides what to do
    */
    public function changeStatus(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['admin'])){
                if(!$_SESSION['admin']){
                     $_SESSION['patientID'] = $_SESSION['userID'];
                }

                $action = $this->input->post('action');
                $this->Viewquest_model->performAction($action);
            }
         }
         else{
             redirect('');
         }
    }
}