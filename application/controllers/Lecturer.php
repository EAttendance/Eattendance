<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturer extends CI_Controller {
        function __construct() {
            parent::__construct();
           error_reporting(0);
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
               $this->load->model('login');
               $spCheck=$this->login->spCheck($sp);
               $data=$this->login->dashInformation($sp);
               $data['sp']=$sp['sp'];
               $newdata = array(
                'username'  => $data['email'],
                'logged_in' => TRUE,
                'password'=>$data['password']
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
    
	public function showAdminDash(){
               $sp= $this->getSP();
               $this->load->model('login');
               $data=$this->login->dashInformation($sp);
               $data['sp']=$sp['sp'];
               $this->load->view('adminDash',$data);
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
         $sp= $this->getSP();
         $data['sp']=$sp['sp'];
         $data['sub']=$this->login->getSubject($sp);
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
               $sp['sp']="";
               $sp['trimester']="";
                $sp['year']=$date['year'];
             
                if($date["mon"]>=3 && $date["mon"] <7){
                    $sp['sp']="SP21_".$date["year"];
                       $sp['trimester']=1;
                }
                else if($date["mon"]>=7 && $date["mon"] < 11)
                {
                    $sp['sp']="SP22_".$date["year"];
                       $sp['trimester']=2;
                }
                else {
                    $year=$date["year"];
                    $sp['sp']="SP23_".$year;
                       $sp['trimester']=3;
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
    public function getSubjectInfo($id){

    }
    public function addSubToSp(){
        $subCode=$this->input->post('subCode');
        if($subCode!=null){
            $data['subject_id']=$subCode;
            $this->load->model('login');
            $sp= $this->getSP();
            $data['sp_id']=$sp['sp'];
            $check= $this->login->assignSubjectToSp($data);
            return $check;
        }
    }
   
   
    
    //monty and mohit code
    
   
    public function logout() {
        $this->session->sess_destroy();
        if (isset($_SESSION)) {
            session_destroy();
            //unset($_SESSION);
        }
        redirect($this->index());
    }

}
?>