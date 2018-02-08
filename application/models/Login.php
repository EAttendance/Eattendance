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
class Login extends CI_Model {

    //put your code here
    public function checkLogin($data) {

        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $data['email']);
        $this->db->where('password', $data['password']);

        $this->db->limit(1);
        $query = $this->db->get()->row();

        if (isset($query)) {
            return $query->type;
        } else {
            return 0;
        }
    }

    public function getStudent() {
        $data = $this->db->get('tbl_student')->result();
        return $data;
    }

    public function getLecturer() {
        $data = $this->db->get('tbl_lecturer')->result();
        return $data;
    }

    public function getSubject($sp) {
        $data = [];
        $alldata = $this->db->get('tbl_subject')->result_array();
        if ($sp != null) {
            foreach ($alldata as $d) {
                $this->db->select('*');
                $this->db->from('tbl_sp_subjects');
                $this->db->where('sp_id', $sp['sp']);
                $this->db->where('subject_id', $d['id']);
                $query = $this->db->get();

                if ($query->num_rows() == 1) {
                    $d['check'] = true;
                } else {
                    $d['check'] = false;
                }
                array_push($data, (object) $d);
            }
        }


        return (object) $data;
    }

    public function dashInformation($sp) {
        $arr = [];
        $da = $this->db->where('sp_id', $sp['sp'])->get('tbl_sp_subjects')->result_array();


        if ($sp != null) {
            foreach ($da as $d) {
                $q1 = $this->db->select('*')->from('tbl_subject')->where('id', $d['subject_id'])->limit(1)->get()->row();
                $lect = $this->db->select('*')->where('spSub', $d['subject_id'])->get('tbl_subject_lecturer')->result();
                if (count($lect) != 0) {
                    $lecid = [];
                    foreach ($lect as $i) {
                        array_push($lecid, $i->lecturer_id);
                    }

                    $lecturer = $this->db->where_in('id', $lecid)->get('tbl_lecturer')->result();
                    $d['lecturer'] = $lecturer;
                } else {
                    $d['lecturer'] = null;
                }
                $d['sub'] = $q1->subject_name;
                //$name="Not Available";


                $d['sp'] = $sp['sp'];
                array_push($arr, (object) $d);
            }
        }
        $data['dashinfo'] = (object) $arr;
        $data['allLecturer'] = $this->db->get('tbl_lecturer')->result();
        $data['studentCount']=$this->db->count_all('tbl_student');
        
        $data['subjectCount']=$this->db->count_all('tbl_student');
        
        $data['lecturerCount']=$this->db->count_all('tbl_lecturer');
        
        return $data;
    }

    public function getStudentForSub($id) {
        $subStudent = $this->db->select('*')->from('tbl_subject_student')->where('subCode', $id)->get()->result();
        if (count($subStudent) > 0) {
            if (isset($subStudent)) {
                $studentId = [];
                foreach ($subStudent as $s) {
                    array_push($studentId, $s->student_id);
                }
                $data = $this->db->select('*')->from('tbl_student')->where_in('id', $studentId)->get()->result();
            }
        }
        return $data;
    }

    public function getLecturerForSub($subid) {
        $lectSub = $this->db->select('*')->from('tbl_subject_lecturer')->where('spSub', $subid)->get()->result();
        if (count($lectSub) > 0) {
            if (isset($lectSub)) {
                $lectId = [];
                foreach ($lectSub as $s) {
                    array_push($lectId, $s->lecturer_id);
                }
                $data = $this->db->select('*')->from('tbl_lecturer')->where_in('id', $lectId)->get()->result();
            }
        }
        return $data;
    }

    public function assignSubjectToSp($data) {

        if ($data['sp_id'] != null && $data['subject_id'] != null) {
            $check = $this->db->from('tbl_sp_subjects')->where($data)->get()->row();
            if (!isset($check)) {
                $this->db->insert('tbl_sp_subjects', $data);
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function deleteSubtoSp($data) {
        if ($data['sp_id'] != null && $data['subject_id'] != null) {

            $this->db->delete('tbl_sp_subjects', $data);
            return true;
        } else {
            return false;
        }
    }

    public function assignLecturerToSub($data) {
        if ($data['subId'] != null && $data['lecId']) {
            $var['subject_id'] = $data['subId'];
            $var['lecturer_id'] = $data['lecId'];
            $this->db->insert('tbl_subject_lecturer', $var);
            return true;
        } else {
            return false;
        }
    }

    public function assignStudentToSub($data) {
        if ($data['subId'] != null && $data['stdId']) {
            $var['subject_id'] = $data['subId'];
            $var['student_id'] = $data['stdId'];
            $this->db->insert('tbl_subject_student', $var);
            return true;
        } else {
            return false;
        }
    }

    public function assignLecturer($data) {
        $lecIds=$data['lecturer'];
        $subjectCode=$this->db->from('tbl_sp_subjects')->where('id',$data['id'])->get()->row();
       
        if(isset($subjectCode)){
           $this->db->where('spSub',$subjectCode->subject_id)->delete('tbl_subject_lecturer');
            foreach($lecIds as $l){
             $existing=$this->db->from('tbl_subject_lecturer')->where('lecturer_id',$l)->where('spSub',$subjectCode->subject_id)->get()->row();
             if(!isset($existing)){
                   $d['lecturer_id']=$l;
                   $d['spSub']=$subjectCode->subject_id;
                   $this->db->insert('tbl_subject_lecturer',$d);
               }
            }
        }
    }

    public function SpCheck($data) {
        if ($data['sp'] != null) {
            $this->db->from('tbl_sp');
            $this->db->where('sp', $data['sp']);
            $this->db->limit(1);
            $query = $this->db->get()->row();

            if (isset($query)) {
                return $query->id;
            } else {
                $this->db->insert('tbl_sp', $data);
                return $this->db->insert_id();
            }
        }
    }

    public function getSubjectSp($sp) {
        if ($sp != null) {
            $subject = $this->session->userdata('username');
            $query = $this->db->select('*')->from('tbl_sp_subjects')->where('sp_id', $sp)->where('subject_id', $subject)->get()->row();


            if (isset($query)) {
                return $query->id;
            }
        }
    }

    public function AddaLecturer($data) {
        if ($data != null) {
            $this->db->replace('tbl_lecturer', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddaStudent($data) {
        if ($data != null) {
            $this->db->replace('tbl_student', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddaUser($data) {
        if ($data != null) {
            $check = $this->checkUser($data);

            if ($check) {
                $this->db->insert('tbl_User', $data);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function checkUser($data) {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $data['username']);
        $this->db->where('type', 2);

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function addAttendance($da) {
        $da['sp_sub_id'] = $this->session->userdata('subSp');
        $query = $this->db->select('*')->from('tbl_attendance')->where('student_id', $da['student_id'])->where('week_no', $da['week_no'])->where('sp_sub_id', $da['sp_sub_id'])->get()->row();
        if($da['comment']!=null){
             $da['attendance'] = true;
        }
        if (isset($query)) {
            if ($query->attendance) {
                $da['attendance'] = null;
                $this->db->where('student_id', $da['student_id'])->where('week_no', $da['week_no'])->where('sp_sub_id', $da['sp_sub_id']);
                $this->db->update('tbl_attendance', $da);
            }
        } else {
            $this->db->insert('tbl_attendance', $da);
        }
    }

    public function getAttendant($week) {
        $subSp = $this->session->userdata('subSp');
        $query = $this->db->select('*')->from('tbl_attendance')->where('week_no', $week)->where('sp_sub_id', $subSp)->get()->result();
        return $query;
    }

    public function getLecturerId($sub) {
        $d = $this->db->where('id', $sub)->get('tbl_sp_subjects')->row();

        if (isset($d)) {
            $lect = $this->db->select('*')->where('spSub', $d->subject_id)->get('tbl_subject_lecturer')->result();
            if (count($lect) != 0) {
                $lecid = [];
                foreach ($lect as $i) {
                    array_push($lecid, $i->lecturer_id);
                }
                return $lecid;
            }
        }
    }

}
