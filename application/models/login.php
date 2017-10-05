<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Kiran
 */
class login extends CI_Model{
    //put your code here
    public function checkLogin($data){
      
$this->db->select('*');
$this->db->from('tbl_user');
$this->db->where('username',$data['email']);
$this->db->where('password',$data['password']);

$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}
    
    
}
