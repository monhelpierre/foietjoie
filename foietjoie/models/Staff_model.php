<?php

class Staff_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // count enseignant
    function countenseignant() {

        $query = $this->db->select('count(*) as ens')->where('role_id', 1)->get("staff_roles");
        return $query->row()->ens;
    }

    // count apprenant
    function countapprenant() {

        $query = $this->db->select('count(*) as app')->where('role_id', 2)->get("staff_roles");
        return $query->row()->app;
    }

    // count nbre cours publies
    function nbrecourspub() {

        $query = $this->db->select('count(*) as pub')->where('is_public', 'yes')->get("ressources");
        return $query->row()->pub;
    }

    // count nbre cours publies
    function nbrecoursnonpub() {

        $query = $this->db->select('count(*) as pub')->where('is_public', 'no')->get("ressources");
        return $query->row()->pub;
    }

    // count sexe user
    function countsexe($sexe) {

        $query = $this->db->select('count(*) as pub')->where('sexe', $sexe)->get("allusers");
        return $query->row()->pub;
    }


    // Verifier si e-mail est unique
    public function valid_email_id($str) {
        $email = $this->input->post('email');
        $id = $this->input->post('id');

        if (!isset($id)) {
            $id = 0;
        }
        if (!isset($staff_id)) {
            $staff_id = 0;
        }

        if ($this->check_email_exists($email, $id, $staff_id)) {
            $this->form_validation->set_message('check_exists', 'E-mail existe déjà dans le système');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_email_exists($email, $id, $staff_id) {

        if ($staff_id != 0) {
            $data = array('id != ' => $staff_id, 'email' => $email);
            $query = $this->db->where($data)->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            $this->db->where('email', $email);
            $query = $this->db->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    // FIN

     // Verifier si username est unique
    public function valid_username_id($str) {
        $username = $this->input->post('username');
        $id = $this->input->post('id');
        if (!isset($id)) {
            $id = 0;
        }
        if (!isset($staff_id)) {
            $staff_id = 0;
        }

        if ($this->check_username_exists($username, $id, $staff_id)) {
            $this->form_validation->set_message('check_exists', 'Nom d\'utilisateur existe déjà dans le système');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_username_exists($username, $id, $staff_id) {

        if ($staff_id != 0) {
            $data = array('id != ' => $staff_id, 'username' => $username);
            $query = $this->db->where($data)->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            $this->db->where('username', $username);
            $query = $this->db->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    // FIN

     // Verifier si username est unique
    public function valid_nif_id($str) {
        $nif = $this->input->post('nif');
        $id = $this->input->post('id');

        if (!isset($id)) {
            $id = 0;
        }
        if (!isset($staff_id)) {
            $staff_id = 0;
        }

        if ($this->check_nif_exists($nif, $id, $staff_id)) {
            $this->form_validation->set_message('check_exists', 'NIF existe déjà dans le système');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_nif_exists($nif, $id, $staff_id) {

        if ($staff_id != 0) {
            $data = array('id != ' => $staff_id, 'nif' => $nif);
            $query = $this->db->where($data)->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {

            $this->db->where('nif', $nif);
            $query = $this->db->get('allusers');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    // FIN

     public function getRole($id = null) {
        $this->db->select()->from('roles');
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

    public function notUniqueForUsers($id, $field, $value) {
        $this->db->select('*');
        $this->db->from('allusers');
        $this->db->where('id !=' , $id);
        $this->db->where($field, $value);
        if ($this->db->get()->row_array()) {
            return true;
        } 
        return false;
    }


    public function getDepartement($id = null) {
        $this->db->select()->from('departement');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSection($id_commune = null) {
        $this->db->select('*')->from('section_communale');
        $this->db->where('id_commune', $id_commune);
        $this->db->order_by('id_section', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
     }


    public function getCommuneId($id_departement = null) {
        $this->db->select('*')->from('commune');
        $this->db->where('id_departement', $id_departement);
        $query = $this->db->get();
        return $query->result_array();
    }
    
     public function getDepartementByName($id = null) {
        $this->db->select()->from('departement');
        $this->db->where('id_departement', $id); 
        $query = $this->db->get();
        return $query->result();
    }
    

    // profile user
    public function getProfile($id) {
        $this->db->select('allusers.*,staff_roles.role_id,departement.id_departement AS id_departement,departement.nom AS nom_dep,commune.id_commune AS id_commune,commune.nom AS nom_commune ,section_communale.id_section AS id_section_communale,section_communale.nom AS nom_section,roles.name as user_type');
        $this->db->join("departement", "departement.id_departement = allusers.departement_id", "left");
        $this->db->join("commune", "commune.id_commune = allusers.commune_id", "left");
        $this->db->join("section_communale", "section_communale.id_section = allusers.section_id", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
        $this->db->where("allusers.id", $id);
        $this->db->from('allusers');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getAll($id = null, $is_active = null) {

        $this->db->select('allusers.*,staff_roles.role_id,departement.id_departement AS id_departement,departement.nom AS nom_dep,commune.id_commune AS id_commune,commune.nom AS nom_commune ,section_communale.id_section AS id_section_communale,section_communale.nom AS nom_section,roles.name as user_type');
        $this->db->from('allusers');
        $this->db->join("departement", "departement.id_departement = allusers.departement_id", "left");
        $this->db->join("commune", "commune.id_commune = allusers.commune_id", "left");
        $this->db->join("section_communale", "section_communale.id_section = allusers.section_id", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
       
        if ($id != null) {
            $this->db->where('allusers.id', $id);
        } else {
            if ($is_active != null) {
                $this->db->where('allusers.is_active', $is_active);
            }
            $this->db->order_by('allusers.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    // add user
    public function addMessage($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('communication', $data);
        } else {
            $this->db->insert('communication', $data);
            $inserted_id = $this->db->insert_id();
            $this->db->where('receiver', $data['sender']);
            $this->db->where('sender', $data['receiver']);
            $this->db->update('communication', array('status' => 'read'));
            return $inserted_id;
        }
    }

    // add user
    public function getConversation($sender, $receiver = null) {
        $this->load->database();    
        $sql = "SELECT * FROM saq_communication WHERE ";
        if($receiver == null){
            $sql .= "sender = '" . $sender . "' OR receiver = '" . $sender . "'";
        }else{
            $sql .= "(sender = '" . $sender . "'AND receiver = '" . $receiver . "') OR  
            sender = '" . $receiver . "'AND receiver = '" . $sender . "'";
        }
        $sql .= " ORDER BY created_at ASC;";
        return $this->db->query($sql)->result_array();
    }

    public function getUsersByType($user_type) {
        return $this->db->select('allusers.*')
        ->from('allusers')
        ->join("staff_roles", "staff_roles.staff_id = allusers.id")
        ->join("roles", "staff_roles.role_id = roles.id")
        ->where('roles.name != ', $user_type)
        ->get()->result_array();
    }

    // add user
    public function add($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('allusers', $data);
        } else {
            $this->db->insert('allusers', $data);
            return $this->db->insert_id();
        }
    }

    public function addRelationRoleUser($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('staff_roles', $data);
        } else {
            $this->db->insert('staff_roles', $data);
            return $this->db->insert_id();
        }
    }

    // count function
    public function count_functions($id) {
        $query = $this->db->select("*")->join("staff", "function_employee.id = staff.id_staff_function")->where("function_employee.id", $id)->where("staff.is_active", 1)->get("function_employee");
        return $query->num_rows();
    }


    // this is three function globa.
    function delete($id, $table, $filename = null) {
        // if($filename != null) unlink(BASEPATH . "uploads/ressources/video/" . $filename);
        $this->db->where("id", $id)->delete($table);
    }


    public function getOne($id, $table=null)
    {
        $this->db->select('*')->from($table)->where('id',$id);
        return $this->db->get()->row_array();
    }

    public function getAllFrom($table){
        $this->db->select('*')->from($table);
        return $this->db->get()->result_array();
    }

    public function getRoleForUser($staff_id){
        $this->db->select('*')->from('staff_roles')->where('staff_id',$staff_id);
        return $this->db->get()->result_array();
    }

    public function update($data, $table) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    // end function global

    public function getByVerificationCode($ver_code) {
        $condition = "verification_code =" . "'" . $ver_code . "'";
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function adddoc($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('staff_documents', $data);
        } else {
            $this->db->insert('staff_documents', $data);
            return $this->db->insert_id();
        }
    }

    public function remove($id) {

        $this->db->where('id', $id);
        $this->db->delete('staff');

        $this->db->where('staff_id', $id);
        $this->db->delete('staff_payslip');

        $this->db->where('staff_id', $id);
        $this->db->delete('staff_leave_request');

        $this->db->where('staff_id', $id);
        $this->db->delete('staff_attendance');
    }

    public function valid_employee_id($str) {
        $name = $this->input->post('name');
        $id = $this->input->post('employee_id');
        $staff_id = $this->input->post('editid');

        if((!isset($id)))  {
            $id = 0;
        }
        if (!isset($staff_id)) {
            $staff_id = 0;
        }

        if ($this->check_data_exists($name, $id, $staff_id)) {
            $this->form_validation->set_message('username_check', 'Record already exists');
            return FALSE; 
        } else {
            return TRUE;
        }
       
    }

    function check_data_exists($name, $id, $staff_id) {
        if ($staff_id != 0) {
            $data = array('id != ' => $staff_id, 'employee_id' => $id);
            $query = $this->db->where($data)->get('staff');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $this->db->where('employee_id', $id);
            $query = $this->db->get('staff');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function getStaffId($empid) {
        $data = array('id' => $empid);
        $query = $this->db->select('id')->where($data)->get("staff");
        return $query->row_array();
    }

    public function doc_delete($id, $doc, $file) {

        if ($doc == 1) {

            $data = array('resume' => '',);
        } else
        if ($doc == 2) {

            $data = array('joining_letter' => '',);
        } else
        if ($doc == 3) {

            $data = array('resignation_letter' => '',);
        } else
        if ($doc == 4) {

            $data = array('other_document_name' => '', 'other_document_file' => '',);
        }
        unlink(BASEPATH . "uploads/staff_documents/" . $file);
        $this->db->where('id', $id)->update("staff", $data);
    }



    public function disablestaff($id) {
        $data = array('is_active' => 'no');
        $query = $this->db->where("id", $id)->update("allusers", $data);
    }

    public function enablestaff($id) {
        $data = array('is_active' => 'yes');
        $query = $this->db->where("id", $id)->update("allusers", $data);
    }

    public function getByEmail($email) {
        $this->db->select('*');
        $this->db->from('allusers');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function checkLogin($data) {

        $record = $this->getByEmail($data['email']);
        if ($record) {
            $pass_verify = $this->enc_lib->passHashDyc($data['password'], $record->password);
            if ($pass_verify) {
                $roles = $this->staffroles_model->getStaffRoles($record->id);
                $record->roles = array($roles[0]->name => $roles[0]->role_id);
                return $record;
            }
        }
        return false;
    }
    
    public function update_role($role_data) {
        $this->db->where("staff_id", $role_data["staff_id"])->update("staff_roles", $role_data);
    }


    // ALL FUNCTIONS MODEL FOR MODULE RESSOURCE

     public function getAllRessources($id = null, $is_public = null, $teacher_id = null) {

        $this->db->select('ressources.*,roles.name as user_type, nom, prenom');
        $this->db->from('ressources');
        $this->db->join("allusers", "allusers.id = ressources.user_add", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
       
        if ($id != null) {
            $this->db->where('ressources.id', $id);
        } else {
            if ($is_public != null) {
                $this->db->where('ressources.is_public', $is_public);
            }
            $this->db->order_by('ressources.id');
        }

        if($teacher_id != null){
            $this->db->where('allusers.id', $teacher_id);
        }

        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function getEvaluationByTeacher($id_teacher, $id_eval = null) {
        
        $this->db->select('evaluate.*,roles.name as user_type, nom, prenom,titre_cours');
        $this->db->from('evaluate');
        $this->db->join("ressources", "ressources.id = evaluate.id_course", "left");
        $this->db->join("allusers", "allusers.id = ressources.user_add", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
        $this->db->where('allusers.id', $id_teacher);

        if($id_eval != null){
            $this->db->where('evaluate.id', $id_eval);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEvaluationByCourse($id_course, $id_eval = null) {
        
        $this->db->select('evaluate.*,roles.name as user_type, nom, prenom,titre_cours');
        $this->db->from('evaluate');
        $this->db->join("ressources", "ressources.id = evaluate.id_course", "left");
        $this->db->join("allusers", "allusers.id = ressources.user_add", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
        $this->db->where('evaluate.id_course', $id_course);

        if($id_eval != null){
            $this->db->where('evaluate.id', $id_eval);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEvaluate($id_course = null) {
        $this->db->select('evaluate.*,roles.name as user_type, nom, prenom,titre_cours');
        $this->db->from('evaluate');
        $this->db->join("ressources", "ressources.id = evaluate.id_course", "left");
        $this->db->join("allusers", "allusers.id = ressources.user_add", "left");
        $this->db->join("staff_roles", "staff_roles.staff_id = allusers.id", "left");
        $this->db->join("roles", "staff_roles.role_id = roles.id", "left");
        $this->db->where('evaluate.id_course', $id_course);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addEvaluate($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('evaluate', $data);
        } else {
            $this->db->insert('evaluate', $data);
            return $this->db->insert_id();
        }
    }

    public function addResultEvaluate($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('resultat_evaluation', $data);
        } else {
            $this->db->insert('resultat_evaluation', $data);
            return $this->db->insert_id();
        }
    }

    public function addcourse($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('ressources', $data);
        } else {
            $this->db->insert('ressources', $data);
            return $this->db->insert_id();
        }
    }

    public function isAlreadyAnswered($id_evaluate) {
        $this->db->select('*');
        $this->db->from('resultat_evaluation');
        $this->db->where('id_evaluate', $id_evaluate);
        $query = $this->db->get();
        if($query->row_array()){
            return false;
        }
        return true;
    }

    public function getResultEvaluate($id_course, $id_user = null) {

        // $this->db->where('id_user', $id_user);
        // $this->db->delete('resultat_evaluation');
        // $this->load->database();    
        // $this->db->query("ALTER TABLE saq_resultat_evaluation ADD id_course int NULL");
        

        $this->db->select('resultat_evaluation.id, resultat_evaluation.id_evaluate, resultat_evaluation.resultat, resultat_evaluation.date, resultat_evaluation.id_course');
        $this->db->from('resultat_evaluation');
        $this->db->where('id_course', $id_course);
        if($id_user != null){
            $this->db->where('id_user', $id_user);
        }else{
            $this->db->select('ressources.titre_cours, ressources.description');
            $this->db->select('allusers.nom, allusers.prenom');
            $this->db->join("ressources", "ressources.id = resultat_evaluation.id_course");
            $this->db->join("allusers", "allusers.id = resultat_evaluation.id_user");
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>