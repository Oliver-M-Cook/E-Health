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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* 
Routes for controllers
*/

$route['signup'] = 'Signup';
$route['login'] = 'Login';
$route['dashboard'] = 'Dashboard';
$route['questionaire'] = 'Completequest';
$route['update_questionaire'] = 'Updatequest';
$route['view_questionaire'] = 'Viewquest';

/* 
Routes for the questionaire functions
*/

$route['questionaire/medical'] = 'Completequest/loadMedPage';
$route['questionaire/sendMedData'] = 'Completequest/sendMedData';

$route['questionaire/smoking'] = 'Completequest/loadSmokePage';
$route['questionaire/sendSmokeData'] = 'Completequest/sendSmokeData';

$route['questionaire/alcohol'] = 'Completequest/loadAlcPage';
$route['questionaire/sendAlcoholData'] = 'Completequest/sendAlcoholData';

$route['questionaire/medical_history'] = 'Completequest/loadMedHistPage';
$route['questionaire/sendMedicalHistoryData'] = 'Completequest/sendMedicalHistoryData';

$route['questionaire/allergies'] = 'Completequest/loadAllergiesPage';
$route['questionaire/sendAllergyData'] = 'Completequest/sendAllergyData';

$route['questionaire/lifestyle'] = 'Completequest/loadLifestylePage';
$route['questionaire/sendLifestyleData'] = 'Completequest/sendLifestyleData';

$route['questionaire/storeDatabase'] = 'Completequest/storeDatabase';

/* 
Routes for updating the questionaire
*/

$route['update_questionaire/sendUserData'] = 'Updatequest/sendUserData';

$route['update_questionaire/medical'] = 'Updatequest/loadMedPage';
$route['update_questionaire/sendMedication'] = 'Updatequest/sendMedication';

$route['update_questionaire/smoking'] = 'Updatequest/loadSmokePage';
$route['update_questionaire/sendSmoking'] = 'Updatequest/sendSmoking';

$route['update_questionaire/alcohol'] = 'Updatequest/loadAlcPage';
$route['update_questionaire/sendAlcohol'] = 'Updatequest/sendAlcohol';

$route['update_questionaire/medical_history'] = 'Updatequest/loadMedHistPage';
$route['update_questionaire/sendMedicalHistory'] = 'Updatequest/sendMedicalHistory';

$route['update_questionaire/allergies'] = 'Updatequest/loadAllergyPage';
$route['update_questionaire/sendAllergy'] = 'Updatequest/sendAllergy';

$route['update_questionaire/lifestyle'] = 'Updatequest/loadLifestylePage';
$route['update_questionaire/sendLifestyle'] = 'Updatequest/sendLifestyle';

/* 
Routes for viewing questionaire as an admin
*/

$route['view_questionaire/changeStatus'] = 'Viewquest/changeStatus';
?>