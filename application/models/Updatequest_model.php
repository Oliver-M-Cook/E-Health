<?php
class Updatequest_model extends CI_Model {
    /* 
    Function collects the user data from the database to be returned to the 
    controller
    */
    public function getUserDetails($patientID){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('GUID', $patientID);

        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $user){
            //The result is stored into the indexs provided
            $data['email'] = $user->email;
            $data['firstname'] = $user->firstname;
            $data['surname'] = $user->surname;
            $data['dob'] = $user->dob;
            $data['title'] = $user->title;
            $data['marital_status'] = $user->marital_status;
            $data['address'] = $user->address;
            $data['postcode'] = $user->postcode;
            $data['mobile'] = $user->mobile;
            $data['home_telephone'] = $user->home_telephone;
            $data['SMS_YN'] = $user->SMS_YN;
            $data['occupation'] = $user->occupation;
            $data['email_yn'] = $user->email_yn;
            $data['gender'] = $user->gender;
            $data['height'] = $user->height;
            $data['weight'] = $user->weight;
            $data['kin_name'] = $user->kin_name;
            $data['kin_relationship'] = $user->kin_relationship;
            $data['kin_telephone'] = $user->kin_telephone;
        }
        return $data;
    }

    public function validateDetails($userDetails){
        return true;
    }

    /* 
    Function updates the users table with the updated user details
    */
    public function submitUserData($userDetails){
        //The status is set to pending because the questionaire was changed and needs checking by the admin
        $userDetails['status'] = "Pending";
        $this->db->where('GUID', $_SESSION['patientID']);
        $this->db->update('users',$userDetails); 
    }

    /* 
    Function collects all the medication data filtered by the patientID
    */
    public function getMedication($patientID){
        $this->db->select('*');
        $this->db->from('medication');
        $this->db->where('userid', $patientID);

        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $user){
            $data['Medication_YN'] = $user->Medication_YN;
            if($data['Medication_YN'] == "Yes"){
                $medArray[0] = $user->Medication_1;
                $medArray[1] = $user->medication_frequency_1;
                $medArray[2] = $user->medication_dosage_1;
                $medArray[3] = $user->Medication_2;
                $medArray[4] = $user->medication_frequency_2;
                $medArray[5] = $user->medication_dosage_2;
                $medArray[6] = $user->Medication_3;
                $medArray[7] = $user->medication_frequency_3;
                $medArray[8] = $user->medication_dosage_3;
                $data['medArray'] = $medArray;
            }
        }
        return $data;
    }

    public function validateMedication(){
        return true;
    }

    /* 
    Function submits the updated medication data to the database
    */
    public function submitMedication($medDetails){
        $this->db->where('userid', $_SESSION['patientID']);
        $this->db->update('medication',$medDetails); 
    }

    /* 
    Function collects all the smoking data filtered by patientID
    */
    public function getSmoking($patientID){
        $this->db->select('*');
        $this->db->from('smoking');
        $this->db->where('userid', $patientID);

        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $user){
            $data['smoke_status'] = $user->smoke_status;
            if($data['smoke_status'] == "currentSmoker"){
                $smokeArray[0] = $user->smoke_type;
                $smokeArray[1] = $user->start_smoking;
                $smokeArray[2] = $user->quit_smoking;
                $data['smokeArray'] = $smokeArray;
            }
        }
        return $data;
    }

    public function validateSmoking(){
        return true;
    }

    /* 
    Function submits updated smoking data to the database
    */
    public function submitSmoking($smokeDetails){
        $this->db->where('userid', $_SESSION['patientID']);
        $this->db->update('smoking',$smokeDetails);
    }

    /* 
    Function collects all the alcohol data required for the view to work correctly
    */
    public function getAlcohol($patientID){
        $this->db->select('response_score, Question, response0, response1, response2, response3, response4');
        $this->db->from('alcohol_responses');
        $this->db->join('alcohol_questions', 'questionid = alcohol_questions.GUID');
        $this->db->join('alcohol_options', 'response = alcohol_options.GUID');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        $questions = array();

        foreach($result as $data){
            $question = array(
                $data->response_score,
                $data->Question,
                $data->response0,
                $data->response1,
                $data->response2,
                $data->response3,
                $data->response4
            );

            //array_push adds the formed question array to the list of questions
            array_push($questions, $question);
        }
        //This is used to keep a count on the amount of questions 
        $_SESSION['numAlcohol'] = sizeof($questions);
        return $questions;
    }

    public function validateAlcohol(){
        return true;
    }

    /* 
    Function submits the updated alcohol details to the database
    */
    public function submitAlcohol($alcoholDetails){
        for($i = 1; $i <= sizeof($alcoholDetails); $i++){
            //A different approach was used here because thr query needed to be filtered by two variables
            $whereArray = array('userid' => $_SESSION['patientID'], 'questionid' => $i);
            $data =  array('response_score' => $alcoholDetails['question'.$i]);
            $this->db->where($whereArray);
            $this->db->update('alcohol_responses', $data);
        }
    }

    /* 
    Function collects the medical history of a certain patient, returned to the
    controller for the view
    */
    public function getMedicalHistory($patientID){
        $this->db->select('has_cancer, has_heart_disease, has_stroke, has_other');
        $this->db->from('medical_history');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $data['has_cancer'] = $user->has_cancer;
            $data['has_heart_disease'] = $user->has_heart_disease;
            $data['has_stroke'] = $user->has_stroke;
            $data['has_other'] = $user->has_other;
        }

        return $data;
    }

    public function validateMedicalHistory($data){
        return true;
    }

    /* 
    Function submits the udpdated medical history to the 
    database 
    */
    public function submitMedicalHistory($data){
        $this->db->where('userid', $_SESSION['patientID']);
        $this->db->update('medical_history', $data);
    }

    /* 
    Function collects the allergy data which is filtered
    by the patientID
    */
    public function getAllergies($patientID){
        $this->db->select('allergy_details');
        $this->db->from('allergies');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $data['allergy_details'] = $user->allergy_details;
        }

        return $data;
    }

    public function validateAllergies($data){
        return true;
    }

    /* 
    Function submits the updated allergy data to the database
    */
    public function submitAllergies($data){
        $this->db->where('userid', $_SESSION['patientID']);
        $this->db->update('allergies', $data);
    }

    /* 
    Function collects all the lifestyle data on a certain patientID and gets
    returned to the controller 
    */
    public function getLifestyle($patientID){
        $this->db->select('exercise, exercise_minutes, exercise_days, diet');
        $this->db->from('lifestyle');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $data['exercise'] = $user->exercise;
            $data['exerciseArray'][0] = $user->exercise_minutes;
            $data['exerciseArray'][1] = $user->exercise_days;
            $data['diet'] = $user->diet;
        }

        return $data;
    }

    function validateLifestyle($data){
        return true;
    }
    
    /* 
    Function submits the updated lifestyle data to the database
    */
    public function submitLifestyle($data){
        $this->db->where('userid', $_SESSION['patientID']);
        $this->db->update('lifestyle', $data);
    }
}
?>