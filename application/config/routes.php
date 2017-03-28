<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
 */


//Iphone api endpoints
$route['api/v1/mobile/login']['POST'] = "Iphone_api/login";
$route['api/v1/mobile/logout']['DELETE'] = "Iphone_api/logout";
$route['api/v1/mobile/flyerlist']['POST'] = "Iphone_api/flyerList";
$route['api/v1/mobile/flyerinfo']['POST'] = "Iphone_api/getFlyerDetail";
$route['api/v1/mobile/clientinfo']['POST'] = "Iphone_api/getClientSalesInfo";
$route['api/v1/mobile/stats']['POST'] = "Iphone_api/stats";
$route['api/v1/mobile/flyerProcess']['POST'] = "Iphone_api/orderProcess";
// $route['api/v1/mobile/is_logged_in'] = "Iphone_api/is_logged_in";

// frontend website ordering endpoints for pricing
$route['api/save_order'] = 'newdesign/save_order';
$route['api/clear_order_selection'] = 'newdesign/clear_order_selection';
$route['api/clear_order'] = 'newdesign/clear_order_selection';

/// admin routes

$route['admin'] = "error404";
$route['_backoffice'] = "admin/admin/index";
$route['admin/index'] = "admin/admin/index";
$route['admin/login'] = "error404";
$route['_backoffice/login'] = "admin/login/index";
$route['admin/logout'] = "admin/login/logout";
$route['_backoffice/logout'] = "admin/login/logout";
$route['logout'] = "admin/login/logout";
$route['email'] = "Email_database";
$route['search'] = "admin/search/detailSearch";
$route['state/:any'] = 'Email_database/county_state_wise';
$route['county/:any'] = 'Email_database/county_wise';
$route['email/bulk_email'] = 'Email_database/test_send_bulk';

/// admin pages

$route['admin/managepages'] = "admin/page/index";
$route['admin/managepages/(:any)'] = "admin/page/$1";
$route['admin/managepages/(:any)/(:any)'] = "admin/page/$1/$2";
$route['admin/managepages/(:any)/(:any)/(:any)'] = "admin/page/$1/$2/$3";

/// admin services

$route['admin/manageservices'] = "admin/manageservices/index";
$route['admin/manageservices/(:any)'] = "admin/manageservices/$1";
$route['admin/manageservices/(:any)/(:any)/(:any)'] = "admin/manageservices/$1/$2/$3";

/// admin Clients

$route['admin/manageclients'] = "admin/admin_clients/index";
$route['admin/manageclients/(:any)'] = "admin/admin_clients/$1";
$route['admin/manageclients/(:any)/(:any)/(:any)'] = "admin/admin_clients/$1/$2/$3";

//admin csv
$route['admin/csv'] = "admin/csv/index";

/// admin Flyers

$route['admin/manageflyers'] = "admin/manageflyers/index";
$route['admin/manageflyers/(:any)'] = "admin/manageflyers/$1";
$route['admin/manageflyers/(:any)/(:any)/(:any)'] = "admin/manageflyers/$1/$2/$3";
$route['flyer_size'] = 'Flyer_Size';
$route['flyer_size/(:any)'] = 'Flyer_Size/$1';
$route['flyer_size/(:any)/(:any)'] = 'Flyer_Size/$1/$2';

//admin flyer ajax requests

$route['admin/ajax/templates/(:any)'] = "admin/ajax/templates/$1";
$route['admin/ajax/templates'] = "admin/ajax/templates/";
$route['admin/ajax/fonts'] = "admin/ajax/getfonts/";
$route['admin/ajax/colorset/(:any)'] = "admin/ajax/getFlyerColorSet/$1";
$route['admin/ajax/colorset'] = "admin/ajax/getFlyerColorSet/";
$route['admin/ajax/objects'] = "admin/ajax/getObjectsList";

$route['admin/ajax/(:any)'] = "admin/ajax/index";
$route['admin/settings'] = 'admin_designer_settings/index';
$route['flyers_management'] = 'admin_flyers/flyers_management';
$route['user_flyers'] = 'admin_flyers/user_flyers';
$route['user_flyers/read/(:any)'] = 'admin_flyers/user_flyer_read/$1';
$route['user_flyers/delete/(:any)'] = 'admin_flyers/user_flyer_delete/$1';
$route['account_closed'] = 'admin/admin/account_closed';
$route['flyer_status/(:any)']='admin_flyers/flyer_status/$1';

//admin activity and login routes
$route['admin_activity/(:num)'] = 'admin_activity/get_all_by_admin/$1';
$route['users_activity/(:num)'] = 'users_activity/get_all_by_user/$1';
$route['admin_login_history/(:num)'] = 'admin_login_history/get_all_by_admin/$1';
$route['users_login_history/(:num)'] = 'users_login_history/get_all_by_user/$1';

