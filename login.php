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
public function getStudent(){
    $data=$this->db->get('tbl_student')->result();
    return $data;
}
public function getLecturer(){
    $data=$this->db->get('tbl_lecturer')->result();
    return $data;
}
public function getSubject(){
    $data=$this->db->get('tbl_subject')->result();
    return $data;
}
public function getStudentForSub($id){
    $this->db->select('*')->from('tbl_subject_student')->where('subject_id',$id);
    $this->db->where(active,true);
    $student_ids=$this->db->get()->select('student_id')->result();
    $data=$this->db->select('*')->from('tbl_student')->where_in('id',$student_ids);
    return $data;
}

public function getLecturerForSub($id){
     $this->db->select('*')->from('tbl_subject_lecturer')->where('subject_id',$id);
    $this->db->where(active,true);
    $student_ids=$this->db->get()->select('lecturer_id')->result();
    $data=$this->db->select('*')->from('tbl_lecturer')->where_in('id',$student_ids);
    return $data;
}

}