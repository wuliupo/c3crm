<?php 
include('ecversion.php');

// more than 8MB memory needed for graphics

// memory limit default value = 16M

ini_set('memory_limit','256M');

// show or hide world clock, calculator and FCKEditor

// world_clock_display default value = true
// calculator_display default value = true
// fckeditor_display default value = true

$WORLD_CLOCK_DISPLAY = 'true';
$CALCULATOR_DISPLAY = 'true';
$FCKEDITOR_DISPLAY = 'true';

//This is the URL for customer portal. (Ex. http://www.crmone.cn/portal)
$PORTAL_URL = 'http://yourdomain.com/customerportal';

//These two are the HelpDesk support email id and the support name. (Ex. 'support@crmone.cn' and 'crmone Support')
$HELPDESK_SUPPORT_EMAIL_ID = 'support@yourdomain.com';
$HELPDESK_SUPPORT_NAME = 'yourdomain Name';

/* Database configuration
      db_host_name:     MySQL Database Hostname
      db_user_name:        MySQL Username
      db_password:         MySQL Password
      db_name:             MySQL Database Name
*/
$dbconfig['db_server'] =     'localhost';
$dbconfig['db_port'] =     ':3306';
$dbconfig['db_username'] =     'root';
$dbconfig['db_password'] =         '';
$dbconfig['db_name'] =             'c3crm';
$dbconfig['db_type'] = 'mysql';
$dbconfig['db_status'] = 'true';
// TODO: test if port is empty
// TODO: set db_hostname dependending on db_type
$dbconfig['db_hostname'] = $dbconfig['db_server'].$dbconfig['db_port'];

// log_sql default value = false
$dbconfig['log_sql'] = false;

// persistent default value = true
$dbconfigoption['persistent'] = true;

// autofree default value = false
$dbconfigoption['autofree'] = false;

// debug default value = 0
$dbconfigoption['debug'] = 0;

// seqname_format default value = '%s_seq'
$dbconfigoption['seqname_format'] = '%s_seq';

// portability default value = 0
$dbconfigoption['portability'] = 0;

// ssl default value = false
$dbconfigoption['ssl'] = false;

$host_name = $dbconfig['db_hostname'];

$site_URL ='http://localhost/c3crm';

// root directory path
$root_directory = __DIR__.'/';

// cache direcory path
$cache_dir = 'cache/';

// tmp_dir default value prepended by cache_dir = images/
$tmp_dir = 'cache/images/';

// import_dir default value prepended by cache_dir = import/
$tmp_dir = 'cache/import/';

// upload_dir default value prepended by cache_dir = upload/
$tmp_dir = 'cache/upload/';

// mail server parameters
$mail_server = '';
$mail_server_username = '';
$mail_server_password = '';

// maximum file size for uploaded files in bytes also used when uploading import files
// upload_maxsize default value = 3000000
$upload_maxsize = 3000000;

// flag to allow export functionality
// 'all' to allow anyone to use exports 
// 'admin' to only allow admins to export
// 'none' to block exports completely
// allow_exports default value = all
$allow_exports = 'all';

// Files with one of these extensions will have '.txt' appended to their filename on upload
// upload_badext default value = php, php3, php4, php5, pl, cgi, py, asp, cfm, js, vbs, html, htm
$upload_badext = array('php', 'php3', 'php4', 'php5', 'pl', 'cgi', 'py', 'asp', 'cfm', 'js', 'vbs', 'html', 'htm');

// This is the full path to the include directory including the trailing slash
// includeDirectory default value = /home/wwwroot/itstar.net/crm/..'include/
$includeDirectory = $root_directory.'include/';

// list_max_entries_per_page default value = 20
$list_max_entries_per_page = '20';

// change this number to whatever you want. This is the number of pages that will appear in the pagination. by Raju 
$limitpage_navigation = '9';

// history_max_viewed default value = 5
$history_max_viewed = '5';

// Map Sugar language codes to jscalendar language codes
// Unimplemented until jscalendar language files are fixed
// $cal_codes = array('en_us'=>'en', 'ja'=>'jp', 'sp_ve'=>'sp', 'it_it'=>'it', 'tw_zh'=>'zh', 'pt_br'=>'pt', 'se'=>'sv', 'cn_zh'=>'zh', 'ge_ge'=>'de', 'ge_ch'=>'de', 'fr'=>'fr');

//set default module and action
$default_module = 'Home';
$default_action = 'index';

//set default theme
$default_theme = 'bluelagoon';

// If true, the time to compose each page is placed in the browser.
$calculate_response_time = true;
// Default Username - The default text that is placed initially in the login form for user name.
$default_user_name = '';
// Default Password - The default text that is placed initially in the login form for password.
$default_password = '';
// Create default user - If true, a user with the default username and password is created.
$create_default_user = false;
$default_user_is_admin = false;
// disable persistent connections - If your MySQL/PHP configuration does not support persistent connections set this to true to avoid a large performance slowdown
$disable_persistent_connections = false;
// Defined languages available.  The key must be the language file prefix.  E.g. 'en_us' is the prefix for every 'en_us.lang.php' file. 
$languages = Array('zh_cn'=>'Simplized Chinese',);
// Master currency name
$currency_name = '';
// Default charset if the language specific character set is not found.
$default_charset = 'UTF-8';
// Default language in case all or part of the user's language pack is not available.
$default_language = 'zh_cn';
// Translation String Prefix - This will add the language pack name to every translation string in the display.
$translation_string_prefix = false;
//Option to cache tabs permissions for speed.
$cache_tab_perms = true;

//Option to hide empty home blocks if no entries.
$display_empty_home_blocks = false;

//true for hosting server , false for dedicated servers or virtual private server
//2 for zend3.3.0 , 1 or true for hosting server(real_server_ip) ,false for dedicated servers or virtual private server
$ecustomer_hosting_type = '2';
//current_user or all_to_me
$default_viewscope = "current_user";
$default_activity_view = "day";
$display_latest_notes = true;
$default_use_internalmailer = 1;//1 -> use webmail to send mail ; 0 use out mailer(such outlook) to send mail 3 use saemail
$is_disable_approve = false;
$default_reminder_interval = 1;
$is_disable_pm = false;
$monday_first = 1;
$default_number_digits = 2;
$default_number_grouping_seperator = ",";
$default_number_decimal_seperator = ".";
$default_timezone = "Asia/Shanghai";
if(isset($default_timezone) && function_exists('date_default_timezone_set')) {
	@date_default_timezone_set($default_timezone);
}
?>