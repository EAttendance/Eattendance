<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
        function __construct() {
            parent::__construct();
           //include APPPATH . 'third_party/excel_reader2.php';
                 //$this->load->library('excel_reader');
                // $this->load->library('upload');
        }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            
		$this->load->view('login');
	}
    public function login(){
           $this->load->library('form_validation');
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == FALSE) {
            
           
            $this->load->view('login');
            } else {
            $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            );
            $this->load->model('login');
            $check= $this->login->checkLogin($data);
            if($check){
               $sp= $this->getSP();
                $data['sp']=$sp;
                $newdata = array(
                'username'  => $data['email'],
                'logged_in' => TRUE
);
                $this->session->set_userdata($newdata);
                $this->load->view('adminDash',$data);
                
            }
            else{
                $this->session->set_flashdata('message', 'Invalid login details');
               
                $this->load->view('login');
            }
            
        }
        }
        public function showUploadStudent(){
            $this->load->view('fileUpload');
        }
        public function showUploadLecturer(){
            $this->load->view('fileUploadLec');
        }
        public function showUploadSubject(){
            $this->load->view('fileUploadSub');
        }
        public function csvInsertStudent(){
            $this->load->model('login');
            
            $data=$_FILES['file']['tmp_name'];
            $fileRead=fopen($data,'r');
           
            $flag = true;
            while(  $row= fgetcsv($fileRead) ){
                if(!$flag){
                     $check=$this->checkRow($row[0], 1);
                if(!$check){
                $value="'".implode("','", $row)."'";
                
                $q="Insert into tbl_student(id,fname,lname) Values(".$value.")";
                 $this->db->query($q);
                }
                else{
                  $sql['id']=row[0];
                   $sql['fname']=$row[1];
                   $sql['lname']=$row[2];
                   $this->db->replace('tbl_student',$sql);
                }
                }
                $flag=false;
            }
            
            $this->showStudent();
        
    }
    public function csvInsertLecturer(){
        
            $data=$_FILES['file']['tmp_name'];
            $fileRead=fopen($data,'r');
           
            $flag = true;
            while(  $row= fgetcsv($fileRead) ){
                if(!$flag){
                $check=$this->checkRow($row[0], 3);
                if(!$check){
                $value="'".implode("','", $row)."'";
                
                $q="Insert into tbl_lecturer(id,fname,lname) Values(".$value.")";
                 $this->db->query($q);
                }
                else{
                   $sql['id']=$row[0];
                   $sql['fname']=$row[1];
                   $sql['lname']=$row[2];
                   $this->db->replace('tbl_lecturer',$sql);
                }
                
                }
                $flag=false;
            }
              $this->showLecturer();
    }
    
     public function csvInsertSubject(){
        
            $data=$_FILES['file']['tmp_name'];
            $fileRead=fopen($data,'r');
           
            $flag = true;
            while(  $row= fgetcsv($fileRead) ){
                if(!$flag){
                $check=$this->checkRow($row[0], 2);
                if(!$check){
                $value="'".implode("','", $row)."'";
                
                $q="Insert into tbl_subject(id,subject_name) Values(".$value.")";
                 $this->db->query($q);
                }
                else{
                   $sql['id']=$row[0];
                   $sql['subject_name']=$row[1];
                   
                   $this->db->replace('tbl_subject',$sql);
                }
                }
                
                $flag=false;
                
            }
          $this->showSubjects();
    }
    public function showSubjects(){
         $this->load->model('login');
         $data['sp']= $this->getSP();
         
         $data['sub']=$this->login->getSubject();
         $this->load->view('subjectList',$data);
    }
    public function showStudent(){
        $this->load->model('login');
       
        $data['sp']= $this->getSP();
        $data['students']=$this->login->getStudent();
        $this->load->view('studentList',$data);
    
    }
    
     public function showLecturer(){
        $this->load->model('login');
       
        $data['sp']= $this->getSP();
        $data['lecturer']=$this->login->getLecturer();
        $this->load->view('lecturerList',$data);
        
    }
    function getSP(){
         $date=getdate(date("U"));
                $sp="";
                if($date["mon"]>=3 && $date["mon"] <7){
                    $sp="SP21_".$date["year"];
                }
                else if($date["mon"]>=7 && $date["mon"] < 11)
                {
                    $sp="SP22_".$date["year"];
                }
                else if($date["mon"]>=1 && $date["mon"]<4){
                    $year=$date["year"]-1;
                    $sp="SP23_".$year;
                }
                return $sp;
    }
    public function checkRow($id,$type){
     $this->db->select('*');
   
        if($type==1){
          $this->db->from('tbl_student');
    }
    
    if($type==2){
        $this->db->from('tbl_subject');
    }
    if($type==3){
        $this->db->from('tbl_lecturer');
    }
      $this->db->where('id',$id);
      $this->db->limit(1);
      $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return true;
        } else {
        return false;
        }
    }
}