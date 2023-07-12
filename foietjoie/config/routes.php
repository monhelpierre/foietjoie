<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'site/login';
$route['login'] = 'site/login';
$route['user/resetpassword/([a-z]+)/(:any)'] = 'site/resetpassword/$1/$2';
$route['admin/resetpassword/(:any)'] = 'site/admin_resetpassword/$1';
$route['tableau-de-bord'] = 'admin/admin/dashboard';

// end
$route['enregistre_etudiant'] = 'student/create';
$route['admin/unauthorized'] = 'admin/admin/unauthorized';
$route['parent/unauthorized'] = 'parent/parents/unauthorized';
$route['student/unauthorized'] = 'user/user/unauthorized';
$route['teacher/unauthorized'] = 'teacher/teacher/unauthorized';
$route['accountant/unauthorized'] = 'accountant/accountant/unauthorized';
$route['librarian/unauthorized'] = 'librarian/librarian/unauthorized';

// TRUE ROUTES FOR PROJECT
$route['profile/(:any)'] = 'admin/staff/profile/$1';
$route['enablestaff/(:any)'] = 'admin/staff/enablestaff/$1';
$route['disablestaff/(:any)'] = 'admin/staff/disablestaff/$1';
$route['allusers'] = 'admin/staff/listusers';
$route['updateConversation'] = 'admin/staff/updateConversation';
$route['saveConversation'] = 'admin/staff/saveConversation';
$route['evaluation'] = 'admin/staff/evaluation';
$route['editevaluation/(:any)'] = 'admin/staff/editevaluation/$1';
$route['voirevaluation/(:any)'] = 'admin/staff/voirevaluation/$1';
$route['blockedusers'] = 'admin/staff/blockedusers';
$route['adduser'] = 'admin/staff/adduser';
$route['edituser/(:any)'] = 'admin/staff/edituser/$1';
$route['listevaluation'] = 'admin/staff/listevaluation';
$route['updateprofile/(:any)'] = 'admin/staff/updateprofile/$1';
$route['listcourses'] = 'homework/listcourses';
$route['viewcourse/(:any)'] = 'homework/viewcourse/$1';
$route['evaluatecourse/(:any)'] = 'homework/evaluatecourse/$1';
$route['addEvaluation'] = 'homework/addEvaluation';
$route['addcourse'] = 'homework/addcourse';
$route['responseevaluate/(:any)'] = 'homework/responseevaluate/$1';
$route['listcoursesgrile'] = 'homework/listcoursesgrile';
$route['userlog'] = 'admin/userlog/index';
$route['sendmessage'] = 'admin/staff/sendmessage';
$route['evaluateaftercourse/(:any)'] = 'homework/evaluateaftercourse/$1';

//$route['404_override'] = '';
$route['404_override'] = 'school/show_404';
$route['translate_uri_dashes'] = FALSE;
//======= front url rewriting==========
// $route['page/(:any)'] = 'welcome/page/$1';
// $route['read/(:any)'] = 'welcome/read/$1';
// $route['frontend'] = 'welcome';


