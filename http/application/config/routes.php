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
$route['default_controller']                = 'site';
$route['([0-9a-f]{32})']                    = 'programs/viewProgram/$1';
$route['print/([0-9a-f]{32})']              = 'programs/printProgram/$1';

$route['login'] 			                = 'user/login';
$route['logout'] 			                = 'user/logout';
$route['recovery'] 			                = 'user/recovery';
$route['registration'] 		                = 'user/registration';
$route['registration/(:any)'] 		        = 'user/confirm/$1';
$route['profile'] 		                    = 'user/profile';
$route['profile/(:any)'] 		            = 'user/profileEdit/$1';

$route['feedback']                          = 'site/feedback';

$route['exercises']                             = 'exercises/index';
$route['exercises/add']                         = 'exercises/add';
$route['exercises/(:num)']                      = 'exercises/index/$1';
$route['exercises/([0-9a-f]{32})']              = 'exercises/edit/$1';
$route['exercises/delete/([0-9a-f]{32})']       = 'exercises/delete/$1';
$route['exercises/favorite/([0-9a-f]{32})']     = 'exercises/favorite/$1';

$route['programs']                              = 'programs/index';
$route['programs/add']                          = 'programs/add';
$route['programs/(:num)']                       = 'programs/index/$1';
$route['programs/([0-9a-f]{32})']               = 'programs/edit/$1';
$route['programs/delete/([0-9a-f]{32})']        = 'programs/delete/$1';
$route['programs/favorite/([0-9a-f]{32})']      = 'programs/favorite/$1';
$route['programs/mail/([0-9a-f]{32})']          = 'programs/programToMail/$1';

$route['admin']                                 = 'admin/dashboard/index';

$route['admin/exercises']                             = 'admin/exercises/index';
$route['admin/exercises/add']                         = 'admin/exercises/add';
$route['admin/exercises/(:num)']                      = 'admin/exercises/index/$1';
$route['admin/exercises/([0-9a-f]{32})']              = 'admin/exercises/edit/$1';
$route['admin/exercises/delete/([0-9a-f]{32})']       = 'admin/exercises/delete/$1';
$route['admin/exercises/order/([0-9a-f]{32})']        = 'admin/exercises/changeOrder/$1';
$route['admin/exercises/users']                       = 'admin/exercises/users';
$route['admin/exercises/users/(:num)']                = 'admin/exercises/users/$1';

$route['admin/programs']                              = 'admin/programs/index';
$route['admin/programs/add']                          = 'admin/programs/add';
$route['admin/programs/(:num)']                       = 'admin/programs/index/$1';
$route['admin/programs/([0-9a-f]{32})']               = 'admin/programs/edit/$1';
$route['admin/programs/delete/([0-9a-f]{32})']        = 'admin/programs/delete/$1';
$route['admin/programs/order/([0-9a-f]{32})']         = 'admin/programs/changeOrder/$1';
$route['admin/programs/users']                        = 'admin/programs/users';
$route['admin/programs/users/(:num)']                 = 'admin/programs/users/$1';

$route['admin/users']                             = 'admin/users/index';
$route['admin/users/(:num)']                      = 'admin/users/index/$1';
$route['admin/users/([0-9a-f]{32})']              = 'admin/users/detail/$1';

$route['admin/settings']                          = 'admin/settings/index';

$route['admin/seo']                               = 'admin/seo/index';
$route['admin/seo/(:num)']                        = 'admin/seo/index/$1';
$route['admin/seo/add']                           = 'admin/seo/add';
$route['admin/seo/([0-9a-f]{32})']                = 'admin/seo/edit/$1';
$route['admin/seo/delete/([0-9a-f]{32})']         = 'admin/seo/delete/$1';

$route['404_override']                      = 'site/error';
$route['translate_uri_dashes']              = FALSE;