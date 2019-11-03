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


$route['API'] = 'Rest_server';

// User API Routes

$route['Periode']['get'] = 'Periode/getPeriode';
$route['Periode']['post'] = 'Periode/insertPeriode';
$route['Periode']['delete'] = 'Periode/deletePeriode';
$route['Periode']['put'] = 'Periode/updatePeriode';
$route['Soal']['get'] = 'Soal/getSoal';
$route['Soal']['post'] = 'Soal/insertSoal';
$route['Soal']['delete'] = 'Soal/deleteSoal';
$route['Soal']['put'] = 'Soal/updateSoal';
$route['Role']['get'] = 'Role/getRole';
$route['Role']['post'] = 'Role/insertRole';
$route['Role']['delete'] = 'Role/deleteRole';
$route['Role']['put'] = 'Role/updateRole';
$route['User']['get'] = 'User/getUser';
$route['User']['post'] = 'User/insertUser';
$route['User']['delete'] = 'User/deleteUser';
$route['User']['put'] = 'User/updateUser';
$route['Petugas']['get'] = 'Petugas/getPetugas';
$route['Petugas']['post'] = 'Petugas/insertPetugas';
$route['Petugas']['delete'] = 'Petugas/deletePetugas';
$route['Petugas']['put'] = 'Petugas/updatePetugas';
$route['Jawaban']['get'] = 'Jawaban/getJawaban';
$route['Jawaban']['post'] = 'Jawaban/insertJawaban';
$route['Jawaban']['delete'] = 'Jawaban/deleteJawaban';
$route['Jawaban']['put'] = 'Jawaban/updateJawaban';
$route['Mahasiswa']['get'] = 'Mahasiswa/getMahasiswa';
$route['Mahasiswa']['post'] = 'Mahasiswa/insertMahasiswa';
$route['Mahasiswa']['delete'] = 'Mahasiswa/deleteMahasiswa';
$route['Mahasiswa']['put'] = 'Mahasiswa/updateMahasiswa';
$route['UserInRule']['get'] = 'UserInRule/getUserInRule';
$route['UserInRule']['post'] = 'UserInRule/insertUserInRule';
$route['UserInRule']['delete'] = 'UserInRule/deleteUserInRule';
$route['UserInRule']['put'] = 'UserInRule/updateUserInRule';
