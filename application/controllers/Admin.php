<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
        function __construct() {
            parent::__construct();
            include APPPATH . 'third_party/excel_reader2.php';
                   
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
    public function excelInsert(){
        
        
    }
}
