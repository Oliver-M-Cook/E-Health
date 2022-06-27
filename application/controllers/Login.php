<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
        //This is the model used in this controller
		$this->load->model('Login_model');
        session_start();
	}

    /* 
    This function loads the intial view required which is the login view
    */
    public function index()
	{
		$data['appName'] = $this->Login_model->getName();
		$this->load->view('login', $data);
	}

    /* 
    This function collects the data sent from the POST and stores it in a data array
    then checks the password with the password selected from the database
    */
    public function sendData(){
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        if($this->Login_model->validateCredentials($data)){
            //Gets the password from the database
            $result = $this->Login_model->getPassword($data);

            $correctCred = false;
            foreach($result as $user){
                //Compares the user password with the password selected
                if($data['password'] == $user->password){
                    $_SESSION['username'] = $user->username;
                    $_SESSION['userID'] = $user->GUID;
                    $correctCred = true;
                }
            }

            //Redirects to the dashboard if the users credentials match
            if($correctCred){
                redirect('/dashboard');
            }
            else{
                redirect('/login');
            }
        }
    }
}
?>