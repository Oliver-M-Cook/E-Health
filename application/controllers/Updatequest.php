<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatequest extends CI_Controller{
    public function __construct(){
		parent::__construct();
        //Model that will be used in this controller
		$this->load->model('Updatequest_model');
        session_start();
	}

    /* 
    The index function loads the first view that is needed for the updating 
    of the questionaire
    */
    public function index(){ 
        if(isset($_SESSION['username'])){
           if(isset($_SESSION['admin'])){
               if(!$_SESSION['admin']){
                   //If an admin is logged in then a different ID needs to be set
                    $_SESSION['patientID'] = $_SESSION['userID'];
               }
               //Calls a function that gets the data for the view
               $data = $this->Updatequest_model->getUserDetails($_SESSION['patientID']);
               $this->load->view('updateUserDetails', $data);
           }
        }
        else{
            redirect('');
        }
	}

    /* 
    This function collects the updated data from the view and submits
    it to the database
    */
    public function sendUserData(){
        if(isset($_SESSION['username'])){
            $userDetails['title'] = $this->input->post('title');
            $userDetails['firstname'] = $this->input->post('firstname');
            $userDetails['surname'] = $this->input->post('surname');
            $userDetails['dob'] = $this->input->post('dob');
            $userDetails['marital_status'] = $this->input->post('marriage');
            $userDetails['address'] = $this->input->post('address');
            $userDetails['postcode'] = $this->input->post('postcode');
            $userDetails['mobile'] = $this->input->post('mobile');
            $userDetails['home_telephone'] = $this->input->post('homeTelephone');
            $userDetails['SMS_YN'] = $this->input->post('smsCon');
            $userDetails['email'] = $this->input->post('email');
            $userDetails['email_yn'] = $this->input->post('emailCon');
            $userDetails['gender'] = $this->input->post('gender');
            $userDetails['occupation'] = $this->input->post('occupation');
            $userDetails['weight'] = $this->input->post('weight');
            $userDetails['height'] = $this->input->post('height');
            $userDetails['kin_name'] = $this->input->post('kinName');
            $userDetails['kin_relationship'] = $this->input->post('kinRel');
            $userDetails['kin_telephone'] = $this->input->post('kinNum');

            if($this->input->post('gender') == "Other"){
                $userDetails['gender'] = "Other-".$this->input->post('otherSpec');
            }

            //Data should be sanitised before being submitted to the database
            if($this->Updatequest_model->validateDetails($userDetails)){
                //sends the data to the model that updates the correct table
                $this->Updatequest_model->submitUserData($userDetails);
                redirect('/update_questionaire/medical');
            }
            else{
                redirect('/questionaire');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function deals with collecting data from the database and forwarding
    it to the view
    */
    public function loadMedPage(){
        if(isset($_SESSION['username'])){
            $data = $this->Updatequest_model->getMedication($_SESSION['patientID']);
            $this->load->view('updateMedication', $data);
         }
         else{
             redirect('');
         }
    }

    /* 
    Function deals with collecting data from the POST and stores them in an array 
    to be sent to the database
    */
    public function sendMedication(){
        if(isset($_SESSION['username'])){
            $medDetails['Medication_YN'] = $this->input->post('medicationState');
            //Only collects the further infomation if the user selected yes
            if($medDetails['Medication_YN'] == "Yes"){
                $medDetails['Medication_1'] = $this->input->post('medicationOne');
                $medDetails['Medication_2'] = $this->input->post('medicationTwo');
                $medDetails['Medication_3'] = $this->input->post('medicationThree');
                
                $medDetails['medication_dosage_1'] = $this->input->post('medicationOneDosage');
                $medDetails['medication_dosage_2'] = $this->input->post('medicationTwoDosage');
                $medDetails['medication_dosage_3'] = $this->input->post('medicationThreeDosage');

                $medDetails['medication_frequency_1'] = $this->input->post('medicationOneUsage');
                $medDetails['medication_frequency_2'] = $this->input->post('medicationTwoUsage');
                $medDetails['medication_frequency_3'] = $this->input->post('medicationThreeUsage');
            }
            //The else statement makes sure that the previous data is emptied
            else{
                $medDetails['Medication_1'] = "";
                $medDetails['Medication_2'] = "";
                $medDetails['Medication_3'] = "";
                
                $medDetails['medication_dosage_1'] = "";
                $medDetails['medication_dosage_2'] = "";
                $medDetails['medication_dosage_3'] = "";

                $medDetails['medication_frequency_1'] = "";
                $medDetails['medication_frequency_2'] = "";
                $medDetails['medication_frequency_3'] = "";
            }

            if($this->Updatequest_model->validateMedication($medDetails)){
                $this->Updatequest_model->submitMedication($medDetails);
                redirect('/update_questionaire/smoking');
            }
            else{
                redirect('/update_questionaire/medical');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function loads the smoke page and collects the data required for the page to
    function correcly
    */
    public function loadSmokePage(){
        if(isset($_SESSION['username'])){
            $data = $this->Updatequest_model->getSmoking($_SESSION['patientID']);
            $this->load->view('updateSmoking', $data);
         }
         else{
             redirect('');
         }
    }


    /* 
    Function collects the data from posts and sets them up to be sent to the
    database
    */
    public function sendSmoking(){
        if(isset($_SESSION['username'])){
            $smokeDetails['smoke_status'] = $this->input->post('smokingState');
            if($smokeDetails['smoke_status'] == "currentSmoker"){
                $smokeDetails['smoke_type'] = $this->input->post('smokeType');
                $smokeDetails['start_smoking'] = $this->input->post('inputSmokeAge');
                $smokeDetails['quit_smoking'] = $this->input->post('smokeHelp');
            }
            else{
                $smokeDetails['smoke_type'] = "";
                $smokeDetails['start_smoking'] = "";
                $smokeDetails['quit_smoking'] = "";
            }

            if($this->Updatequest_model->validateSmoking($smokeDetails)){
                $this->Updatequest_model->submitSmoking($smokeDetails);
                redirect('/update_questionaire/alcohol');
            }
            else{
                redirect('/update_questionaire/smoking');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function collects the data required for the view, and then loads the view passing the
    fetched data through
    */
    public function loadAlcPage(){
        if(isset($_SESSION['username'])){
            $data['questions'] = $this->Updatequest_model->getAlcohol($_SESSION['patientID']);
            $this->load->view('updateAlcohol', $data);
         }
         else{
             redirect('');
         }
    }

    /* 
    Function collects the data from posts and sets them up to be 
    sent to the database
    */
    public function sendAlcohol(){
        if(isset($_SESSION['username'])){
            //The alcohol questions require and different approach to submission becuase of the nature of them
            for($i = 0; $i < $_SESSION['numAlcohol']; $i++){
                $alcoholDetails['question'.($i+1)] = $this->input->post('responseSet'.$i);
            }

            if($this->Updatequest_model->validateAlcohol($alcoholDetails)){
                $this->Updatequest_model->submitAlcohol($alcoholDetails);
                redirect('/update_questionaire/medical_history');
            }
            else{
                redirect('/update_questionaire/alcohol');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function loads the medical history view and collects the data required for the
    view to function correctly
    */
    public function loadMedHistPage(){
        if(isset($_SESSION['username'])){
            $data = $this->Updatequest_model->getMedicalHistory($_SESSION['patientID']);
            $this->load->view('updateMedicalHistory', $data);
        }
        else{
            redirect('');
        } 
    }

    /* 
    Function collects the POST data from the view and sends it to the database
    */
    public function sendMedicalHistory(){
        if(isset($_SESSION['username'])){
            $data['has_heart_disease'] = $this->input->post('hDCheck');
            $data['has_cancer'] = $this->input->post('canCheck');
            $data['has_stroke'] = $this->input->post('stroCheck');
            $data['has_other'] = $this->input->post('otherCheck');

            if($data['has_heart_disease'] == "yes"){
                $data['has_heart_disease'] = $this->input->post('inputHDFamily');
            }

            if($data['has_stroke'] == "yes"){
                $data['has_stroke'] = $this->input->post('inputStroFamily');
            }

            if($data['has_cancer'] == "yes"){
                $data['has_cancer'] = $this->input->post('inputCanFamily');
            }

            if($data['has_other'] == "yes"){
                $data['has_other'] = $this->input->post('inputOtherFamily');
            }
            if($this->Updatequest_model->validateMedicalHistory($data)){
                $this->Updatequest_model->submitMedicalHistory($data);
                redirect('/update_questionaire/allergies');
            }
            else{
                redirect('/update_questionaire/medical_history');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function loads the allergy page and collects the data for the view
    */
    public function loadAllergyPage(){
        if(isset($_SESSION['username'])){
            $data = $this->Updatequest_model->getAllergies($_SESSION['patientID']);
            $this->load->view('updateAllergies', $data);
        }
        else{
            redirect('');
        } 
    }

    /* 
    Collects the POST data from the view and sets it up for the submission to 
    the database
    */
    public function sendAllergy(){
        if(isset($_SESSION['username'])){
            $allergyDetails['allergy_details'] = $this->input->post('allergyCheck');
            if($allergyDetails['allergy_details'] == "yes"){
                $allergyDetails['allergy_details'] = $this->input->post('inputAllergy');
            }

            if($this->Updatequest_model->validateAllergies($allergyDetails)){
                $this->Updatequest_model->submitAllergies($allergyDetails);
                redirect('/update_questionaire/lifestyle');
            }
            else{
                redirect('/update_questionaire/allergies');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    Function loads the lifestyle page and collects the data
    required for the view to function correctly
    */
    public function loadLifestylePage(){
        if(isset($_SESSION['username'])){
            $data = $this->Updatequest_model->getLifestyle($_SESSION['patientID']);
            $this->load->view('updateLifestyle', $data);   
        }
        else{
            redirect('');
        } 
    }

    /* 
    Function collects the data from the POST and sets it up to be sent 
    to the database
    */
    public function sendLifestyle(){
        if(isset($_SESSION['username'])){
            $lifestyleDetails['exercise'] = $this->input->post('exerciseCheck');
            $lifestyleDetails['diet'] = $this->input->post('dietSelect');
            if($lifestyleDetails['exercise'] == "yes"){
                $lifestyleDetails['exercise_minutes'] = $this->input->post('inputExerSess');
                $lifestyleDetails['exercise_days'] = $this->input->post('inputWeeklyExer');
            }
            else{
                $lifestyleDetails['exercise_minutes'] = "";
                $lifestyleDetails['exercise_days'] = "";
            }

            if($this->Updatequest_model->validateLifestyle($lifestyleDetails)){
                $this->Updatequest_model->submitLifestyle($lifestyleDetails);
                redirect('/Dashboard');
            }
            else{
                redirect('/update_questionaire/lifestyle');
            }
        }
        else{
            redirect('');
        }
    }
}
?>