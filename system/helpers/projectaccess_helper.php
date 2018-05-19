<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('isAdminLogin'))    
{    
    function isAdminLogin()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata(ADMIN_SESS_CODE.'adminid');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
           redirect(base_url().'admin');
        }
    }
}