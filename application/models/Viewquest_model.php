<?php
class Viewquest_model extends CI_Model {
    /* 
    Function collects all the user details and returns them back 
    to the controller so they can be sent to the view
    */
    public function getDetails($patientID){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('GUID', $patientID);

        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $user){
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
            $data['status'] = $user->status;
        }
        return $data;
    }

    /* 
    Function collects all the medication data from the table, filtered by the patientID
    and returned to the controller
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

    /* 
    Function collects all the smoking data filtered by the patientID and is
    returned to the controller to be passed to the view
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

    /* 
    Function calculates the audit score of the alcohol questions and returns them to the
    controller
    */
    public function getAuditScore($patientID){
        $this->db->select('response_score');
        $this->db->from('alcohol_responses');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        $auditScore = 0;

        foreach($result as $data){
            $auditScore += $data->response_score;
        }

        return $auditScore;  
    }

    /* 
    Function collects all the medical history in the table that is filtered by the
    patientID and returned to the controller
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

    /* 
    Function collects the allergy data for a certain patient and returns it 
    to the controller
    */
    public function getAllergies($patientID){
        $this->db->select('allergy_details');
        $this->db->from('allergies');
        $this->db->where('userid', $patientID);
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $data = $user->allergy_details;
        }

        return $data;
    }

    /* 
    Function collects the lifestyle data for the specified patient and the
    data is returned to the controller
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

    /* 
    Function checks what the action is and performs the correct 
    response
    */
    public function performAction($action){
        //Checks the action and updates the status of the questionaire to the correct status
        if($action == "accept"){
            $data = array('status' => "Accepted");
            $this->db->where('GUID', $_SESSION['patientID']);
            $this->db->update('users',$data);
        }
        if($action == "reject"){
            $data = array('status' => "Rejected");
            $this->db->where('GUID', $_SESSION['patientID']);
            $this->db->update('users',$data);
        }
        redirect('/dashboard');
    }
}
?>