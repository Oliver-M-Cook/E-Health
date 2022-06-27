<?php
class Dashboard_model extends CI_Model {
    public function getName(){
        $appName = "E-Health Dashboard";
        return $appName;
    }

    /* 
    Function checks if the user is new or not
    as a new user has to complete a questionaire and old users
    can update their submitted questionaire
    */
    public function checkNewUser(){
        $sql = "SELECT status FROM users WHERE GUID = ?";

        $query = $this->db->query($sql, array($_SESSION['userID']));

        $result = $query->result();

        foreach($result as $user){
           $status = $user->status;
        }  
        return $status; 
    }

    /* 
    Function checks if the user is an admin or not
    becuase the admin is hard coded into the database then
    checking the userID to a constant is fine in this case
    */
    public function checkAdmin(){
        if($_SESSION['userID'] == 1){
            return true;
        }
        else{
            return false;
        }
    }

    /* 
    Function gets all the names and status' to go with them
    this is mostly used by the questinaireList function
    */
    public function getAllNames(){
        $patients = array();
        $this->db->select('firstname, surname, GUID, status');
        $this->db->from('users');
        $this->db->where('status !=', "");
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $patient[0] = $user->GUID;
            $firstname = $user->firstname;
            $surname = $user->surname;
            $patient[1] = $firstname." ".$surname;
            $patient[2] = $user->status;

            array_push($patients, $patient);
        }

