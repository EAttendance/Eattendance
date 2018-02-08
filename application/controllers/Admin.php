<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(0);
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $check = $this->session->userdata('logged_in');
        if ($check) {
            $type = $this->session->userdata('isLecturer');
            if ($type) {
                $this->showLectDash();
            } else {
                $this->showAdminDash();
            }
        } else {
            $this->load->view('login');
        }
    }

    public function login() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );
            $this->load->model('login');
            $check = $this->login->checkLogin($data);
            if ($check != 0 && $check != null) {
                $sp = $this->getSP();
                $this->load->model('login');
                $spCheck = $this->login->spCheck($sp);


                $newdata = array(
                    'username' => $data['email'],
                    'logged_in' => TRUE,
                    'password' => $data['password'],
                    'sp' => $sp['sp'],
                );
                $this->session->set_userdata($newdata);
                if ($check == 1) {
                    $data = $this->login->dashInformation($sp);
                    $data['sp'] = $sp['sp'];
                    $this->session->set_userdata('isLecturer', false);
                    $this->load->view('adminDash', $data);
                } else if ($check == 2) {
                    $data['students'] = $this->getSubStudentDash($data['email']);
                    $data['sp'] = $sp['sp'];
                    $subsp = $this->login->getSubjectSp($sp['sp']);
                    
                    $this->session->set_userdata('subSp', $subsp);
                    $this->session->set_userdata('isLecturer', true);
                    $this->load->view('lecDash', $data);
                }
            } else {
                $this->session->set_flashdata('message', 'Invalid login details');

                $this->load->view('login');
            }
        }
    }

    public function showAdminDash() {
        $sp = $this->getSP();
        $this->load->model('login');
        $data = $this->login->dashInformation($sp);
        $data['sp'] = $sp['sp'];
        $this->load->view('adminDash', $data);
    }

    public function showLectDash() {
        $sp = $this->getSP();
        $id = $this->session->userdata('username');
        $this->load->model('login');
        $data['students'] = $this->login->getStudentForSub($id);
        $data['sp'] = $sp['sp'];
        $this->load->view('lecDash', $data);
    }

    public function showUploadStudent() {
        $this->load->view('fileUpload');
    }

    public function showUploadLecturer() {
        $this->load->view('fileUploadLec');
    }

    public function showUploadSubject() {
        $this->load->view('fileUploadSub');
    }

    public function csvInsertStudent() {
        $this->load->model('login');

        $data = $_FILES['file']['tmp_name'];
        $fileRead = fopen($data, 'r');

        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                $check = $this->checkRow($row[0], 1);
                if (!$check) {
                    $value = "'" . implode("','", $row) . "'";

                    $q = "Insert into tbl_student(id,fname,lname) Values(" . $value . ")";
                    $this->db->query($q);
                } else {
                    $sql['id'] = row[0];
                    $sql['fname'] = $row[1];
                    $sql['lname'] = $row[2];
                    $this->db->replace('tbl_student', $sql);
                }
            }
            $flag = false;
        }

        $this->showStudent();
    }

    public function csvInsertLecturer() {

        $data = $_FILES['file']['tmp_name'];
        $fileRead = fopen($data, 'r');

        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                $check = $this->checkRow($row[1], 3);
                if (!$check) {
                    //$value = "'" . implode("','", $row[1]) . "'";
                    $q = "Insert into tbl_lecturer(name) Values('" . $row[1] . "')";
                    $this->db->query($q);
                } 
            }
            $flag = false;
        }
        $this->showLecturer();
    }

    public function csvInsertSubject() {

        $data = $_FILES['file']['tmp_name'];
        $fileRead = fopen($data, 'r');

        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                $subcode = $row[0];
                $check = $this->checkRow($row[0], 2);
                if (!$check) {
                    $userdata['username'] = $subcode;
                    $userdata['password'] = $subcode;
                    $userdata['type'] = 2;
                    $value = "'" . implode("','", $row) . "'";
                    $user = "'" . implode("','", $userdata) . "'";

                    $q = "Insert into tbl_subject(id,subject_name) Values(" . $value . ")";
                    $r = "Insert into tbl_user(username,password,type) Values(" . $user . ")";
                    $this->db->query($q);
                    $this->db->query($r);
                } else {
                    $sql['id'] = $row[0];
                    $sql['subject_name'] = $row[1];

                    $this->db->replace('tbl_subject', $sql);
                }
            }

            $flag = false;
        }
        $this->showSubjects();
    }

    public function showSubjects() {
        $this->load->model('login');
        $sp = $this->getSP();
        $data['sp'] = $sp['sp'];
        $data['sub'] = $this->login->getSubject($sp);
        $this->load->view('subjectList', $data);
    }

    public function showStudent() {
        $this->load->model('login');

        $data['sp'] = $this->getSP();
        $data['students'] = $this->login->getStudent();
        $this->load->view('studentList', $data);
    }

    public function showLecturer() {
        $this->load->model('login');

        $data['sp'] = $this->getSP();
        $data['lecturer'] = $this->login->getLecturer();
        $this->load->view('lecturerList', $data);
    }

    function getSP() {
        $date = getdate(date("U"));
        $sp['sp'] = "";
        $sp['trimester'] = "";
        $sp['year'] = $date['year'];

        if ($date["mon"] >= 3 && $date["mon"] < 7) {
            $sp['sp'] = "SP21_" . $date["year"];
            $sp['trimester'] = 1;
        } else if ($date["mon"] >= 7 && $date["mon"] < 11) {
            $sp['sp'] = "SP22_" . $date["year"];
            $sp['trimester'] = 2;
        } else {
            $year = $date["year"];
//            if($data['mon']==1 || $date['mon']==2){
//                 $year = $date["year"]-1;
//            }

            $sp['sp'] = "SP23_" . $year;
            $sp['trimester'] = 3;
        }
        return $sp;
    }

    public function checkRow($id, $type) {
        $this->db->select('*');

        if ($type == 1) {
            $this->db->from('tbl_student');
            $this->db->where('id', $id);
            $this->db->limit(1);
            $query = $this->db->get();
        }

        if ($type == 2) {
            $this->db->from('tbl_subject');
            $this->db->where('id', $id);
            $this->db->limit(1);
            $query = $this->db->get();
        }
        if ($type == 3) {
            $this->db->from('tbl_lecturer');
            $this->db->where('name', $id);
            $this->db->limit(1);
            $query = $this->db->get();
        }

        

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkMap($spname, $subCode, $spSubId, $lectureId, $studentId, $type) {
        if ($type == 1) {
            $this->db->from('tbl_sp_subject');
            $this->db->where('sp_id', $spname);
            $this->db->where('subject_id', $subCode);
        }
        if ($type == 2) {
            $this->db->from('tbl_subject_lecturer');
            $this->db->where('spSubId', $spSubId);
            $this->db->where('lecturer_id', $lectureId);
        }
        if ($type == 3) {
            $this->db->from('tbl_subject_student');
            $this->db->where('spSubId', $spSubId);
            $this->db->where('student_id', $studentId);
        }

        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getSpSubId($subCode, $spid) {
        $this->db->from('tbl_sp_subject');
        $this->db->where('sp_id', $spid);
        $this->db->where('subject_id', $subCode);
        $id = $this->db->get()->limit(1)->row();
        return $id->id;
    }

    public function addSubToSp() {
        $subCode = $this->input->post('subCode');
        if ($subCode != null) {
            $data['subject_id'] = $subCode;
            $this->load->model('login');
            $sp = $this->getSP();
            $data['sp_id'] = $sp['sp'];
            $check = $this->login->assignSubjectToSp($data);
            return $check;
        }
    }

    public function deleteSubSP() {
        $subCode = $this->input->post('subCode');
        if ($subCode != null) {
            $data['subject_id'] = $subCode;
            $this->load->model('login');
            $sp = $this->getSP();
            $data['sp_id'] = $sp['sp'];
            $check = $this->login->deleteSubtoSp($data);
            return $check;
        }
    }

    public function assignLecturer() {
        $data['id'] = $this->input->post('id');
        $data['lecturer'] = $this->input->post('lecturer');

        if ($data['lecturer'] != null && $data['id'] != null) {
            $this->load->model('login');
            $check = $this->login->assignLecturer($data);
            $this->session->set_flashdata('message', 'Lecturer Assigned');
           // $this->showAdminDash();
          // redirect($this->uri->uri_string());
            echo true;
            die;

        } else {
            $this->session->set_flashdata('message', 'Invalid details');
            $this->showAdminDash();
            echo false;
            die;
        }
    }

    //monty and mohit code
    public function showLecturerform() {
        $this->load->view('lecturer');
    }

    public function lecturerAdd() {
        $this->load->library('form_validation');

        //$this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');

        //$this->form_validation->set_rules('lname', 'lname', 'required');
        //$this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() == FALSE) {


            $this->load->view('lecturer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                    //'id' => $this->input->post('id'),
                    //'fname' => $this->input->post('fname'),
                    //'lname' => $this->input->post('lname')
            );
            $this->load->model('login');
            $check = $this->login->addaLecturer($data);
            if ($check) {

                $this->session->set_flashdata('message', 'A Lecturer has been added.');

                $this->showLecturer();
            } else {
                $this->session->set_flashdata('message', 'Invalid lecturer details');
            }
        }
    }

    public function studentAdd() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('fname', 'fname', 'required');

        $this->form_validation->set_rules('lname', 'lname', 'required');

        if ($this->form_validation->run() == FALSE) {


            $this->load->view('student');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname')
            );
            $this->load->model('login');
            $check = $this->login->addaStudent($data);
            if ($check) {

                $this->session->set_flashdata('message', 'A Student has been added.');

                $this->showStudent();
            } else {
                $this->session->set_flashdata('message', 'Invalid student details');
            }
        }
    }

    public function showStudentform() {
        $this->load->view('Student');
    }

    public function deleteLect() {
        $lectid = $this->input->get('lecId');
        if (isset($lectid)) {
            $this->db->where('id', $lectid)->delete('tbl_lecturer');
            $this->showLecturer();
        }
    }

    public function userAdd() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');


        if ($this->form_validation->run() == FALSE) {


            $this->load->view('user');
        } else {
            $data = array(
                'username' => $this->input->post('id'),
                'password' => $this->input->post('password'),
                'type' => 2,
            );
            $this->load->model('login');
            $check = $this->login->addaUser($data);
            if ($check) {

                $this->session->set_flashdata('message', 'A user has been added.');

                $this->showUser();
            } else {
                $this->session->set_flashdata('message', 'User already exists');
                $this->showUser();
            }
        }
    }

    public function showUser() {
        $this->load->view('user');
    }

    public function assignStudent() {
        $data = $_FILES['file']['tmp_name'];
        $fileRead = fopen($data, 'r');

        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                $check = $this->checkRow($row[0], 2);
                if (!$check) {
                    $value = "'" . implode("','", $row) . "'";

                    $q = "Insert into tbl_subject(id,subject_name) Values(" . $value . ")";
                    $this->db->query($q);
                } else {
                    $sql['id'] = $row[0];
                    $sql['subject_name'] = $row[1];

                    $this->db->replace('tbl_subject', $sql);
                }
            }

            $flag = false;
        }
    }

    public function insertCsvSubLect() {
        $data = $_FILES['file']['tmp_name'];
        $fileRead = fopen($data, 'r');
        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        if (isset($_SESSION)) {
            session_destroy();
            //unset($_SESSION);
        }
        redirect($this->index());
    }

    public function mapLecturerCsv() {
        $data = $_FILES['lecturer']['tmp_name'];
        $fileRead = fopen($data, 'r');
        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                if ($row[1] != null) {
                    //print_r($row);
                    $check = $this->checkLecturer($row[1]);
                    if ($check != 0) {
                        $subCheck = $this->checkSubjectLecturer($check, $row[0]);
                    }
                }
            }
            $flag = false;
        }
        $this->showAdminDash();
    }

    public function checkLecturer($name) {
        $check = $this->db->where('name', $name)->from('tbl_lecturer')->limit(1)->get()->row();
        if (isset($check)) {
            return $check->id;
        } else {
            $data['name'] = $name;
            $this->db->insert('tbl_lecturer', $data);
            return $this->db->insert_id();
        }
    }

    public function checkSubjectLecturer($id, $subcode) {
        $check = $this->db->from('tbl_subject_lecturer')->where('lecturer_id', $id)->where('spSub', $subcode)->limit(1)->get()->row();
        if (isset($check)) {
            return $check->id;
        } else {
            $data['lecturer_id'] = $id;
            $data['spSub'] = $subcode;
            $this->db->insert('tbl_subject_lecturer', $data);
        }
    }

    public function checkSubjectStudent() {
        $data = $_FILES['student']['tmp_name'];
        $fileRead = fopen($data, 'r');
        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                if ($row[1] != null) {
                    $subcode = $row[12];
                    $studentid = $row[1];
                    $studentFname = $row[3];
                    $studentLname = $row[2];
                    $this->checkStudent($studentid, $studentFname, $studentLname);
                    $this->checkStudentSubject($studentid, $subcode);
                }
            }
            $flag = false;
        }
        $this->showAdminDash();
    }

    public function checkStudent($id, $fname, $lname) {
        $student['id'] = $id;
        $student['fname'] = $fname;
        $student['lname'] = $lname;
        $checkData = $this->db->from('tbl_student')->where('id', $id)->get()->row();
        if (isset($checkData)) {
            $this->db->replace('tbl_student', $student);
        } else {

            $this->db->insert('tbl_student', $student);
        }
    }

    public function checkStudentSubject($studentid, $sc) {
        $subcode['spSubId'] = $this->session->userdata('sp');
        $subcode['student_id'] = $studentid;
        $subcode['subcode'] = $sc;
        $checkSubStd = $this->db->from('tbl_subject_student')->where('student_id', $subcode['studentId'])->where('subcode', $subcode['subcode'])->get()->row();
        if (!isset($checkSubStd)) {
            $this->db->insert('tbl_subject_student', $subcode);
        }
    }

    public function insertSubjectDash() {
        $data = $_FILES['subject']['tmp_name'];
        $fileRead = fopen($data, 'r');
        $flag = true;
        while ($row = fgetcsv($fileRead)) {
            if (!$flag) {
                $subcode = $row[0];
                $subSp['sp_id'] = $this->session->userdata('sp');
                $subSp['subject_id'] = $subcode;
                $check = $this->checkRow($row[0], 2);
                if (!$check) {
                    $userdata['username'] = $subcode;
                    $userdata['password'] = $subcode;
                    $userdata['type'] = 2;

                    $value = "'" . implode("','", $row) . "'";
                    $user = "'" . implode("','", $userdata) . "'";

                    $q = "Insert into tbl_subject(id,subject_name) Values(" . $value . ")";
                    $r = "Insert into tbl_user(username,password,type) Values(" . $user . ")";
                    $this->db->query($q);
                    $this->db->query($r);
                } else {
                    $sql['id'] = $row[0];
                    $sql['subject_name'] = $row[1];
                    $this->db->replace('tbl_subject', $sql);
                }
            }
            $this->load->model('login');
            $this->login->assignSubjectToSp($subSp);
            $flag = false;
        }
        $this->showAdminDash();
    }

    public function getSubStudent() {
        $data = null;
        $id = $this->input->get('subCode');
        if (isset($id)) {
            $this->load->model('login');
            $data = $this->login->getStudentForSub($id);
        }
        return $data;
    }

    public function getLecturer() {
        $data = null;
        $id = $this->input->get('subCode');
        if (isset($id)) {
            $this->load->model('login');
            $data = $this->login->getLecturerForSub($id);
        }
        return $data;
    }

    public function getSubStudentDash() {
        $id = $this->session->userdata('username');
        if (isset($id)) {
            $this->load->model('login');
            $data = $this->login->getStudentForSub($id);
        }
        return $data;
    }

    public function doAttendance() {
        $da['student_id'] = $this->input->post('studentId');
        $da['week_no'] = $this->input->post('week_no');
        $this->load->model('login');
        $this->login->addAttendance($da);
    }

    public function getAttendance() {
        $week = $this->input->get('week_no');
        $this->load->model('login');
        $check = $this->login->getAttendant($week);
        echo json_encode($check);
        die;
    }
    public function getSubjectLecturer(){
        $subid= $this->input->get('subId');
        $this->load->model('login');
        $check = $this->login->getLecturerId($subid);
        echo json_encode($check);
        die;
    }
    
}
