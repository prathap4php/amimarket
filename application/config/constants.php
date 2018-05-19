<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
/*
|--------------------------------------------------------------------------
| Project Path Codes
|--------------------------------------------------------------------------
 */
/****************************************************************************************************/
$url_details=$_SERVER['HTTP_HOST'];
$url_details.=str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);/*For Getting the project(Hosting Name)*/
$final_url='http://'.$url_details;
/*--------------------------------------------------------------------------
 *  Project Realted Constants defining here
 ----------------------------------------------------------------------------*/

/*
|--------------------------------------------------------------------------
| RESPONSE Codes(for Developer Purpose)
|--------------------------------------------------------------------------
 */

date_default_timezone_set('Asia/Kolkata');
define('DATE',date('Y-m-d H:i:s'));
define('QUERY_DEBUG',1);
define('QUERY_MESSAGE','query_show');
define('QUERY_DEBUG_MESSAGE','query_debug');
define('CODE','code');
define('MESSAGE','message');
define('DESCRIPTION','description');
define('INSERTED_ID','inserted_id');
define('DB_ERROR','dberror');
define('SUCCESS_CODE',200);
define('FAIL_CODE',204);
define('VALIDATION_CODE',301);
define('EXISTS_CODE',422);
define('INTERNAL_SERVER_ERROR_CODE',500);
define('DB_ERROR_CODE',575);

/*--------------------------------------------------------------------------
 *  Project Admin Realted Constants defining here
 ----------------------------------------------------------------------------*/

define('ADMIN_ASSETS',$final_url.'admin_assets/');
define('ADMIN_CSS_PATH',ADMIN_ASSETS.'css/');
define('ADMIN_JS_PATH',ADMIN_ASSETS.'js/');
define('ADMIN_PROJECT_PATH',ADMIN_ASSETS.'project/');
define('ADMIN_IMAGES_PATH',ADMIN_ASSETS.'img/');
define('ADMIN_LOGO_PATH',ADMIN_IMAGES_PATH.'prtm-logo.png');
define('ADMIN_PLUGIN_PATH',ADMIN_ASSETS.'plugins/');
define('ADMIN_LINK',$final_url.'superadmin/');
define('ADMIN_CSS_VIEW_PATH','admin/includes/css');
define('ADMIN_JS_VIEW_PATH','admin/includes/js');
define('ADMIN_HEADER_PATH','admin/includes/header');
define('ADMIN_FOOTER_PATH','admin/includes/footer');
define('ADMIN_SIDEBAR_PATH','admin/includes/sidebar');
// define('ADMIN_FAV',ADMIN_IMAGES_PATH.'favicon.png');
// define('ADMIN_LOGO',ADMIN_IMAGES_PATH.'logo-en.png');
define('ADMIN_PROJECT_JS',ADMIN_ASSETS.'project/superadmin/');


define('ADMIN_TITLE','Ami Market : SUPER-ADMIN');
define('ADMIN_META_TAGS','');
define('ADMIN_META_DESCRIPTION','');
define('ADMIN_META_KEYWORDS','');
define('ADMIN_META_ADMIN','');
define('ADMIN_META_AUTHOR','');
define('ADMIN_SESS_CODE','AMI_ADMIN');


define('PROJECT_NAME','Ami Market');