<?php
class Login_model extends CI_Model {
    public function getName()
    {
        $appName = "E-Health Login";
        return $appName;
    }

    /* 
    Function will eventually validate the data on the server side
    */
    public function validateCredentials($data){
        //Temp validation
        return true;
    }

    /* 
    Function collects the data for the password login
    */
    public function getPassword($data){
        $sql = "SELECT * FROM users WHERE username = ?";

        $query = $this->db->query($sql, array($data['username']));

        return $query->result();
    }
}
?>