        return $patients;
    }

    /* 
    Function collects the data from the database that is used to create the 
    first graph which collects the status' to display in a graph
    */
    public function getChartOne(){
        $accepted = 0; $pending = 0; $rejected = 0;
        
        $this->db->select('status');
        $this->db->from('users');
        $this->db->where('status !=', "");
        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $user){
            $status = $user->status;
            //Adds a point to which ever the status is
            if($status == "Accepted"){
                $accepted += 1;
            }
            if($status == "Pending"){
                $pending += 1;
            }
            if($status == "Rejected"){
                $rejected += 1;
            }
        }

        //Data is setup so that it can be easily accessed by a for loop
        $data['entryOne']['title'] = "Accepted";
        $data['entryOne']['value'] = $accepted;
        $data['entryTwo']['title'] = "Pending";
        $data['entryTwo']['value'] = $pending;
        $data['entryThree']['title'] = "Rejected";
        $data['entryThree']['value'] = $rejected;

        return $data;

    }

    /* 
    Function collects data to be used to create the second graph which displays the
    average audit score for certain age groups.
    It used the date of birth stored in the database and the
    local data stored on the system to calculate the age
    of the patient
    */
    public function getChartTwo(){
        $this->db->select('GUID, dob');
        $this->db->from('users');
        $this->db->where('status !=', "");
        $queryOne = $this->db->get();
        $resultOne = $queryOne->result();

        //Setups the variables that will be used in the loops
        $date = date('y-m-d');
        $ageGroupOne['counter'] = 0; $ageGroupOne['total'] = 0;
        $ageGroupTwo['counter'] = 0; $ageGroupTwo['total'] = 0;
        $ageGroupThree['counter'] = 0; $ageGroupThree['total'] = 0;
        $ageGroupFour['counter'] = 0; $ageGroupFour['total'] = 0;

        foreach($resultOne as $user){
            $userID = $user->GUID;
            $dob = $user->dob;
            $auditScore = 0;

            //The dates have to be formatted to a date format so the date_diff can work
            $date1=date_create($date);
            $date2=date_create($dob);
            $diff = date_diff($date1, $date2);

            //format the diff so it only displays the years
            $ageStr = $diff->format("%y");

            //Because we know the value will always be an integer then we can convert it using intval
            $age = intval($ageStr);

            //Query selects the response score of a filtered patient
            $this->db->select('response_score');
            $this->db->from('alcohol_responses');
            $this->db->where('userid', $userID);
            $queryTwo = $this->db->get();
            $resultTwo = $queryTwo->result();

            foreach($resultTwo as $score){
                //score is added up to form a total score
                $auditScore += $score->response_score;
            }

            //filters through the age gaps to assign the score to correct age group
            if($age >= 18 && $age <= 29){
                $ageGroupOne['counter'] += 1;
                $ageGroupOne['total'] += $auditScore;
            }
            if($age >= 30 && $age <= 49){
                $ageGroupTwo['counter'] += 1;
                $ageGroupTwo['total'] += $auditScore;
            }
            if($age >= 50 && $age <= 69){
                $ageGroupThree['counter'] += 1;
                $ageGroupThree['total'] += $auditScore;
            }
            if($age >= 70){
                $ageGroupFour['counter'] += 1;
                $ageGroupFour['total'] += $auditScore;
            }
        }
        
        $data['entryOne']['title'] = "18-29";
        $data['entryTwo']['title'] = "30-49";
        $data['entryThree']['title'] = "50-69";
        $data['entryFour']['title'] = "70+";

        //Checks for 0 as performing calculations with 0 can be undefined
        if($ageGroupOne['counter'] != 0){
            $data['entryOne']['value'] = $ageGroupOne['total']/$ageGroupOne['counter'];
        }
        else{
            $data['entryOne']['value'] = 0;
        }

        if($ageGroupTwo['counter'] != 0){
            $data['entryTwo']['value'] = $ageGroupTwo['total']/$ageGroupTwo['counter'];
        }
        else{
            $data['entryTwo']['value'] = 0;
        }

        if($ageGroupThree['counter'] != 0){
            $data['entryThree']['value'] = $ageGroupThree['total']/$ageGroupThree['counter'];
        }
        else{
            $data['entryThree']['value'] = 0;
        }

        if($ageGroupFour['counter'] != 0){
            $data['entryFour']['value'] = $ageGroupFour['total']/$ageGroupFour['counter'];
        }
        else{
            $data['entryFour']['value'] = 0;
        }

        return $data;
    }

    /* 
    Function collects the data that will be used to create the third graph which 
    displays the smoking distribution between patients so the admin can see if smokers are quiting
    or people just aren't smoking
    */
    public function getChartThree(){
        $this->db->select('smoke_status');
        $this->db->from('users');
        $this->db->join('smoking', 'users.GUID = userid');
        $this->db->where('status !=', "");
        $query = $this->db->get();
        $result = $query->result();
        $currentSmoker = 0;
        $exSmoker = 0;
        $neverSmoked = 0;

        foreach($result as $user){
            $smoke_status = $user->smoke_status;

            if($smoke_status == "notSmoked"){
                $neverSmoked += 1;
            }
            if($smoke_status == "currentSmoker"){
                $currentSmoker += 1;
            }
            if($smoke_status == "exSmoker"){
                $exSmoker += 1;
            }
        }

        $data['entryOne']['title'] = "Current Smoker";
        $data['entryOne']['value'] = $currentSmoker;
        $data['entryTwo']['title'] = "Never Smoked";
        $data['entryTwo']['value'] = $neverSmoked;
        $data['entryThree']['title'] = "Ex-Smoker";
        $data['entryThree']['value'] = $exSmoker;

        return $data;
    }

    /* 
    Function collects the data used in creating the fourth graph
    the graph collects the diet data of all patients in the database
    it will show the trend in diets
    */
    public function getChartFour(){
        $this->db->select('diet');
        $this->db->from('users');
        $this->db->join('lifestyle', 'users.GUID = userid');
        $this->db->where('status !=', "");
        $query = $this->db->get();
        $result = $query->result();

        $good = 0; $average = 0; $poor = 0; $vegetarian = 0;
        $vegan = 0; $lowFat = 0; $lowSalt = 0;

        foreach($result as $user){
            $diet = $user->diet;
            if($diet == "good"){
                $good += 1;
            }
            if($diet == "average"){
                $average += 1;
            }
            if($diet == "poor"){
                $poor += 1;
            }
            if($diet == "vegetarian"){
                $vegetarian += 1;
            }
            if($diet == "vegan"){
                $vegan += 1;
            }
            if($diet == "low fat"){
                $lowFat += 1;
            }
            if($diet == "low salt"){
                $lowSalt += 1;
            }
        }

        $data['entryOne']['title'] = "Good";
        $data['entryOne']['value'] = $good;
        $data['entryTwo']['title'] = "Average";
        $data['entryTwo']['value'] = $average;
        $data['entryThree']['title'] = "Poor";
        $data['entryThree']['value'] = $poor;
        $data['entryFour']['title'] = "Vegetarian";
        $data['entryFour']['value'] = $vegetarian;
        $data['entryFive']['title'] = "Vegan";
        $data['entryFive']['value'] = $vegan;
        $data['entrySix']['title'] = "Low Fat";
        $data['entrySix']['value'] = $lowFat;
        $data['entrySeven']['title'] = "Low Salt";
        $data['entrySeven']['value'] = $lowSalt;

        return $data;
    }
}
?>