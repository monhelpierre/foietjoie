<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
        $this->db->select()->from('sch_settings');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getSchoolDetail($id = null) {

        $this->db->select('*');
        $this->db->from('sch_settings');
        $this->db->order_by('sch_settings.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function getSetting() {

        $this->db->select('*');
        $this->db->from('sch_settings');
        $this->db->order_by('sch_settings.id');
        $query = $this->db->get();
        return $query->row();
    }


    public function getCurrentSchoolName() {
        $session_result = $this->get();
        return $session_result[0]['name'];
    }

    public function getDateYmd() {
        return date('Y-m-d');
    }


    public function getCurrentSession() {
        return date('Y-m-d');
    }

     public function getCurrentSessionName() {
        return date('Y-m-d');
    }

    public function getDateDmy() {
        return date('d-m-Y');
    }

    public function getStartMonth() {
        return date('d-m-Y');
    }

  

}
