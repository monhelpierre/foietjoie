<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customlib {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('user_agent');
        // $this->CI->load->model('Notification_model', '', TRUE);
        $this->CI->load->model('Setting_model', '', TRUE);
        // $this->CI->load->model('Notificationsetting_model', '', TRUE);
    }

    function getCSRF() {
        $csrf_input = "<input type='hidden' ";
        $csrf_input .= "name='" . $this->CI->security->get_csrf_token_name() . "'";
        $csrf_input .= " value='" . $this->CI->security->get_csrf_hash() . "'/>";

        return $csrf_input;
    }

    function contentAvailabelFor() {
        $content_for = array();
        $role_array = $this->getStaffRole();
        $role = json_decode($role_array);
        $content_for[$role->name] = "All " . $role->name;
        $content_for['student'] = 'Etudiant';
        return $content_for;
    }

    function getCalltype() {
        $call_type = array();
        $call_type['Incoming'] = 'Incoming';
        $call_type['Outgoing'] = 'Outgoing';
        return $call_type;
    }

    function getGender() {
        $gender = array();
        $gender['Masculin'] = 'Masculin';
        $gender['Feminin'] = 'Féminin';
        return $gender;
    }

    function getStatus() {
        $status = array();
        $status[""] = $this->CI->lang->line('select');
        $status['enabled'] = 'Enabled';
        $status['disabled'] = 'Disabled';
        return $status;
    }

    function getDateFormat() {
        $dateFormat = array();
        $dateFormat['d-m-Y'] = 'dd-mm-yyyy';
        $dateFormat['d-M-Y'] = 'dd-mmm-yyyy';
        $dateFormat['d/m/Y'] = 'dd/mm/yyyy';
        $dateFormat['d.m.Y'] = 'dd.mm.yyyy';
        $dateFormat['m-d-Y'] = 'mm-dd-yyyy';
        $dateFormat['m/d/Y'] = 'mm/dd/yyyy';
        $dateFormat['m.d.Y'] = 'mm.dd.yyyy';
        return $dateFormat;
    }

    
    function getRteStatus() {
        $status = array();
        $status['Yes'] = $this->CI->lang->line('yes');
        $status['No'] = $this->CI->lang->line('no');
        return $status;
    }

    function getHostaltype() {
        $status = array();
        $status['Girls'] = 'Girls';
        $status['Boys'] = 'Boys';
        $status['Combine'] = 'Combine';
        return $status;
    }

    function getDaysname() {
        $status = array();
        $status['Monday'] = 'Monday';
        $status['Tuesday'] = 'Tuesday';
        $status['Wednesday'] = 'Wednesday';
        $status['Thursday'] = 'Thursday';
        $status['Friday'] = 'Friday';
        $status['Saturday'] = 'Saturday';
        $status['Sunday'] = 'Sunday';
        return $status;
    }

    function getcontenttype() {
        $status = array();
        $status['Assignments'] = 'Document Cours';
        $status['Study_material'] = 'Document devoir';
        $status['Syllabus'] = 'Syllabus';
        $status['Other_download'] = 'Autres Document';
        return $status;
    }

    function getPageContentCategory() {
        $category = array();
        $category['standard'] = 'Standard';
        $category['events'] = 'Events';
        $category['notice'] = 'Notice';
        $category['gallery'] = 'Gallery';
        return $category;
    }

    // function getTimeZone() {
    //     $admin = $this->CI->session->userdata('admin');
    //     if ($admin) {
    //         return $admin['timezone'];
    //     } else if ($this->CI->session->userdata('student')) {
    //         $student = $this->CI->session->userdata('student');
    //         return $student['timezone'];
    //     }
    // }

    function getSchoolCurrencyFormat() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['currency_symbol'];
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student['currency_symbol'];
        }
    }

    function getLoggedInUserData() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin;
        } else if ($this->CI->session->userdata('student')) {
            $student = $this->CI->session->userdata('student');
            return $student;
        }
    }


    function getStudentSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentID = $session_Array['student_id'];
        return $studentID;
    }

    function getParentSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $Parentid = $session_Array['student_id'];
        return $Parentid;
    }

    function getTeacherSessionUserID() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $teacher_id = $session_Array['teacher_id'];
        return $teacher_id;
    }

    function getUsersID() { // users table id of users
        $session_Array = $this->CI->session->userdata('student');
        $user_id = $session_Array['id'];
        return $user_id;
    }

    function getStaffID() { // users table id of users
        $session_Array = $this->CI->session->userdata('admin');
        $staff_id = $session_Array['id'];
        return $staff_id;
    }

    function getSessionLanguage() {
        $student_session = $this->CI->session->userdata('admin');
        $language = $student_session['language'];
        $lang_id = $language['lang_id'];
        return $lang_id;
    }

    // function checkPaypalDisplay() {
    //     $payment_setting = $this->CI->paymentsetting_model->get();
    //     return $payment_setting;
    // }

    function getStudentunreadNotification() {
        $student_id = $this->CI->customlib->getStudentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadNotificationStudent($student_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return FALSE;
        }
    }

    function getParentunreadNotification() {
        $teacher_id = $this->CI->customlib->getParentSessionUserID();
        $notifications = $this->CI->notification_model->countUnreadNotificationParent($teacher_id);
        if ($notifications > 0) {
            return $notifications;
        } else {
            return FALSE;
        }
    }

    function getStudentSessionUserName() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['username'];
        return $studentUsername;
    }

    function getAdminSessionUserName() {
        $student_session = $this->CI->session->userdata('admin');
        $username = $student_session['username'];

        return $username;
    }

    function getStudentSessionGardianname() {
        $student_session = $this->CI->session->all_userdata();
        $session_Array = $this->CI->session->userdata('student');
        $studentUsername = $session_Array['guardian_name'];
        return $studentUsername;
    }

    function getUserRole() {
        $user = $this->CI->session->userdata('student');
        return $user['role'];
    }

    function getMonthDropdown() {
        $array = array();
        for ($m = 1; $m <= 12; $m++) {
            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
            $array[$month] = $month;
        }
        return $array;
    }

    function getMonthList() {
        $months = array(1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Decembre');
        return $months;
    }

    function getAppName() {
        $admin = $this->CI->session->userdata('admin');
        if ($admin) {
            return $admin['sch_name'];
        } 
    }

    function getStaffRole() {
        $admin = $this->CI->session->userdata('admin');
        $roles = $admin['roles'];
        if ($admin) {
            $role_key = key($roles);
            return json_encode(array('id' => $roles[$role_key], 'name' => $role_key));
        }
    }

    function getSchoolName() {
        $admin = $this->CI->Setting_model->getSetting();
        return $admin->name;
    }

    function getAppVersion() {
        $appVersion = "1.0.0";
        return $appVersion;
    }

    function datetostrtotime($date) {
        $format = 'Y-m-d';
        // $this->getSchoolDateFormat();

        if ($format == 'd-m-Y')
            list($day, $month, $year) = explode('-', $date);
        if ($format == 'd/m/Y')
            list($day, $month, $year) = explode('/', $date);
        if ($format == 'd-M-Y')
            list($day, $month, $year) = explode('-', $date);
        if ($format == 'd.m.Y')
            list($day, $month, $year) = explode('.', $date);
        if ($format == 'm-d-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm/d/Y')
            list($month, $day, $year) = explode('/', $date);
        if ($format == 'm.d.Y')
            list($month, $day, $year) = explode('.', $date);
        $date = $year . "-" . $month . "-" . $day;
        return strtotime($date);
    }

    function dateyyyymmddTodateformat($date) {

        $format = 'Y-m-d';
        // $this->getSchoolDateFormat();

        if ($format == 'd-m-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd/m/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd-M-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd.m.Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm-d-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm/d/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm.d.Y')
            list($month, $day, $year) = explode('-', $date);
        $date = $year . "-" . $day . "-" . $month;


        return strtotime($date);
    }

    function dateFront() {
        $admin = $this->CI->Setting_model->getSetting();
        return $admin->date_format;
    }

    function dateyyyymmddTodateformatFront($date) {
        $format = $this->dateFront();

        if ($format == 'd-m-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd/m/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd-M-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'd.m.Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm-d-Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm/d/Y')
            list($month, $day, $year) = explode('-', $date);
        if ($format == 'm.d.Y')
            list($month, $day, $year) = explode('-', $date);
        $date = $year . "-" . $day . "-" . $month;


        return strtotime($date);
    }

    function timezone_list() {
        static $timezones = null;

        if ($timezones === null) {
            $timezones = [];
            $offsets = [];
            $now = new DateTime('now', new DateTimeZone('UTC'));

            foreach (DateTimeZone::listIdentifiers() as $timezone) {

                $now->setTimezone(new DateTimeZone($timezone));
                $offsets[] = $offset = $now->getOffset();
                $timezones[$timezone] = '(' . $this->format_GMT_offset($offset) . ') ' . $this->format_timezone_name($timezone);
            }

            array_multisort($offsets, $timezones);
        }
        return $timezones;
    }

    function format_GMT_offset($offset) {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    public function format_timezone_name($name) {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }

    function getMailMethod() {
        $mail_method = array();
        $mail_method['sendmail'] = 'SendMail';
        $mail_method['smtp'] = 'SMTP';
        return $mail_method;
    }

    function getNotificationModes() {
        $notification = array();
        $notification['student_admission'] = $this->CI->lang->line('student_admission');
        $notification['exam_result'] = $this->CI->lang->line('exam_result');
        $notification['fee_submission'] = $this->CI->lang->line('fees_submission');
        $notification['absent_attendence'] = $this->CI->lang->line('absent_student');
        $notification['login_credential'] = $this->CI->lang->line('login_credential');
        return $notification;
    }

    function sendMailSMS($find) {

        $notifications = $this->CI->notificationsetting_model->get();


        if (!empty($notifications)) {
            foreach ($notifications as $note_key => $note_value) {
                if ($note_value->type == $find) {
                    return array('mail' => $note_value->is_mail, 'sms' => $note_value->is_sms, 'notification' => $note_value->is_notification);
                }
            }
        }
        return false;
    }

    public function setUserLog($username, $role) {
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser() . ' ' . $this->CI->agent->version();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile();
        } else {
            $agent = 'Agent utilisateur non identifié';
        }

        $data = array(
            'user' => $username,
            'role' => $role,
            'ipaddress' => $this->CI->input->ip_address(),
            'user_agent' => $agent . ", " . $this->CI->agent->platform(),
        );
        $this->CI->userlog_model->add($data);
    }

    function mediaType() {
        $media_type = array();
        $media_type['image/jpeg'] = "Image";
        $media_type['video'] = "Video";
        $media_type['text/plain'] = "Texte";
        $media_type['application/zip'] = "Zip";
        $media_type['application/x-rar'] = "Rar";
        $media_type['application/pdf'] = "Pdf";
        $media_type['application/msword'] = "Word";
        $media_type['application/vnd.ms-excel'] = "Excel";
        $media_type['other'] = "Other";
        return $media_type;
    }

    function getFormString($str, $start, $end) {

        $string = false;
        $pattern = sprintf(
                '/%s(.+?)%s/ims', preg_quote($start, '/'), preg_quote($end, '/')
        );

        if (preg_match($pattern, $str, $matches)) {
            list(, $match) = $matches;
            $string = trim($match);
        }
        return $string;
    }

    function uniqueFileName($prefix = "", $name = "") {
        if (!empty($_FILES)) {
            $newFileName = uniqid($prefix, true) . '.' . strtolower(pathinfo($name, PATHINFO_EXTENSION));
            return $newFileName;
        }
        return false;
    }

    function getUserData() {
        $result = $this->getLoggedInUserData();
        $id = $result["id"];
        $data = $this->CI->staff_model->getProfile($id);
        $setting_result = $this->CI->setting_model->get();
        if (!empty($setting_result)) {
            $data["class_teacher"] = array_key_exists("class_teacher", $setting_result[0]) ? $setting_result[0]["class_teacher"] : null;
        } else {
            $data["class_teacher"] = "yes";
        }
        return $data;
    }

    function countincompleteTask($id) {

        $result = $this->CI->calendar_model->countincompleteTask($id);
        return $result;
    }

    function getincompleteTask($id) {

        $result = $this->CI->calendar_model->getincompleteTask($id);
        return $result;
    }

    function getClassbyteacher($id) {

        $getUserassignclass = $this->CI->classteacher_model->getclassbyuser($id);
        $classteacherlist = $getUserassignclass;
        $class = array();
        foreach ($classteacherlist as $key => $value) {
            $class[] = $value["id"];
        }

        if (!empty($class)) {

            $getSubjectassignclass = $this->CI->classteacher_model->classbysubjectteacher($id, $class);
            $subjectteacherlist = $getSubjectassignclass;

            $classlist = array_merge($classteacherlist, $subjectteacherlist);

            $i = 0;
            foreach ($classlist as $key => $value) {

                $data[$i]["id"] = $value["id"];
                $data[$i]["class"] = $value["class"];


                $i++;
            }
        } else {
            $getSubjectassignclass = $this->CI->classteacher_model->getsubjectbyteacher($id);



            $data = $getSubjectassignclass;
        }

        return $data;
    }

    public function getclassteacher($id) {

        $getUserassignclass = $this->CI->classteacher_model->getclassbyuser($id);
        $classteacherlist = $getUserassignclass;

        return $classteacherlist;
    }

    public function getteachersubjects($id) {

        $getUserassignclass = $this->CI->classteacher_model->getsubjectbyteacher($id);
        $classteacherlist = $getUserassignclass;

        return $classteacherlist;
    }
    public function getLimitChar($string,$str_length=50) {

       $string = strip_tags($string);
if (strlen($string) > $str_length) {

    // truncate string
    $stringCut = substr($string, 0, $str_length);
    $endPoint = strrpos($stringCut, ' ');

    //if the string doesn't contain any space then it will cut without word basis.
    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '...';
}
return $string;
    }

}


