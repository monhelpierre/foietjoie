<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userlog_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getConnetecForEveryMonth($currentYear = null){
        $now = date('Y-m-d');
        $currentMonth = substr($now, 5, 2);
        if($currentYear == null){
            $currentYear = substr($now, 0, 4);
        }
        $sql = "SELECT * FROM saq_userlog WHERE login_datetime LIKE '%" . $currentYear . "%'";
        $query = $this->db->query($sql);
        $logs =  $query->result_array();
        $data = array();
        for($count = 1; $count <= 12; $count++){
            $total_en = 0;
            $total_ap = 0;
            foreach ($logs as $k => $v) {
                $fulldata = $v['login_datetime'];
                $month = substr($fulldata, 5, 2);
                if(intval($month) == $count){
                    if($v['role'] == "Enseignant(e)"){
                        $total_en++;
                    }else{
                        $total_ap++;
                    }
                }
            }
            array_push($data, array('month' => $this->convert($count), 'is_current_month' => ($count == $currentMonth), 'nb_en' => $total_en, 'nb_ap' => $total_ap, 'total' => ($total_en + $total_ap)));
        }
        return $data;
    }

    private function convert($month){
        if($month == 1) return 'Jan';
        if($month == 2) return 'Fev';
        if($month == 3) return 'Mar';
        if($month == 4) return 'Avr';
        if($month == 5) return 'Mai';
        if($month == 6) return 'Jun';
        if($month == 7) return 'Jul';
        if($month == 8) return 'Aou';
        if($month == 9) return 'Sep';
        if($month == 10) return 'Oct';
        if($month == 11) return 'Nov';
        if($month == 12) return 'Dec';   
    }

    public function get($id = null) {
        $this->db->select()->from('userlog');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('login_datetime', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }

    public function getByRole($role) {
        $this->db->select()->from('userlog');
        $this->db->where('role', $role);
        $this->db->order_by('login_datetime', 'desc');
        $query = $this->db->get();
        return $query->result_array();   
    }

    public function getByRoleStaff() {
        $this->db->select()->from('userlog');
        $this->db->where('role!=', 'Parent');
        $this->db->where('role!=', 'Student');
        $this->db->order_by('login_datetime', 'desc');
        $query = $this->db->get();
        return $query->result_array();    
    }


    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('userlog', $data);
        } else {
            $this->db->insert('userlog', $data);
        }
    }

}
