<?php

class Homework extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("staff_model");
    }

// Start code for project SAQ

    function listcourses(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        $data['title'] = "LISTE COURS";
        $data['page'] = 'list';
        $data['table'] = 'style';

        $allressources = $this->staff_model->getAllRessources();
        $data["allressources"] = $allressources;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/listcourse', $data);
        $this->load->view('layout/footer', $data);
    }



    function addcourse(){
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        $data['title'] = "AJOUTER COURS";
        $data['page'] = 'form';
        $data['file'] = 'file';

        $allressources = $this->staff_model->getAllRessources();
        $data["allressources"] = $allressources;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/add_ressource', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addcourseajax()
    {
        $this->form_validation->set_rules('titre_cours', 'Titre cours', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file_upload', 'Choisir un fichier video', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Choisir un fichier video', 'callback_handle_upload');
        $this->form_validation->set_rules('description', 'Description cours', 'trim|required|xss_clean');
       
        if ($this->form_validation->run() == false) {
            $data = array(
                'titre_cours' => form_error('titre_cours'),
                'file' => form_error('file'),
                'description' => form_error('description')
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        }else{

            $data = array(
                'titre_cours' => $this->input->post('titre_cours'),
                'type_file' => 'Video',
                'description' => $this->input->post('description'),
                'user_add' => $this->session->userdata('admin')['id']
            );
            $id = $this->staff_model->addcourse($data);

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id.'.'.$fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/ressources/video/" . $img_name);
                $data_img = array('id' => $id, 'file' => 'uploads/ressources/video/'.$img_name);
                $this->staff_model->addcourse($data_img);
            }
            $array = array('status' => 'success', 'message' => 'Le cours a été enregistré avec succès.');
            echo json_encode($array);
        }
    }

        function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('avi', 'flv', 'wmv', 'mov', 'mp4' ,'ogm');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            /*if ($_FILES["file"]["type"] != 'image/mp4' &&
                    $_FILES["file"]["type"] != 'image/avi' &&
                    $_FILES["file"]["type"] != 'image/ogm') {
                $this->form_validation->set_message('handle_upload', 'Type de fichier non autorisé');
                return false;
            }*/
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension non autorisée');
                return false;
            }
            if ($_FILES["file"]["size"] > 102400000) {
                $this->form_validation->set_message('handle_upload', 'La taille du fichier doit être inférieure à 100 Ko.');
                return false;
            }
            return true;
        } else {
            $this->form_validation->set_message('handle_upload', 'Le fichier est requis');
            return false;
        }
    }

    // delete course
    function deletecourse()
    {
        $this->load->helper("file");
        $id = $this->input->get('id');
        $file = $this->staff_model->getAllRessources($id);
        $data = $this->staff_model->delete($id,'ressources');
        unlink('./'.$file['file']);
        $array = array('status' => 'success', 'message' => 'Le cours a été bien supprimé.','data' => $file['file']);
        echo json_encode($array);
    }


    // view course
    function viewcourse($id){
         if(!is_numeric($id)){
            redirect('listcoursesgrile');
        }
        // if (json_decode($this->customlib->getStaffRole())->name === 'Enseignant(e)'){redirect('listcoursesgrile');}
        $sr = $this->staff_model->getAllRessources($id);
        if($sr['is_public'] != 'yes'){
            redirect('profile/'.$this->session->userdata('admin')['id']);
        }
        $data['id'] = $id;
        $data['title'] = "COURS AVEC DESCRIPTION ET EVALUATION";
        $data['page'] = 'viewcourse';
        $data['videojs'] = 'videojs';
        $data["sr"] = $sr;
        $data['result'] = $this->staff_model->getResultEvaluate($id, $this->session->userdata('admin')['id']);

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/viewcourse', $data);
        $this->load->view('layout/footer', $data);
    }


       // view course

    function evaluatecourse($id){
        if(!is_numeric($id)){redirect('listcourses');}
        if (json_decode($this->customlib->getStaffRole())->name !== 'Enseignant(e)'){redirect('listcoursesgrile');}
        
        $sr = $this->staff_model->getAllRessources($id);
        if($sr['is_public'] == 'yes'){
            redirect('listcourses');
        }
        $data["sr"] = $sr;
        $data['id'] = $id;
        $data['title'] = "ENREGISTRER EVALUATION";
        $data['page'] = 'form';

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/evaluatecourse', $data);
        $this->load->view('layout/footer', $data);

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
                'form' => json_encode($questionsAndAnswers),
                'id_course' => $id,
                'user_add' => $this->session->userdata('admin')['id']
            );
            
            $this->staff_model->addEvaluate($data);
            $this->staff_model->addcourse(array('id'=>$id,'is_public'=>'yes'));
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Enregistrement mis à jour avec succès</div>');
            redirect('evaluatecourse/'.$id);
            
        }
    }

    // TRAITEMENT FORM EVALUATION COURS APPRENANT
    function responseevaluate(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $eval_id = $this->input->post('eval_id');
            $id_course = $this->input->post('id_course');
            $evaluation = $this->staff_model->getEvaluationByCourse($id_course);
            $pointTotal = 100;

            foreach ($evaluation as $key => $value) {
                $allQuestions = json_decode($value['form'], 'questions');
                $totalQ = sizeof($allQuestions);
                $pointParQuestion = $pointTotal/$totalQ;
                $single = array();

                foreach ($allQuestions as $qk => $qv) {
                    $singleQuestion = json_decode($qv['questions']);
                    $answers = $singleQuestion->answers;
                    $noteObtenue = 0;
                    
                    $ans = array();
                    $rep = $this->input->post('rep_'. $qk);
                   
                    foreach ($answers as $ak => $av) {
                        if(!empty($av)){
                            $ans[$ak] = $av;
                        }
                    }
                
                    $nbGiven = sizeof($rep);
                    $nbAwai = sizeof($ans);

                    $noteParChoix = 0;

                    if($nbAwai > $nbGiven || $nbAwai == $nbGiven){
                        $noteParChoix = $pointParQuestion/$nbAwai;
                    }else{
                        $noteParChoix = $pointParQuestion/$nbGiven;
                    }  

                    foreach ($rep as $rk => $rv) {
                        if(in_array($rv, $ans)){
                            $noteObtenue += $noteParChoix;
                        }
                    }

                    $single[$qk] = json_encode(array('titre' => $singleQuestion->titre, 'originale' => $ans, 'fournie' => $rep, 'notes' => $noteObtenue));
                }
                $result[$key] = $single;
            }

            $data = array(
                'resultat' => json_encode($result),
                'id_evaluate' => $eval_id,
                'id_course' => $id_course,
                'id_user' => $this->session->userdata('admin')['id']
            );

            $req = $this->staff_model->addResultEvaluate($data);
            $array = array('status' => 'success', 'message' => 'Vos resultats ont été soumise ave succès');
            echo json_encode($array);
        }else{
            redirect('listcourses');
        }
    }


    // function addEvaluation()
    // {
    //     if ($this->input->server('REQUEST_METHOD') == "POST") {
    //         $loop = $this->input->post('i');
    //         $ar = array();
    //         var_dump($loop);
    //         $i_user = $this->input->post('id');
    //         foreach ($loop as $key => $value) {
    //             $are = array();
    //             // var_dump($value);
    //             $label = $this->input->post('label_'.$value);
    //             $question = $this->input->post('question_'.$value);
    //             $response = $this->input->post('response_'.$value);
    //             $form = json_encode(array('label'=>$label,'question'=>$question,'response'=>$response));
    //         }   
    //     }
    // }

     // view course
    function evaluateaftercourse($id){
        if(!is_numeric($id)){
            redirect('listcourses');
        }
        if (json_decode($this->customlib->getStaffRole())->name == 'Enseignant(e)'){redirect('listcoursesgrile');}
        
        $data['id'] = $id;
        $data['title'] = "EVALUATION VOTRE COMPETENCE APRES AVOIR SUIVI CE COURS";

        if($this->staff_model->getResultEvaluate($id, $this->session->userdata('admin')['id'])){redirect('listcoursesgrile');}

        $sr = $this->staff_model->getAllRessources($id);
        $data["sr"] = $sr;

        $eval = $this->staff_model->getEvaluate($id);
        $data['eval'] = $eval;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/evaluationcours', $data);
        $this->load->view('layout/footer', $data);
    }

    public function decodeJson($txt, $field = null){
        $var = json_decode($txt, TRUE);

        if($field != null){
            return $var[$field]; 
        }
        return $var;  
    }

    function listcoursesgrile()
    {
        $data['title'] = "LISTE COURS";
        $allressources = $this->staff_model->getAllRessources(null,'yes');
        $data["allressources"] = $allressources;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/staff/listcourseusers', $data);
        $this->load->view('layout/footer', $data);
    }


































    // my codes for Project SAQ

    public function index() {
        if (!$this->rbac->hasPrivilege('homework', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Homework');
        $this->session->set_userdata('sub_menu', 'homework');
        $data["title"] = "Créer des devoirs";

        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['subject_id'] = "";
        $homeworklist = $this->homework_model->get();

        $this->form_validation->set_rules('class_id', 'Discipline', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            
        } else {

            $class_id = $this->input->post("class_id");
            $section_id = $this->input->post("section_id");
            $subject_id = $this->input->post("subject_id");
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['subject_id'] = $subject_id;
            $homeworklist = $this->homework_model->search_homework($class_id, $section_id, $subject_id);
        }
        $data["homeworklist"] = $homeworklist;
        foreach ($data["homeworklist"] as $key => $value) {
            $report = $this->homework_model->getEvaluationReport($value["id"]);

            $data["homeworklist"][$key]["report"] = $report;
            $create_data = $this->staff_model->get($value["created_by"]);
            $eval_data = $this->staff_model->get($value["evaluated_by"]);
            $created_by = $create_data["name"] . " " . $create_data["surname"];
            $evaluated_by = $eval_data["name"] . " " . $create_data["surname"];
            $data["homeworklist"][$key]["created_by"] = $created_by;
            $data["homeworklist"][$key]["evaluated_by"] = $evaluated_by;
        }

        $this->load->view("layout/header", $data);
        $this->load->view("homework/homeworklist", $data);
        $this->load->view("layout/footer", $data);
    }

    public function create() {
        if (!$this->rbac->hasPrivilege('homework', 'can_add')) {
            access_denied();
        }
        $data["title"] = "Créer des devoirs";

        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
        $this->form_validation->set_rules('class_id', 'Discipline', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Niveau', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Matière', 'trim|required|xss_clean');
        $this->form_validation->set_rules('homework_date', 'Date devoir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {

            $msg = array(
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
                'subject_id' => form_error('subject_id'),
                'homework_date' => form_error('homework_date'),
                'description' => form_error('description'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {




            $data = array('class_id' => $this->input->post("class_id"),
                'section_id' => $this->input->post("section_id"),
                'subject_id' => $this->input->post("subject_id"),
                'homework_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('homework_date'))),
                'submit_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('submit_date'))),
                'staff_id' => $userdata["id"],
                'subject_id' => $this->input->post("subject_id"),
                'description' => $this->input->post("description"),
                'create_date' => date("Y-m-d"),
                'created_by' => $userdata["id"],
                'evaluated_by' => ''
            );



            $id = $this->homework_model->add($data);

            if (isset($_FILES["userfile"]) && !empty($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/homework/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);

                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploaddir . $img_name);
            } else {

                $document = "";
            }

            $upload_data = array('id' => $id, 'document' => $document);
            $this->homework_model->add($upload_data);
            $msg = "Homework Created Successfully";
            $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        }

        echo json_encode($array);
    }

    public function getRecord($id) {
        if (!$this->rbac->hasPrivilege('homework', 'can_edit')) {
            access_denied();
        }
        $result = $this->homework_model->get($id);
        $data["result"] = $result;

        echo json_encode($result);
    }

    public function edit() {

        if (!$this->rbac->hasPrivilege('homework', 'can_edit')) {
            access_denied();
        }
        $id = $this->input->post("homeworkid");
        $data["title"] = "Modifier les devoirs";

        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $result = $this->homework_model->get($id);
        $data["result"] = $result;
        $data['class_id'] = $result["class_id"];
        $data['section_id'] = $result["section_id"];
        $data['subject_id'] = $result["subject_id"];
        $data["id"] = $id;
        $userdata = $this->customlib->getUserData();
        $this->form_validation->set_rules('class_id', 'Discipline', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Niveau', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Matière', 'trim|required|xss_clean');
        $this->form_validation->set_rules('homework_date', 'Date devoir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'class_id' => form_error('class_id'),
                'section_id' => form_error('section_id'),
                'subject_id' => form_error('subject_id'),
                'homework_date' => form_error('homework_date'),
                'description' => form_error('description'),
            );
            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            if (isset($_FILES["userfile"]) && !empty($_FILES['userfile']['name'])) {
                $uploaddir = './uploads/homework/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["userfile"]["name"]);
                $document = basename($_FILES['userfile']['name']);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $uploaddir . $img_name);
            } else {

                $document = $this->input->post("document");
            }
            $data = array('id' => $id,
                'class_id' => $this->input->post("class_id"),
                'section_id' => $this->input->post("section_id"),
                'subject_id' => $this->input->post("subject_id"),
                'homework_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('homework_date'))),
                'submit_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('submit_date'))),
                'staff_id' => $userdata["id"],
                'subject_id' => $this->input->post("subject_id"),
                'description' => $this->input->post("description"),
                'create_date' => date("Y-m-d"),
                'document' => $document
            );

            $this->homework_model->add($data);
            $msg = "Devoir mis à jour avec succès...";
            $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        }

        echo json_encode($array);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('homework', 'can_delete')) {
            access_denied();
        }
        if (!empty($id)) {

            $this->homework_model->delete($id);
            redirect("homework");
        }
    }

    public function download($id, $doc) {
        $this->load->helper('download');
        $name = $this->uri->segment(4);
        $ext = explode(".", $name);
        $filepath = "./uploads/homework/" . $id . "." . $ext[1];
        $data = file_get_contents($filepath);
        force_download($name, $data);
    }

    public function evaluation($id) {
        if (!$this->rbac->hasPrivilege('homework_evaluation', 'can_view')) {
            access_denied();
        }
        $data["title"] = "Homework Evaluation";
        $data["created_by"] = "";
        $data["evaluated_by"] = "";

        $result = $this->homework_model->getRecord($id);
        $class_id = $result["class_id"];
        $section_id = $result["section_id"];
        $studentlist = $this->homework_model->getStudents($class_id, $section_id);
        $data["studentlist"] = $studentlist;
        $data["result"] = $result;
        $report = $this->homework_model->getEvaluationReport($id);
        $data["report"] = $report;

        if (!empty($result)) {

            $create_data = $this->staff_model->get($result["created_by"]);
            $eval_data = $this->staff_model->get($result["evaluated_by"]);
            $created_by = $create_data["name"] . " " . $create_data["surname"];
            $evaluated_by = $eval_data["name"] . " " . $create_data["surname"];
            $data["created_by"] = $created_by;
            $data["evaluated_by"] = $evaluated_by;
        }


        $this->load->view("homework/evaluation_modal", $data);
    }

    public function add_evaluation() {
        if (!$this->rbac->hasPrivilege('homework_evaluation', 'can_add')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $this->form_validation->set_rules('evaluation_date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('evaluation_student_list[]', 'Etudiants', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'evaluation_date' => form_error('evaluation_date'),
                'evaluation_student_list[]' => form_error('evaluation_student_list[]'),
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
        } else {

            $students = $this->input->post("evaluation_student_list");

            $prev_students = $this->input->post("evalid");
            if (!empty($prev_students)) {
                $this->homework_model->delete_evaluation($prev_students);
            }

            foreach ($students as $key => $value) {

                $data = array('homework_id' => $this->input->post("homework_id"),
                    'student_id' => $value,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('evaluation_date'))),
                    'status' => 'Complete'
                );

                $this->homework_model->addEvaluation($data);
            }

            $homework_data = array('id' => $this->input->post("homework_id"), 'evaluated_by' => $userdata["id"]);

            $this->homework_model->add($homework_data);
            $msg = "Évaluation des devoirs terminée avec succès.";
            $array = array('status' => 'success', 'error' => '', 'message' => $msg);
        }
        echo json_encode($array);
    }

    public function evaluation_report() {
        if (!$this->rbac->hasPrivilege('homework_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Homework');
        $this->session->set_userdata('sub_menu', 'homework/evaluation_report');
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['subject_id'] = "";

        $result = $this->homework_model->searchHomeworkEvaluation($class_id = '', $section_id = '', $subject_id = '');
        $data["resultlist"] = $result;

        $this->form_validation->set_rules('class_id', 'Discipline', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            
        } else {

            $class_id = $this->input->post("class_id");
            $section_id = $this->input->post("section_id");
            $subject_id = $this->input->post("subject_id");

            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['subject_id'] = $subject_id;

            $result = $this->homework_model->searchHomeworkEvaluation($class_id, $section_id, $subject_id);
            $data["resultlist"] = $result;
            $data["title"] = "Evaluation Report";
        }
        foreach ($result as $key => $value) {

            $report[] = $this->count_percentage($value["id"], $value["class_id"], $value["section_id"]);
            $data["resultlist"][$key]["report"] = $report;
        }


        $this->load->view("layout/header");
        $this->load->view("homework/homework_evaluation", $data);
        $this->load->view("layout/footer");
    }

    function getreport($id = 1) {

        $result = $this->homework_model->getEvaluationReport($id);
        if (!empty($result)) {
            $data["result"] = $result;
            $class_id = $result[0]["class_id"];
            $section_id = $result[0]["section_id"];
            $create_data = $this->staff_model->get($result[0]["created_by"]);
            $eval_data = $this->staff_model->get($result[0]["evaluated_by"]);
            $created_by = $create_data["name"] . " " . $create_data["surname"];
            $evaluated_by = $eval_data["name"] . " " . $eval_data["surname"];
            $data["created_by"] = $created_by;
            $data["evaluated_by"] = $evaluated_by;
            $studentlist = $this->homework_model->getStudents($class_id, $section_id);
            $data["studentlist"] = $studentlist;
            $this->load->view("homework/evaluation_report", $data);
        } else {
            echo "<div class='row'><div class='col-md-12'><br/><div class='alert alert-info'>Aucun Enregistrement Trouvé</div></div></div>";
        }
    }

    function count_percentage($id, $class_id, $section_id) {

        $count_students = $this->homework_model->count_students($class_id, $section_id);
        $count_evalstudents = $this->homework_model->count_evalstudents($id, $class_id, $section_id);
        $total_students = $count_students;
        $total_evalstudents = $count_evalstudents;
        $count_percentage = ($total_evalstudents / $total_students) * 100;
        $data["total"] = $total_students;
        $data["completed"] = $total_evalstudents;
        $data["percentage"] = round($count_percentage, 2);
        return $data;
    }

    public function getClass() {

        $class = $this->class_model->get();

        echo json_encode($class);
    }

}

?>