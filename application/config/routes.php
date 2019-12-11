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
$route['default_controller'] = 'OrderProcess';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* custom routes starts */
$route['login']						= 'signin/index';
$route['logout']					= 'signin/logout';
$route['deleteAllDBCache'] = 'welcome/deleteAllDBCache';

$route['branch-master'] 		= 'branch/index';
$route['branch-pageLoad'] 		= 'branch/pageLoad';
$route['branch-add'] 			= 'branch/add';
$route['branch-edit/(:any)'] 	= 'branch/add/edit/$1';
$route['branch-save'] 			= 'branch/save';
$route['branch-delete/(:any)'] 	= 'branch/deleteBranch/$1';

$route['department-master'] 		= 'department/index';
$route['department-add'] 			= 'department/add';
$route['department-edit/(:any)'] 	= 'department/add/edit/$1';
$route['department-save'] 			= 'department/save';
$route['department-delete/(:any)'] 	= 'department/deleteDepartment/$1';

$route['customer-master'] 			= 'customer/index';
$route['customer-add'] 				= 'customer/add';
$route['customer-edit/(:any)'] 		= 'customer/add/edit/$1';
$route['customer-save'] 			= 'customer/save';
$route['customer-delete/(:any)'] 	= 'customer/deleteCustomer/$1';


$route['product-master'] 			= 'product/index';
$route['product-add'] 				= 'product/add';
$route['product-edit/(:any)'] 		= 'product/add/edit/$1';
$route['getPrdFields'] 				= 'product/getPrdFields';
$route['product-save'] 				= 'product/save';
$route['product-delete/(:any)'] 	= 'product/deleteProduct/$1';


$route['user-master'] 			= 'user/index';
$route['user-add'] 				= 'user/add';
$route['user-edit/(:any)'] 		= 'user/add/edit/$1';
$route['user-save'] 			= 'user/save';
$route['user-delete/(:any)'] 	= 'user/deleteUser/$1';

/*task*/
$route['task-list'] = 'TaskProcess';
$route['task-details/(:any)'] = 'TaskProcess/TaskDetails/$1';
$route['user-task-list'] = 'TaskProcess/UserTaskList';
$route['task-start/(:any)'] = 'TaskProcess/UserTaskStart/$1';

/*Production*/
$route['production-list'] = 'TaskProcess/ProductionList';

/*OrderCalendar*/
$route['calendar'] = 'CalendarProcess/TaskCalendar';

/*Holiday*/
$route['holiday'] = 'CalendarProcess/index';

//susmitha
/*order list */
$route['OrderDetails'] = 'OrderProcess/orderlist';
$route['order-new'] = 'OrderProcess';
$route['modify-order/(:any)'] = 'OrderProcess/index/$1';
$route['delete-order/(:any)'] = 'OrderProcess/deleteorder/$1';
/*order list */
/*sale list */
$route['sales-details'] = 'Sales';
$route['order-sales-details'] = 'Sales/ordersales';
$route['sales-new'] = 'Sales/salesnew';
$route['order-newsales/(:any)'] = 'Sales/ordersalesnew/$1';
$route['sales-print/(:any)'] = 'Sales/salesprint/$1';
/*sale list */