<?php
class Completequest_model extends CI_Model {

    /* 
    All the validations below should sanitise and check data
    depending on time constraints might not be complete
    the functions were made to possibly hold the validation
    */
    public function validateDetails($userDetails){
        return true;
    }

    public function validateMedDetails($medDetails){
        return true;
    }

    public function validateSmokeDetails($smokeDetails){
        return true;
    }

    public function validateAlcoholDetails($alcoholDetails){
        return true;
    }

    public function validateMedHistDetails($medHistDetails){
        return true;
    }

    public function validateAllergyDetails($allergyDetails){
        return true;
    }

    public function validateLifestyleDetails($lifestyleDetails){
        return true;
    }

    /* 
    Function selects the fields from the required table and joining another
    table to produce the correct results
    */
    public function getAlcoholQuestions(){
        $this->db->select('Question, response0, response1, response2, response3, response4');
        $this->db->from('alcohol_questions');
        $this->db->join('alcohol_options', 'optionsid = alcohol_options.GUID');
        $query = $this->db->get();
        $result = $query->result();

        $questions = array();

        foreach($result as $data){
            $question = array(
                $data->Question,
                $data->response0,
                $data->response1,
                $data->response2,
                $data->response3,
                $data->response4
            );

            array_push($questions, $question);
        }
        $_SESSION['numAlcohol'] = sizeof($questions);
        return $questions;
    }

    /* 
    Function assigns all the data to correct names
    later on in the assignment I realised I could make this better
    this was just a learning curve of sorts
    */
    public function submitUserData(){
        $data = array(
            'email' => $_SESSION['userDetails']['email'],
            'firstname' => $_SESSION['userDetails']['firstname'],
            'surname' => $_SESSION['userDetails']['surname'],
            'dob' => $_SESSION['userDetails']['dob'],
            'title' => $_SESSION['userDetails']['title'],
            'marital_status' => $_SESSION['userDetails']['marriage'],
            'address' => $_SESSION['userDetails']['address'],
            'postcode' => $_SESSION['userDetails']['postcode'],
            'mobile' => $_SESSION['userDetails']['mobile'],
            'home_telephone' => $_SESSION['userDetails']['homeTelephone'],
            'SMS_YN' => $_SESSION['userDetails']['smsCon'],
            'occupation' => $_SESSION['userDetails']['occupation'],
            'email_yn' => $_SESSION['userDetails']['emailCon'],
            'gender' => $_SESSION['userDetails']['gender'],
            'height' => $_SESSION['userDetails']['height'],
            'weight' => $_SESSION['userDetails']['weight'],
            'kin_name' => $_SESSION['userDetails']['kinName'],
            'kin_relationship' => $_SESSION['userDetails']['kinRel'],
            'kin_telephone' => $_SESSION['userDetails']['kinNum'],
            'status' => "Pending"
        );
        
        //where clause allows the correct data to be updated 
        $this->db->where('GUID', $_SESSION['userID']);
        $this->db->update('users',$data); 
    }

    /* 
    Fucntion submits the data to the database by accessing the data stored in the session
    */
    public function submitMedicalData(){
        $data = array(
            'userid' => $_SESSION['userID'],
            'Medication_YN' => $_SESSION['medDetails']['medYN']
        );
        $this->db->insert('medication', $data);

        //It only allocates the data if the user entered it
        if($_SESSION['medDetails']['medYN'] == "Yes"){
            $data = array(
                'Medication_1' => $_SESSION['medDetails']['medOne'],
                'Medication_2' => $_SESSION['medDetails']['medTwo'],
                'Medication_3' => $_SESSION['medDetails']['medThree'],
                'medication_frequency_1' => $_SESSION['medDetails']['medOneUsage'],
                'medication_frequency_2' => $_SESSION['medDetails']['medTwoUsage'],
                'medication_frequency_3' => $_SESSION['medDetails']['medThreeUsage'],
                'medication_dosage_1' => $_SESSION['medDetails']['medOneDosage'],
                'medication_dosage_2' => $_SESSION['medDetails']['medTwoDosage'],
                'medication_dosage_3' => $_SESSION['medDetails']['medThreeDosage'],
            );

            $this->db->where('userid', $_SESSION['userID']);
            $this->db->update('medication',$data);
        }
    }

