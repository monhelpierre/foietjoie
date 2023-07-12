<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends Public_Controller {

    public function __construct() {
        parent::__construct();
    
        $this->load->model("staff_model");
        $this->load->library('Enc_lib');
    }


    function login() {

        if ($this->auth->logged_in()) {
            $this->auth->is_logged_in(true);
        }

        $data = array();
        $data['title'] = 'CONNEXION';
        $school = $this->setting_model->get();
        $data['school'] = $school[0];
        $this->form_validation->set_rules('username', 'E-mail', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login', $data);
        } else {
            $login_post = array(
                'email' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $setting_result = $this->setting_model->get();
            $result = $this->staff_model->checkLogin($login_post);
           
            if ($result) {
                if($result->is_active == 'yes'){
                         $setting_result = $this->setting_model->get();
                    $session_data = array(
                        'id' => $result->id,
                        'nom' => $result->nom,
                        'prenom' => $result->prenom,
                        'email' => $result->email,
                        'roles' => $result->roles,
                        'date_format' => $setting_result[0]['date_format'],
                        'school_name' => $setting_result[0]['name'],
                        'sch_name' => $setting_result[0]['name']
                    );
                    
                    $this->session->set_userdata('admin', $session_data);
                    $role = $this->customlib->getStaffRole();
                    $role_name = json_decode($role)->name;
                    $this->customlib->setUserLog($this->input->post('username'), $role_name);

                    if (isset($_SESSION['redirect_to']))
                        redirect($_SESSION['redirect_to']);
                    else
                        redirect(base_url());
                }else{
                     $data['error_message'] = 'Votre compte est désactivé s\'il vous plaît contacter à l\'administrateur';
                      $this->load->view('admin/login', $data);
                }   
            } else {
                $data['error_message'] = 'Nom d\'utilisateur ou mot de passe invalide';
                $this->load->view('admin/login', $data);
            }
        }
    }

    function logout() {
        $admin_session = $this->session->userdata('admin');
        // $this->auth->logout();
        if ($admin_session) {
            $this->session->unset_userdata('admin');
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    //reset password - final step for forgotten password
    public function admin_resetpassword($verification_code = null) {
        if (!$verification_code) {
            show_404();
        }

        $user = $this->staff_model->getByVerificationCode($verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'Mot de passe', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirmation mot de passe', 'required|matches[password]');
            if ($this->form_validation->run() == false) {


                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('admin/admin_resetpassword', $data);
            } else {

                // finally change the password
                $password = $this->input->post('password');
                $update_record = array(
                    'id' => $user->id,
                    'password' => $this->enc_lib->passHashEnc($password),
                    'verification_code' => ""
                );

                $change = $this->staff_model->update($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Mot de passe réinitialisé avec succès!");
                    redirect('site/login', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Quelque choses ont été mal tournée");
                    redirect('admin_resetpassword/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Lien invalide');
            redirect("site/forgotpassword", 'refresh');
        }
    }

    //reset password - final step for forgotten password
    public function resetpassword($role = null, $verification_code = null) {
        if (!$role || !$verification_code) {
            show_404();
        }

        $user = $this->user_model->getUserByCodeUsertype($role, $verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
             $this->form_validation->set_rules('password', 'Mot de passe', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirmation mot de passe', 'required|matches[password]');
            if ($this->form_validation->run() == false) {

                $data['role'] = $role;
                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('resetpassword', $data);
            } else {

                // finally change the password

                $update_record = array(
                    'id' => $user->user_tbl_id,
                    'password' => $this->input->post('password'),
                    'verification_code' => ""
                );

                $change = $this->user_model->saveNewPass($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Mot de passe réinitialisé avec succès");
                    redirect('site/userlogin', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Quelque choses ont été mal tournées!");
                    redirect('user/resetpassword/' . $role . '/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Lien invalide');
            redirect("site/ufpassword", 'refresh');
        }
    }


}

?>