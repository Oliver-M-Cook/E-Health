<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//This is the model used in this controller
		$this->load->model('Signup_model');
	}

	/* 
	Loads the view that is used when the controller is connected to
	*/
	public function index()
	{
		$data['appName'] = $this->Signup_model->getName();
		$this->load->view('signup', $data);
	}

	/* 
	Collects the data from the POST and stores then in the allocated array indexs
	*/
    public function SendData(){
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        
        if($this->Signup_model->validateCredentials($data)){
			//Once the data passes the server validation it is stored in the database using a function in the model
            $this->Signup_model->storeCredentials($data);
        }
    }
}
?>