    /* 
    Function formats the smoking data
    sends the data to the database using an update function 
    */
    public function submitSmokeData(){
        $data = array(
            'userid' => $_SESSION['userID'],
            'smoke_status' => $_SESSION['smokeDetails']['smokeState'],
        );
        $this->db->insert('smoking', $data);
        if($_SESSION['smokeDetails']['smokeState'] == "currentSmoker"){
            $data = array(
                'smoke_type' => $_SESSION['smokeDetails']['smokeType'],
                'start_smoking' => $_SESSION['smokeDetails']['smokeAge'],
                'quit_smoking' => $_SESSION['smokeDetails']['smokeHelp'],
            );
            $this->db->where('userid', $_SESSION['userID']);
            $this->db->update('smoking',$data);
        }
    }

    /* 
    Function sends the data to the database for permanent storage
    */
    public function submitAlcoholData(){
        //Loops through each alcohol answer
        for($i = 1; $i <= sizeof($_SESSION['alcoholDetails']); $i++){
            //Selects the optionID from the database as it is required for the data to be inserted
            $this->db->select('optionsid');
            $this->db->from('alcohol_questions');
            $this->db->where('GUID', $i);
            $query = $this->db->get();
            $result = $query->result();
            foreach($result as $data){
                $optionsID = $data->optionsid;
            }

            //creates the data array that is used to store data in the database
            $data = array(
                'userid' => $_SESSION['userID'],
                'questionid' => $i,
                'response' => $optionsID,
                'response_score' => $_SESSION['alcoholDetails']['question'.$i]
            );
            $this->db->insert('alcohol_responses', $data);
        }
    }

    /* 
    Function submits the data the user enter into the database
    the data is formatted so it follows the column names in the table
    */
    public function submitMedHistoryData(){
        $data['userid'] = $_SESSION['userID'];
        
        //It only assigns the data if the user entered the data
        if($_SESSION['medHistDetails']['hDCheck'] == "yes"){
            $data['has_heart_disease'] = $_SESSION['medHistDetails']['inputHDFamily'];
        }
        //otherwise the value is set to "no"
        else{
            $data['has_heart_disease'] = "no";
        }

        if($_SESSION['medHistDetails']['stroCheck'] == "yes"){
            $data['has_stroke'] = $_SESSION['medHistDetails']['inputStroFamily'];
        }
        else{
            $data['has_stroke'] = "no";
        }

        if($_SESSION['medHistDetails']['canCheck'] == "yes"){
            $data['has_cancer'] = $_SESSION['medHistDetails']['inputCanFamily'];
        }
        else{
            $data['has_cancer'] = "no";
        }

        if($_SESSION['medHistDetails']['otherCheck'] == "yes"){
            $data['has_other'] = $_SESSION['medHistDetails']['inputOtherFamily'];
        }
        else{
            $data['has_other'] = "no";
        }

        $this->db->insert('medical_history', $data);
    }

    /* 
    Function formats the data and sends it off to the database
    */
    public function submitAllergyData(){
        $data['userid'] = $_SESSION['userID'];
        if($_SESSION['allergyDetails']['allergyCheck'] == "yes"){
            $data['allergy_details'] = $_SESSION['allergyDetails']['allergyInfo'];
        }
        else{
            $data['allergy_details'] = $_SESSION['allergyDetails']['allergyCheck'];
        }
        $this->db->insert('allergies', $data);
    }

    /* 
    Function formats the lifestyle data and inserts it 
    into the lifestyle table
    */
    public function submitLifestyleData(){
        $data['userid'] = $_SESSION['userID'];
        $data['exercise'] = $_SESSION['lifestyleDetails']['regularExer'];
        $data['diet'] = $_SESSION['lifestyleDetails']['diet'];
        if($data['exercise'] == "yes"){
            $data['exercise_minutes'] = $_SESSION['lifestyleDetails']['exerciseSession'];
            $data['exercise_days'] = $_SESSION['lifestyleDetails']['weeklyExercise'];   
        }
        $this->db->insert('lifestyle', $data);
    }
}
?>