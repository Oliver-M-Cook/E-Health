<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Completequest extends CI_Controller{
    public function __construct(){
		parent::__construct();
        //Model used for this controller
		$this->load->model('Completequest_model');
        session_start();
	}

    public function index(){ 
        if(isset($_SESSION['username'])){
            $data['appName'] = "User Details";
		    $this->load->view('userdetails', $data);
        }
        else{
            redirect('');
        }
	}

    /* 
    sendUserData function collects user data from the POST and stores them in an array
    for later use   
    */
    public function sendUserData(){

        //The user has to be logged in to access this function
        if(isset($_SESSION['username'])){
            $userDetails['title'] = $this->input->post('title');
            $userDetails['firstname'] = $this->input->post('firstname');
            $userDetails['surname'] = $this->input->post('surname');
            $userDetails['dob'] = $this->input->post('dob');
            $userDetails['marriage'] = $this->input->post('marriage');
            $userDetails['address'] = $this->input->post('address');
            $userDetails['postcode'] = $this->input->post('postcode');
            $userDetails['mobile'] = $this->input->post('mobile');
            $userDetails['homeTelephone'] = $this->input->post('homeTelephone');
            $userDetails['smsCon'] = $this->input->post('smsCon');
            $userDetails['email'] = $this->input->post('email');
            $userDetails['emailCon'] = $this->input->post('emailCon');
            $userDetails['gender'] = $this->input->post('gender');
            $userDetails['occupation'] = $this->input->post('occupation');
            $userDetails['weight'] = $this->input->post('weight');
            $userDetails['height'] = $this->input->post('height');
            $userDetails['kinName'] = $this->input->post('kinName');
            $userDetails['kinRel'] = $this->input->post('kinRel');
            $userDetails['kinNum'] = $this->input->post('kinNum');

            //Because gender can have extra info, the if statement accommodates it
            if($this->input->post('gender') == "Other"){
                $userDetails['gender'] = "Other-".$this->input->post('otherSpec');
            }

            //Once the data passes the validation and sanitization it is added to the session
            if($this->Completequest_model->validateDetails($userDetails)){
                $_SESSION['userDetails'] = $userDetails;

                //The prevPage variable is used to prevent the user from going back and potentially confusing the system
                $_SESSION['prevPage'] = "userdetails";
                redirect('/questionaire/medical');
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
    sendMedData function collects the data and stores it for later use
    */
    public function sendMedData(){
        if(isset($_SESSION['username'])){
            $medDetails['medYN'] = $this->input->post('medicationState');

            //An if statement is used here to accommodate the medications that can be inputted
            if($medDetails['medYN'] == "Yes"){
                $medDetails['medOne'] = $this->input->post('medicationOne');
                $medDetails['medTwo'] = $this->input->post('medicationTwo');
                $medDetails['medThree'] = $this->input->post('medicationThree');
                
                $medDetails['medOneDosage'] = $this->input->post('medicationOneDosage');
                $medDetails['medTwoDosage'] = $this->input->post('medicationTwoDosage');
                $medDetails['medThreeDosage'] = $this->input->post('medicationThreeDosage');

                $medDetails['medOneUsage'] = $this->input->post('medicationOneUsage');
                $medDetails['medTwoUsage'] = $this->input->post('medicationTwoUsage');
                $medDetails['medThreeUsage'] = $this->input->post('medicationThreeUsage');
            }

            if($this->Completequest_model->validateMedDetails($medDetails)){
                $_SESSION['medDetails'] = $medDetails;
                $_SESSION['prevPage'] = "medication";
                redirect('/questionaire/smoking');
            }
            else{
                redirect('/questionaire/medical');
            }
        }
        else{
            redirect('');
        }
    }


    /* 
    sendSmokeData function is used to collect the smoking data from the POST and 
    stored for later use in an array
    */
    public function sendSmokeData(){
        if(isset($_SESSION['username'])){
            $smokeDetails['smokeState'] = $this->input->post('smokingState');
            if($smokeDetails['smokeState'] == "currentSmoker"){
                $smokeDetails['smokeType'] = $this->input->post('smokeType');
                $smokeDetails['smokeAge'] = $this->input->post('inputSmokeAge');
                $smokeDetails['smokeHelp'] = $this->input->post('smokeHelp');
            }

            if($this->Completequest_model->validateSmokeDetails($smokeDetails)){
                $_SESSION['smokeDetails'] = $smokeDetails;
                $_SESSION['prevPage'] = "smoking";
                redirect('/questionaire/alcohol');
            }
            else{
                redirect('/questionaire/smoking');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    sendAlcoholData function is used to collect data from POST and store it for later use
    */
    public function sendAlcoholData(){
        if(isset($_SESSION['username'])){

            //loops through each question the user submitted and stores it
            for($i = 0; $i < $_SESSION['numAlcohol']; $i++){
                //The data was stored this way so it can be accessed by another for loop later on for storing to the database
                $alcoholDetails['question'.($i+1)] = $this->input->post('responseSet'.$i);
            }

            if($this->Completequest_model->validateAlcoholDetails($alcoholDetails)){
                $_SESSION['alcoholDetails'] = $alcoholDetails;
                $_SESSION['prevPage'] = "alcohol";
                redirect('/questionaire/medical_history');
            }
            else{
                redirect('/questionaire/alcohol');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    sendMedicalHistoryData function stores data from POST into an array
    ready for use later on once the questionaire is completed
    */
    public function sendMedicalHistoryData(){
        if(isset($_SESSION['username'])){
            $medHistDetails['hDCheck'] = $this->input->post('hDCheck');
            $medHistDetails['canCheck'] = $this->input->post('canCheck');
            $medHistDetails['stroCheck'] = $this->input->post('stroCheck');
            $medHistDetails['otherCheck'] = $this->input->post('otherCheck');

            //If statements are used to collect the extra info if the user inputted it
            if($medHistDetails['hDCheck'] == "yes"){
                $medHistDetails['inputHDFamily'] = $this->input->post('inputHDFamily');
            }

            if($medHistDetails['stroCheck'] == "yes"){
                $medHistDetails['inputStroFamily'] = $this->input->post('inputStroFamily');
            }

            if($medHistDetails['canCheck'] == "yes"){
                $medHistDetails['inputCanFamily'] = $this->input->post('inputCanFamily');
            }

            if($medHistDetails['otherCheck'] == "yes"){
                $medHistDetails['inputOtherFamily'] = $this->input->post('inputOtherFamily');
            }

            if($this->Completequest_model->validateMedHistDetails($medHistDetails)){
                $_SESSION['medHistDetails'] = $medHistDetails;
                $_SESSION['prevPage'] = "medical_history";
                redirect('/questionaire/allergies');
            }
            else{
                redirect('/questionaire/medical_history');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    sendAllergyData function is used to store allergy data sent by the POST for later use
    */
    public function sendAllergyData(){
        if(isset($_SESSION['username'])){
            $allergyDetails['allergyCheck'] = $this->input->post('allergyCheck');
            if($allergyDetails['allergyCheck'] == "yes"){
                $allergyDetails['allergyInfo'] = $this->input->post('inputAllergy');
            }

            if($this->Completequest_model->validateAllergyDetails($allergyDetails)){
                $_SESSION['allergyDetails'] = $allergyDetails;
                $_SESSION['prevPage'] = "allergies";
                redirect('/questionaire/lifestyle');
            }
            else{
                redirect('/questionaire/allergies');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    sendLifestyleData function get the POST data and stores it in an array for 
    later use in the controller
    */
    public function sendLifestyleData(){
        if(isset($_SESSION['username'])){
            $lifestyleDetails['regularExer'] = $this->input->post('exerciseCheck');
            $lifestyleDetails['diet'] = $this->input->post('dietSelect');
            if($lifestyleDetails['regularExer'] == "yes"){
                $lifestyleDetails['exerciseSession'] = $this->input->post('inputExerSess');
                $lifestyleDetails['weeklyExercise'] = $this->input->post('inputWeeklyExer');
            }

            if($this->Completequest_model->validateLifestyleDetails($lifestyleDetails)){
                $_SESSION['dataComplete'] = true;
                $_SESSION['lifestyleDetails'] = $lifestyleDetails;
                $_SESSION['prevPage'] = "lifestyle";
                redirect('/questionaire/storeDatabase');
            }
            else{
                redirect('/questionaire/lifestyle');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    loadMedPage function loads the medication type questions onto the browser for
    the user to enter
    */
    public function loadMedPage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                if($_SESSION['prevPage'] == "userdetails"){
                    $data['appName'] = "Medication Details";
                    $this->load->view('medication', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    //Due to the alcohol questions being unique, special measures are in place to make sure the questions are loaded
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        }    
    }

    /* 
    loadSmokePage function loads the smoking page with the questions for the patients to fill out
    */
    public function loadSmokePage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                if($_SESSION['prevPage'] == "medication"){
                    $data['appName'] = "Smoking Details";
                    $this->load->view('smoking', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        } 
    }

    /* 
    loadAlcPage loads the view that lets the user enter their alcohol consumption
    */
    public function loadAlcPage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                //Only loads the page if the previous page was smoking, stops the user from skipping the questions
                if($_SESSION['prevPage'] == "smoking"){
                    $data['appName'] = "Alcohol Details";
                    $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    $this->load->view('alcohol', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        } 
    }

    /* 
    loadMedHistPage loads the view that is used for the medical history of 
    the patient 
    */
    public function loadMedHistPage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                if($_SESSION['prevPage'] == "alcohol"){
                    $data['appName'] = "Medical History";
                    $this->load->view('medical_history', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        } 
    }

    /* 
    loadAllergiesPage loads the view that is used to enter allergy data
    */
    public function loadAllergiesPage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                if($_SESSION['prevPage'] == "medical_history"){
                    $data['appName'] = "Allergies";
                    $this->load->view('allergies', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        } 
    }

    /* 
    loadLifestylePage loads the lifestyle view that the patient can use to enter their lifestyle
    data
    */
    public function loadLifestylePage(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['prevPage'])){
                if($_SESSION['prevPage'] == "allergies"){
                    $data['appName'] = "Lifestyle";
                    $this->load->view('lifestyle', $data);
                }
                else{
                    $data['appName'] = $_SESSION['prevPage'];
                    if($_SESSION['prevPage'] == "alcohol"){
                        $data['questions'] = $this->Completequest_model->getAlcoholQuestions();
                    }
                    $this->load->view($_SESSION['prevPage'], $data); 
                }
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        } 
    }

    /* 
    storeDatabase takes all the data and uses functions in the model to store the data in the database permanently
    */
    public function storeDatabase(){
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['dataComplete'])){
                $this->Completequest_model->submitUserData();
                $this->Completequest_model->submitMedicalData();
                $this->Completequest_model->submitSmokeData();
                $this->Completequest_model->submitAlcoholData();
                $this->Completequest_model->submitMedHistoryData();
                $this->Completequest_model->submitAllergyData();
                $this->Completequest_model->submitLifestyleData();
                redirect('/Dashboard');
            }
            else{
                redirect('/Dashboard');
            }    
        }
        else{
            redirect('');
        }
    }
}
?>