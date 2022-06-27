<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct(){
		parent::__construct();
        //model used for this controller
		$this->load->model('Dashboard_model');
        session_start();
	}

    /* 
    The index loads the dashboard but also checks if the admin logged in, it also calls a function that
    gets the users status to see if they have submitted their questionaire or not
    */
    public function index(){ 
        if(isset($_SESSION['username'])){
            $data['adminCheck'] = $this->Dashboard_model->checkAdmin();
            $_SESSION['admin'] = $data['adminCheck'];
            $data['status'] = $this->Dashboard_model->checkNewUser();
            $data['appName'] = $this->Dashboard_model->getName();
		    $this->load->view('dashboard', $data);
        }
        else{
            redirect('');
        }
	}

    /* 
    This function is called when the admin wants to access the questionaire list
    it gets the patient list and loads the view with the data fetched
    */
    public function questionaire_list(){
        if(isset($_SESSION['username']) && isset($_SESSION['admin'])){
            if($_SESSION['admin']){
                $data['patientList'] = $this->Dashboard_model->getAllNames();
                $this->load->view('questionaireList', $data);
            }
            else{
                redirect('');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    This function gets the action the user wanted to perform with the patient they selected
    from the list
    */
    public function sendData(){
        if(isset($_SESSION['username']) && isset($_SESSION['admin'])){
            if($_SESSION['admin']){
                $action = $this->input->post('action');
                $patient = $this->input->post('patientSelect');

                //To hold two values in a singular value attribute the explode function seperates the two strings
                $patientArray = explode("|", $patient);
                $patientID = $patientArray[0];
                if($action == "updateQuestionaire"){
                    $_SESSION['patientID'] = $patientID;
                    redirect('/update_questionaire');
                }
                if($action == "viewQuestionaire"){
                    $_SESSION['patientID'] = $patientID;
                    redirect('/view_questionaire');
                }
            }
            else{
                redirect('');
            }
        }
        else{
            redirect('');
        }
    }

    /* 
    signOut function signs the user out by unsetting the session and destroying it, then redirects to index page
    */
    public function signOut(){
        session_unset();
        session_destroy();
        redirect('');
    }

    /* 
    show_graphs function collects the graph data and submits it to the graph view
    */
    public function show_graphs(){
        if(isset($_SESSION['username']) && isset($_SESSION['admin'])){
            if($_SESSION['admin']){
                $data['chartOne'] = $this->Dashboard_model->getChartOne();
                $data['chartTwo'] = $this->Dashboard_model->getChartTwo();
                $data['chartThree'] = $this->Dashboard_model->getChartThree();
                $data['chartFour'] = $this->Dashboard_model->getChartFour();
                $this->load->view('graphs', $data);
            }
            else{
                redirect('');
            }
        }
        else{
            redirect('');
        }
    }
}
?>