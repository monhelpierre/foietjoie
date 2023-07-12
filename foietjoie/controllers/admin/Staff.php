<?php

class Staff extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->config->load("payroll");
        $this->marital_status = $this->config->item('marital_status');
        $this->file_type = $this->config->item('file_type');
    }


    // liste dossier employe
    function profile($id) {
        if(!is_numeric($id)){
            redirect(base_url());
        }
        if ($this->session->userdata('admin')['id'] != $id) {
            redirect(base_url());
        }

        $allressources = $this->staff_model->getAllRessources(null,'yes');
        $data["allressources"] = $allressources;


        $data["id"] = $id;
        $data['title'] = 'PROFIL';
        $staff_info = $this->staff_model->getProfile($id);
        $data['u'] = $staff_info;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/staffprofile', $data);
        $this->load->view('layout/footer', $data);
    }


    function editevaluation($id){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $loop = $this->input->post('i');
            $questionsAndAnswers = array();

            foreach ($loop as $key => $value) {
                // les 4 choix affiches
                $choices['1'] = $this->input->post('choix1_'.$value);
                $choices['2'] = $this->input->post('choix2_'.$value);
                $choices['3'] = $this->input->post('choix3_'.$value);
                $choices['4'] = $this->input->post('choix4_'.$value);
                // fin

                // les 4 reponses possibles
                $answers['1'] = $this->input->post('reponse_'.$value);
                $answers['2'] = $this->input->post('reponse1_'.$value);
                $answers['3'] = $this->input->post('reponse2_'.$value);
                $answers['4'] = $this->input->post('reponse3_'.$value);
                $answers['5'] = $this->input->post('reponse4_'.$value);
                
                $question['questions'] = json_encode(array('titre' => $this->input->post('question_'.$value), 'choices' => $choices, 'answers' => $answers));
                $questionsAndAnswers[$key] = $question;
            }

            $data = array(
                'id' => $id,
                'form' => json_encode($questionsAndAnswers)
            );

            $this->staff_model->addEvaluate($data);
            redirect('evaluation');

        }else{
            $data['title'] = "MODIFIER EVALUATION";
            $data['id'] = $id;
            $data['onlyshow'] = null;
            $data['evals'] = $this->staff_model->getEvaluationByTeacher($this->session->userdata('admin')['id'], $id);
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staff/editeval', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function voirevaluation($id){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}

        $data['title'] = "VOIR EVALUATION";
        $data['id'] = $id;
        $data['onlyshow'] = true;
        $data['evals'] = $this->staff_model->getEvaluationByTeacher($this->session->userdata('admin')['id'], $id);

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/editeval', $data);
        $this->load->view('layout/footer', $data);
    }

    function evaluation(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}

        $data['title'] = "LISTE D'EVALUATION";
        $data['page'] = 'list';
        $data['table'] = 'html';
        $data['evals'] = $this->staff_model->getEvaluationByTeacher($this->session->userdata('admin')['id']);

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/listevaluate', $data);
        $this->load->view('layout/footer', $data);
    }

    public function getFirstQuestion($form){
        $var = $this->decodeJson($form['form'], '0');
        $var = $this->decodeJson($var['form']['question']);
        return $var['question'];  
    }

    public function decodeJson($txt, $field = null){
        $var = json_decode($txt, TRUE);

        if($field != null){
            return $var[$field]; 
        }
        return $var;  
    }

    function listusers(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        
        $data['title'] = "LISTE DES UTILISATEURS";
        $data['page'] = 'list';
        $data['table'] = 'html';
        $data['allusers'] = $this->staff_model->getAll();
        $data['current_user'] = $this->customlib->getUserData();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/list_users', $data);
        $this->load->view('layout/footer', $data);
    }

    function blockedusers(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        $data['title'] = "UTILISATEURS BLOQUES";
        $data['page'] = 'list';
        $data['table'] = 'html';
        $data['allusers'] = $this->staff_model->getAll(null, 'no');
        $data['current_user'] = $this->customlib->getUserData();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/list_users', $data);
        $this->load->view('layout/footer', $data);
    }

    function getCommune() {
        $id_department = $this->input->get('id_departement');
        $data = $this->staff_model->getCommuneId($id_department);
        echo json_encode($data);
    }
    
    function getSectionCommunal() {
        $comm = $this->input->get('id_commune');
        $data = $this->staff_model->getSection($comm);
        echo json_encode($data);
    }

    //edit user to db
    function editusertodb(){
        $user_id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pname', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Téléphone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sexe', 'Sexe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nif', 'NIF', 'required');
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required');
        $this->form_validation->set_rules('id_departement', 'Departement', 'trim|xss_clean');
        $this->form_validation->set_rules('id_commune', 'Commune', 'trim|xss_clean');
        $this->form_validation->set_rules('section', 'Section Communale', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status Matrimonial', 'trim|required|xss_clean');
        $this->form_validation->set_rules('profession', 'Profession', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_type', 'Type utilisateur', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date de naissance', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean', array('valid_email' => 'Invalid Email', ));

        if ($this->form_validation->run() == false) {
            $data = array(
                'name' => form_error('name'),
                'adresse' => form_error('adresse'),
                'pname' => form_error('pname'),
                'sexe' => form_error('sexe'),
                'adresse' => form_error('adresse'),
                'email' => form_error('email'),
                'username' => form_error('username'),
                'id_departement' => form_error('id_departement'),
                'id_commune' => form_error('id_commune'),
                'section' => form_error('section'),
                'nif' => form_error('nif'),
                'status' => form_error('status'),
                'dob' => form_error('dob'),
                'profession' => form_error('profession'),
                'user_type' => form_error('user_type'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        }else{
            $allUnique = true;

            if($this->staff_model->notUniqueForUsers($user_id, 'email', $this->input->post('email'))){
                $array = array('status' => 'error', 'fail' => '','message' => 'Veuillez saisir un autre email');
                $allUnique = false;
            }else if($this->staff_model->notUniqueForUsers($user_id, 'nif', $this->input->post('nif'))){
                $array = array('status' => 'error', 'fail' => '','message' => 'Veuillez saisir un autre nif');
                $allUnique = false;
            }else if($this->staff_model->notUniqueForUsers($user_id, 'username', $this->input->post('username'))){
                $array = array('status' => 'error', 'fail' => '','message' => "Veuillez saisir un autre nom d'utilisateur");
                $allUnique = false;
            }else if($this->staff_model->notUniqueForUsers($user_id, 'phone', $this->input->post('phone'))){
                $array = array('status' => 'error', 'fail' => '','message' => 'Veuillez saisir un autre telephone');
                $allUnique = false;
            }

            $old_data = $this->staff_model->getProfile($user_id);
            $nom = empty($this->input->post('name')) ? $old_data['nom'] : $this->input->post('name');
            $prenom = empty($this->input->post('pname')) ? $old_data['prenom'] : $this->input->post('pname');
            $sexe = empty($this->input->post('sexe')) ? $old_data['sexe'] : $this->input->post('sexe');
            $dob = empty($this->input->post('dob')) ? $old_data['dob'] : $this->input->post('dob');
            $adresse = empty($this->input->post('adresse')) ? $old_data['adresse'] : $this->input->post('adresse');
            $email = empty($this->input->post('email')) ? $old_data['email'] : $this->input->post('email');
            $username = empty($this->input->post('username')) ? $old_data['username'] : $this->input->post('username');
            $nif = empty($this->input->post('nif')) ? $old_data['nif'] : $this->input->post('nif');
            $phone = empty($this->input->post('phone')) ? $old_data['phone'] : $this->input->post('phone');
            $status = empty($this->input->post('status')) ? $old_data['status'] : $this->input->post('status');
            $department_id = empty($this->input->post('id_departement')) ? $old_data['department_id'] : $this->input->post('id_departement');
            $commune_id = empty($this->input->post('id_commune')) ? $old_data['commune_id'] : $this->input->post('id_commune');
            $section_id = empty($this->input->post('section')) ? $old_data['section_id'] : $this->input->post('section');
            $profession = empty($this->input->post('profession')) ? $old_data['profession'] : $this->input->post('profession');

            if($allUnique){
                $data = array(
                    'id' => $user_id,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'sexe' => $sexe,
                    'dob' => $dob,
                    'adresse' => $adresse,
                    'email' => $email,
                    'username' => $username,
                    'nif' => $nif,
                    'phone' => $phone,
                    'status' => $status,
                    'departement_id' => $department_id,
                    'commune_id' => $commune_id,
                    'section_id' => $section_id,
                    'profession' => $profession,
                    'user_add' =>   $this->session->userdata('admin')['id']
                );
                $this->staff_model->add($data);
                // $role_id = $this->staff_model->getRoleForUser($user_id)->id;
                // $this->staff_model->addRelationRoleUser(array('id' => $role_id, 'role_id' => $this->input->post('user_type'), 'staff_id' => $user_id));
                $array = array('status' => 'success', 'message' => 'L\'Utilisateur a été modifié avec succès.');
            }

            echo json_encode($array);
        }
    }

    //add user to db
    function addusertodb(){
        $this->form_validation->set_rules('name', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pname', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Téléphone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sexe', 'Sexe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('adresse', 'Adresse', 'trim|required|xss_clean');
         $this->form_validation->set_rules('nif', 'NIF', array('required',array('check_exists', array($this->staff_model, 'valid_nif_id'))));
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', array('required',array('check_exists', array($this->staff_model, 'valid_username_id'))
                ));
        // $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[6]|is_unique[register_users.username]',[
           // 'is_unique' => 'L\' %s existe déjà dans le système. SVP essayez un autre !!!',
        // ]);
     
        $this->form_validation->set_rules('id_departement', 'Departement', 'trim|required|xss_clean');
        $this->form_validation->set_rules('id_commune', 'Commune', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section', 'Section Communale', 'trim|xss_clean');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status Matrimonial', 'trim|required|xss_clean');
        $this->form_validation->set_rules('profession', 'Profession', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_type', 'Type utilisateur', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date de naissance', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean', array(
          'valid_email' => 'Invalid Email', ));
        $this->form_validation->set_rules(
                'email', 'Email', array('required', 'valid_email',
            array('check_exists', array($this->staff_model, 'valid_email_id'))
                )
        );

        if ($this->form_validation->run() == false) {
            $data = array(
                'name' => form_error('name'),
                'adresse' => form_error('adresse'),
                'pname' => form_error('pname'),
                'sexe' => form_error('sexe'),
                'adresse' => form_error('adresse'),
                'email' => form_error('email'),
                'username' => form_error('username'),
                'id_departement' => form_error('id_departement'),
                'id_commune' => form_error('id_commune'),
                'section' => form_error('section'),
                'nif' => form_error('nif'),
                'status' => form_error('status'),
                'password' => form_error('password'),
                'dob' => form_error('dob'),
                'profession' => form_error('profession'),
                'user_type' => form_error('user_type'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        }else{
            $data = array(
                'nom' => $this->input->post('name'),
                'prenom' => $this->input->post('pname'),
                'sexe' => $this->input->post('sexe'),
                'dob' => $this->input->post('dob'),
                'adresse' => $this->input->post('adresse'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'nif' => $this->input->post('nif'),
                'password' => $this->enc_lib->passHashEnc($this->input->post('password')),
                'phone' => $this->input->post('phone'),
                'status' => $this->input->post('status'),
                'departement_id' => $this->input->post('id_departement'),
                'commune_id' => $this->input->post('id_commune'),
                'section_id' => $this->input->post('section'),
                'profession' => $this->input->post('profession'),
                'user_add' =>   $this->session->userdata('admin')['id']
            );
            $last_insert_id = $this->staff_model->add($data);
            $this->staff_model->addRelationRoleUser(array('role_id' => $this->input->post('user_type'), 'staff_id' => $last_insert_id));
            $array = array('status' => 'success', 'message' => 'L\'Utilisateur a été enregistré avec succès.');
            echo json_encode($array);

        }

    }

    function sendmessage(){
        $data['title'] = "ENVOYER MESSAGE";
        $data['page'] = 'sendmessage';

        $current = $this->customlib->getUserData();
        $current['user_type'] = json_decode($this->customlib->getStaffRole())->name;

        $conversation = $this->separateDateAndTime($this->staff_model->getConversation($current['id']), true);

        $data['allusers'] = $this->setLastMessage($this->staff_model->getAll(), $conversation, $current);
        $data['current'] = $current;
        $data['conversation'] = $conversation;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/sendmessage');
        $this->load->view('layout/footer');
    }

    function getSomeText($txt){
        $len = trim(strlen($txt));
        if( $len >=0 && $len < 10){
            return $txt;
        }
        return substr(trim($txt), 0, 10) . '...';
    }

    function setLastMessage($allusers, $conversation, $current){
        foreach ($allusers as $key => $value) {
            $role = $this->staff_model->getProfile($value['id']);
            $allusers[$key]['fullname'] = strtoupper(($allusers[$key]['nom'] . ' ' . substr($allusers[$key]['prenom'], 0, 1) . '.'));
            if($value['id'] != $current['id']){
                foreach ($conversation as $cvalue) {
                    if($cvalue['sender'] == $value['id'] || $cvalue['receiver']  == $value['id']){
                        $allusers[$key]['lastmessage'] = $this->getSomeText($cvalue['message']);
                        $allusers[$key]['lasttime'] = $this->getDayLabel($cvalue['created_at']);
                        $allusers[$key]['status'] = $cvalue['status'];
                    }
                } 
                $allusers[$key]['different'] = true;
            }else{
                $allusers[$key]['different'] = false;
            }

            if($value['user_type'] == "Enseignant(e)"){
                 $allusers[$key]['profile'] = base_url('backend/assets/img/teacher.png');
            }else{
                 $allusers[$key]['profile'] = base_url('backend/assets/img/student.png');
            }

            if(!isset($allusers[$key]['lastmessage'])){
                $allusers[$key]['lastmessage'] = "Aucune conversation";
                $allusers[$key]['lasttime'] = "";
            }
        }

        return $allusers;
    }

    function saveConversation() {
        $receiver = $this->input->post('receiver');
        $message = $this->input->post('message');
        if(!empty($receiver) && !empty($message)){
           $current = $this->customlib->getUserData();
            $data = array(
                'sender' => $current['id'],
                'receiver' => $receiver,
                'message' => $message
            );

            if ($this->staff_model->addMessage($data)) {
                $array = array('status' => 'success');  
            } else {
                $array = array('status' => 'fail');   
            }
        }else{
           $array = array('status' => 'empty fields => {receiver = ' . $receiver .'&& message = '. $message .'}');   
        }
        echo json_encode($array);
    }

    function updateConversation() {
        $receiver = $this->input->post('receiver');
        $message = $this->input->post('message');
        $current = $this->customlib->getUserData();

        if(empty($receiver)){
            $user_type = json_decode($this->customlib->getStaffRole())->name;
            $conversation = $this->separateDateAndTime($this->staff_model->getConversation($current['id']), true);
            $allusers = $this->setLastMessage($this->staff_model->getAll(), $conversation, $current);
            $array = array('status' => 'success', 'conversations' => $conversation, 'allusers' => $allusers, 'current' => $current['id'], 'user_type' => $user_type, 'base_url' => base_url());  
        }
        echo json_encode($array);
    }

    function separateDateAndTime ($conversations, $in_chat = false){
        foreach ($conversations as $key => $value) {
            $conversations[$key]['date'] = $this->getDayLabel($conversations[$key]['created_at'], $in_chat);
            $conversations[$key]['time'] = substr($conversations[$key]['created_at'], 11, 5);
        }
        return $conversations;
    }   

    function getDayLabel($date, $inchat = false){
        $provided = date('Y-m-d', strtotime(substr($date, 0, 10)));
        $today = date('Y-m-d');
        $days_between = ceil(abs(strtotime($provided) - strtotime($today)) / 86400);
        $label = ($inchat)?"Ajourd'hui":'Auj.';
        if($days_between == 1){
            $label = 'Hier';
        }else if($days_between > 1 && $days_between < 8){
            $label = ($inchat)?'Cette semaine':'Cette sem.';
        }else if($days_between > 7 && $days_between < 31){
            $label = ($inchat)?'Semaine derniere':'Sem. der.';
        }else if($days_between > 30 && $days_between < 61){
            $label = ($inchat)?'Mois dernier':'Mois dern.';
        }else if($days_between > 60){
            $label = $provided;
        }
        return $label;
    }

    function getConversation() {
        $receiver = $this->input->get('receiver');
        $conversation = $this->staff_model->getConversation($receiver, $this->customlib->getUserData()['id']);
        echo json_encode($conversation);
    }

    function adduser(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        
        $data['title'] = "AJOUTER UTILISATEUR";
        $data['page'] = 'form';
        $data['date'] = 'date';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;

        $marital_status = $this->marital_status;
        $data["marital_status"] = $marital_status;
        $roles = $this->staff_model->getRole();
        $data["roles"] = $roles;

        $data['departement'] = $this->staff_model->getDepartement();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/adduser', $data);
        $this->load->view('layout/footer', $data);
    }

     // EDIT USER
    function updateprofile($id){
        $userdata = $this->customlib->getUserData();
        if($userdata['id'] != $id){
            redirect('profile/' . $userdata['id']);
        }
        $this->edituser($id, true);
    }

    function edituser($id, $updateprofile = false){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        
        $data['title'] = "MODIFIER UTILISATEUR";
        $data['page'] = 'form';
        $data['date'] = 'date';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;

        $marital_status = $this->marital_status;
        $data["marital_status"] = $marital_status;
        $roles = $this->staff_model->getRole();
        $data["roles"] = $roles;

        $data['departement'] = $this->staff_model->getDepartement();
        $data['user'] = $this->staff_model->getProfile($id);
        if($data['user'] == null){redirect('allusers');}

        $data['updateprofile'] = $updateprofile;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/edituser', $data);
        $this->load->view('layout/footer', $data);
    }

    function listevaluation(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        $userdata = $this->customlib->getUserData();

        $data['title'] = "LISTE D'EVALUATION";
        $data['page'] = 'form';
        $data['addlist'] = 'list';
        $data['table'] = 'style';

        $data['ressources'] = $this->staff_model->getAllRessources(null, null, $userdata['id']);

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/listevaluation');
        $this->load->view('layout/footer');
    }
    
    function getCoursesAndEvaluationWithStudent() {
        $id_course = $this->input->get('id_course');
        $result = $this->staff_model->getResultEvaluate($id_course);

        foreach ($result as $key => $value) {
            $totalPoint = 0; 
            foreach ($this->decodeJson($value['resultat']) as $qv) {
                foreach ($qv as $tmpv) {
                    $qqv = $this->decodeJson($tmpv);
                    $totalPoint += intval($qqv['notes']);
                }
            }  
            $result[$key]['resultat'] = intval($totalPoint);
        }

        echo json_encode($result);
    }

    function countAttendance($st_month, $no_of_months, $emp) {

        $record = array();
        for ($i = 1; $i <= 1; $i++) {

            $r = array();
            $month = date('m', strtotime($st_month . " -$i month"));
            $year = date('Y', strtotime($st_month . " -$i month"));

            foreach ($this->staff_attendance as $att_key => $att_value) {

                $s = $this->staff_model->count_attendance($year, $emp, $att_value);

                $r[$att_key] = $s;
            }

            $record[$year] = $r;
        }

        return $record;
    }


    public function getSessionMonthDropdown() {
        $startMonth = $this->setting_model->getStartMonth();
        $array = array();
        for ($m = $startMonth; $m <= $startMonth + 11; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$month] = $month;
        }
        return $array;
    }

    public function download($staff_id, $doc) {
        $this->load->helper('download');
        $filepath = "./uploads/staff_documents/$staff_id/" . $this->uri->segment(5);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(5);

        force_download($name, $data);
    }



    public function username_check($str){
        if(empty($str)){
            $this->form_validation->set_message('username_check', 'Le champ d\'identification du personnel est obligatoire');
            return false;
        }else{
            $result = $this->staff_model->valid_employee_id($str);
            if($result == false){
                return false;
            }
            return true ;
        }
    }


    function delete($id) {
        if (!$this->rbac->hasPrivilege('staff', 'can_delete')) {
            access_denied();
        }

            $a = 0 ;
            $sessionData = $this->session->userdata('admin');
            $userdata = $this->customlib->getUserData();
            $staff = $this->staff_model->get($id);
             if($staff["role_id"] == 7){
                $a = 0;
                if($userdata["email"] == $staff["email"]){
                    $a = 1;    
                }
            }else{
                $a = 1 ;
            }
        
        if($a != 1){
            access_denied();
        }
        $data['title'] = 'Staff List';
        $this->staff_model->remove($id);
        redirect('admin/staff');
    }

    function disablestaff($id) {
        $this->staff_model->disablestaff($id);
        redirect('allusers');
    }

    function enablestaff($id) {
        $this->staff_model->enablestaff($id);
        redirect('allusers');
    }

     function editfunction($id) {

        $result = $this->staff_model->list_function($id);
        $data["result"] = $result;
        $data["title"] = "MODIFIER FONCTION";
        $resultdata = $this->staff_model->list_function();
        $data["listfunction"] = $resultdata;
        $this->load->view("layout/header");
        $this->load->view("admin/staff/add_function", $data);
        $this->load->view("layout/footer");
    }

    function deletefunction($id) {

        $this->staff_model->deletefunction($id);
        redirect('admin/staff/addfunction');
    }

    // 

    function getEmployeeByRole() {
        $role = $this->input->post("role");
        $data = $this->staff_model->getEmployee($role);
        echo json_encode($data);
    }

    function dateDifference($date_1, $date_2, $differenceFormat = '%a') {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat) + 1;
    }


    function change_password(){
        $userdata = $this->customlib->getUserData();
        $id = $this->input->post('id');

        $this->form_validation->set_rules('current_pass', 'Mot de passe actuel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new_pass', 'Nouveau mot de passe', 'trim|required|xss_clean|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirmation mot de passe', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'current_pass' => form_error('current_pass'),
                'new_pass' => form_error('new_pass'),
                'confirm_pass' => form_error('confirm_pass'),    
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');      
        }else{
            if(!empty($id)){
                $current_pass = $this->input->post('current_pass');
                if($this->enc_lib->passHashDyc($current_pass, $userdata['password'])){
                    $newdata = array(
                        'id' => $id,
                        'password' => $this->enc_lib->passHashEnc($this->input->post('new_pass'))
                    );
                    
                    if ($this->admin_model->saveNewPass($newdata)) {
                        $array = array('status' => 'success', 'error' => '', 'message' => "Le mot de passe a été changé avec succès");  
                    } else {
                        $array = array('status' => 'fail', 'error' => '', 'message' => "Mot de passe non modifié");   
                    }
                }else{
                    $array = array('status' => 'fail', 'error' => '', 'message' => "Mot de passe actuel incorrect");
                }
            }else{
                $array = array('status' => 'fail', 'error' => '', 'message' => "Mot de passe non modifié" );
            }   
        } 
        echo json_encode($array);   
    }
}?>