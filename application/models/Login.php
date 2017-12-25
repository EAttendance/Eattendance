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
class Login extends CI_Model{
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
public function getSubject($sp){
    $data=$this->db->get('tbl_subject')->result();
    if($sp!=null){
       foreach($d as $data){
          $this->db->select('*');
          $this->db->from('tbl_sp_subjects');
          $this->db->where('sp_id',$sp['sp']);
          $this->db->where('subject_id',$d['id']);
          $query = $this->db->get();

            if ($query->num_rows() == 1) {
            $d['check']=true;
            } else {
            $d['check']=false;
            }
        }
    }
   
    
    return $data;
}
public function dashInformation($sp){
    $data=$this->db->get('tbl_sp_subjects')->where('sp_id',$sp['sp'])->result();
    if($sp!=null){
       foreach($d as $data){
         $subject=$this->db->get('tbl_subject')->where('id',$d['subject_id'])->result();
         $lecturer=$this->db->get('tbl_lecturer')->where('id',$d['lecturer_id'])->result();
         $d['sub']=$subject['subject_name'];
         $d['lecturer']=$lecturer['fname']+" "+$lecturer['lname'];
         
        }
    }
   
    
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
public function AddaLecturer($data){
    if($data!=null){
        $this->db->insert('tbl_lecturers',$data);
        return true;
    }
    else{
        return false;
    }
}
public function assignSubjectToSp($data){
        if($data['sp_id']!=null && $data['subject_id']!=null){
            
          $this->db->insert('tbl_sp_subjects',$data);
          return true;
        }
        else{
            return false;
        }
    }
public function deleteSubtoSp($data){
     if($data['sp_id']!=null && $data['subject_id']!=null){
            
          $this->db->delete('tbl_sp_subjects',$data);
          return true;
        }
        else{
            return false;
        }
}
public function assignLecturerToSub($data){
        if($data['subId']!=null && $data['lecId']){
            $var['subject_id']=$data['subId'];
            $var['lecturer_id']=$data['lecId'];
            $this->db->insert('tbl_subject_lecturer',$var);
            return true;
        }
        else{
            return false;
        }
    }
public function assignStudentToSub($data){
         if($data['subId']!=null && $data['stdId']){
            $var['subject_id']=$data['subId'];
            $var['student_id']=$data['stdId'];
            $this->db->insert('tbl_subject_student',$var);
            return true;
        }
        else{
            return false;
        }
    }
public function SpCheck($data){
    if($data['sp']!=null){
       $this->db->from('tbl_sp');
       $this->db->where('sp',$data['sp']);
       $this->db->limit(1);
       $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
        $this->db->insert('tbl_sp',$data);
        return false;
        
        }
        
    }
}

}