$route['user_activity'] = 'users_activity';
$route['user_login_history'] = 'users_login_history';
$route['user_login_history/(:any)'] = 'users_login_history/$1';
//Admin reports managment
$route['reports/orders'] = 'admin/managereports/orders';
$route['reports'] = 'admin/managereports';
$route['reports/table_orders'] = 'admin/managereports/table_orders';
$route['reports/table_emails'] = 'admin/managereports/table_emails';
$route['reports/emails'] = 'admin/managereports/emails';
$route['bulk_emails'] = 'admin/Managereports/bulk_emails';
$route['resend']='Newdesign/resend_subscription/';
$route['updateemail/(:num)'] = 'admin/managereports/update_email_subscriber/$1';
$route['subscriber_read_email/(:num)'] = 'admin/managereports/subscriber_read/$1';
$route['email_unsubscribers'] = 'Admin_subscription/email_unsubscribers';

//admin permission
$route['emailmanagement'] = 'Email_databaseManagement/dashboard';

$route['permission'] = 'admin/managepermission/index';
//frontend routes
////////////////////////////////////////////////////////

// $route['index/(:any)'] = "frontend/index/$1";

/*
/////////////// IRRELEVANT ROUTES AT THIS STAGE, NEED TO REPLACE THEM
$route['users'] = "users/index";
$route['users/index'] = "users/index";
$route['users/login'] = "users/login/";*/

/*$route['login'] = "newdesign/login";
$route['register'] = "frontend/register";*/

$route['alpha'] = 'newdesign';

/// NEW THEME ROUTES/////////////////////////////////////////////

$route['subscribe'] = 'newdesign/subscribe';
$route['subscribe_action'] = 'newdesign/subscribe_action';

$route['cookie-policy'] = 'Pages/cookiepolicy';
$route['privace-policy'] = 'Pages/privaypolicy';
$route['privacy-policy'] = 'Pages/privaypolicy';
$route['disclaimer'] = 'Pages/disclaimer';
$route['terms'] = 'Pages/terms';
$route['sitemap'] = 'Pages/sitemap';

$route['account'] = 'newdesign/account_settings';
$route['change-password'] = 'newdesign/change_password';
$route['change_password'] = 'newdesign/change_password';

$route['updateaccount'] = 'newdesign/settings_action';
$route['updatepassword'] = 'newdesign/updatepassword';
$route['register'] = 'newdesign/register';
$route['register_action'] = 'newdesign/register_action';
$route['frontend/verification'] = 'newdesign/verification';
$route['subscribe/verification'] = 'newdesign/sub_verification';
$route['unsubscribe/verification'] = 'newdesign/unsub_verification';
$route['unsubscribe_me'] = 'newdesign/email_unsub';
$route['unsubscribe_me_response'] = 'newdesign/semail_unsub';
$route['login'] = 'newdesign/login';
$route['login_action'] = 'newdesign/login_action';
$route['logout'] = 'newdesign/logout';
$route['lostpass'] = 'newdesign/lost_password';
$route['lostpass_action'] = 'newdesign/lost_password_action';
$route['frontend/reset_password'] = 'newdesign/reset_password';
$route['repass_action'] = 'newdesign/reset_password_action';

$route['editor'] = 'editor';
$route['order'] = 'editor';
$route['start'] = 'editor';
$route['how-it-works'] = 'newdesign/how_it_works';
$route['pricing'] = 'newdesign/pricing';
$route['blog'] = 'newdesign/blog';
$route['aboutus'] = 'newdesign/aboutus';
$route['about-us'] = 'newdesign/aboutus';
$route['ordernow'] = 'newdesign/ordernow';
$route['faqs'] = 'newdesign/faqs';
$route['contact-us'] = 'newdesign/contactus';
$route['contactus_action'] = 'newdesign/contactus_action';
$route['info'] = 'newdesign/info';
$route['editor/get_flyer_properties'] = 'newdesign/get_flyer_properties';
$route['editor/get_flyer_properties/(:any)'] = 'newdesign/get_flyer_properties/$1';


$route['editor/get_flyer_colorsets'] = 'newdesign/get_flyer_colorsets';
$route['editor/get_flyer_colorsets/(:any)'] = 'newdesign/get_flyer_colorsets/$1';



/// NEW USERS ROUTES START ////////////////////////////////////////////////////
$route['my-orders'] = 'users_orders/index';
$route['email-settings'] = 'newdesign/email_settings';
$route['email_settings'] = 'newdesign/email_settings';
$route['email-settings/confirm/(:any)/(:any)/(:any)'] = 'newdesign/email_settings_confirm/$1/$2/$3';
$route['email-settings/confirm-password'] = 'newdesign/confirm_password';
/// USERS ROUTES START END ////////////////////////////////////////////////////
$route['change-password'] = 'newdesign/change_password';
$route['change_password'] = 'newdesign/change_password';
$route['updatepassword'] = 'newdesign/updatepassword';




// new design routes
/*$route['newdesign/contactus'] = 'newdesign/contactus'
 */

// general routes {keep this section always at last}
/*$route['default_controller'] = "Frontend";*/

$route['default_controller'] = "comingsoon";
// $route['(:any)'] = "frontend/index"; 

/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['404_override'] = 'error404/index';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
