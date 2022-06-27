<?php
class Signup_model extends CI_Model {
    public function getName()
    {
        $appName = "E-Health Signup";
        return $appName;
    }

    /* 
    Functionn stores the users credentials into the database so they
    can login at a later stage
    */
    public function storeCredentials($data){
        $this->db->insert('users', $data);
        redirect('');
    }

    /* 
    Function will eventually validate data on the server side
    if the user bypasses the validation on the client side
    */
    public function validateCredentials($data){
        //Temp validation
        return true;
    }
}
?>