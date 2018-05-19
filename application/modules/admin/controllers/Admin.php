<?php defined('BASEPATH') or die('Something went wrong!');
class Admin extends CI_controller
{
    public function __construct(){
        parent::__construct();
        $this->data = [];
        $this->load->model(['AdminModel'=>'admin']);
        $this->adminid = $this->session->userdata(ADMIN_SESS_CODE.'adminid');
        $this->animation = 'animations/';
        $this->compition = 'compition/';
    }

    public function index()
    {
        if($this->adminid!=''){
            redirect(base_url().'admin/dashboard');
        }
        $this->data['url_title'] = PROJECT_NAME.' | Admin Login';
        $this->data['main_title'] = 'Admin Login';
        $setupArray=array(
            'form_id' => 'admin_login_form',
            'form_jspath' => ADMIN_PROJECT_PATH.'login.js',
            'action_link' => base_url().'admin/Admin/login',
        );
        $this->data['form_setup']=$setupArray;
        $this->load->view('login', $this->data);
    }
    public function login()
    {
        $response = [];
        $inputData = file_get_contents('php://input');
        if (isJson($inputData))
        {
            $req_data= json_decode($inputData);
            $error=0;
            $errorMsg ='';
            $email=strip_tags(trim($req_data->email));
            $password=strip_tags(trim($req_data->password));
            if($email==''){ $error=1; $errorMsg.='email is missing,';}
            else if(!email_check($email)){ $error=1;$errorMsg.='Invalid email,';}
            if($password==''){ $error=1;$errorMsg.='password is missing,'; }
            else if(!password_check($password)){ $error=1;$errorMsg.='Invalid password!,';}
            if($error==1)
            {
                $response[CODE]=VALIDATION_CODE;
                $response[MESSAGE]='Validation';
                $response[DESCRIPTION]=rtrim($errorMsg,',');
                
            }
            else
            {  
                $params = array(
                    'email'=>$email,
                    'password'=>$password,
                );
                $insert=$this->admin->login($params);
                echo $insert;exit;
            }
        }
        else
        {
           $response[CODE]=VALIDATION_CODE;
           $response[MESSAGE]='Validation';
           $response[DESCRIPTION]='Input data should be in JSON format onlys';
        }
        echo json_encode($response);
    }
    public function logout()
    {
        isAdminLogin();
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function dashboard()
    {
        isAdminLogin();
        $this->data['url_title'] = PROJECT_NAME.' | Admin Dashboard';
        $this->data['main_title'] = 'Dashboard';
        $this->load->view('dashboard', $this->data);
    }
    /*>>Animation types code start*/
    public function add_animation_type()
    {
        $this->data['url_title'] = PROJECT_NAME.' | Admin';
        $this->data['main_title'] = 'Add Animation Type';
        $breadcrumb_array = array(
            array('title' => 'Dashboard', 'link' => base_url('admin/dashboard'), 'class' => '', 'icon' => '<span class="glyphicon glyphicon-home
            "></span>'),
            array('title' => 'Add Animation Type', 'link' => 'javascript:void(0);', 'class' => 'active', 'icon' => ''),
            array('title' => 'List Animation Types', 'link' => base_url('admin/Admin/list_animation_types'),'class' => '', 'icon'=>''),
        );
        $setupArray=array(
            'form_id'=>'add_animation_type',
            'form_jspath'=>ADMIN_PROJECT_PATH.'animationType.js',
            'cancel_link'=>base_url('admin/Admin/list_animation_types'),
            'edit_link'=>base_url('admin/Admin/edit_animation_type'),
            'manage_link' => base_url('admin/Admin/list_animation_types'),
        );
        $this->data['form_setup']=$setupArray;
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->load->view($this->animation.'add_animation_type',$this->data);
    }
    public function insert_animation_type()
    {
        $response = [];
        $inputData = file_get_contents('php://input');
        if(isJson($inputData))
        {
            $req_data = json_decode($inputData);
            $error = 0;
            $errorMsg = '';
            $title = strip_tags(trim($req_data->title));
            $description = strip_tags(trim($req_data->description));
            if(empty($title)){$error=1;$errorMsg.='Enter Title!';}
            if(empty($description)){$error=1;$errorMsg.='Enter description!';}
            if($error==1){
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = rtrim($errorMsg,',');
            }
            else{
                $params = [
                    'title' => $title,
                    'description' => $description,
                ];
                $insert = $this->admin->insertAnimationType($params);
                echo $insert;exit;
            }
        }
        else{
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'Input data should be in json format only'; 
        }
        echo json_encode($response);
    }
    public function list_animation_types()
    {
        $this->data['url_title'] = PROJECT_NAME.' | Admin';
        $this->data['main_title'] = 'List Animation Types';
        $breadcrumb_array = [
            ['title'=>'Dashboard', 'link'=>base_url('admin/dashboard'),'class'=>'','icon'=>''],
            ['title'=>'Add Animation Type','link'=>base_url('admin/Admin/add_animation_type'),'class'=>'','icon'=>''],
            ['title'=>'List Animation Types','link'=>'javascript:void(0);','class'=>'active','icon'=>'']
        ];
        $setup_array = [
            'form_id' => 'list_animation_types',
            'form_jspath' => ADMIN_PROJECT_PATH.'animationType.js',
            'add_link' => base_url('admin/Admin/add_animation_type'),
        ];
        $this->data['form_setup'] = $setup_array;
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $search_title = strip_tags(trim($this->input->post('search_title')));
        /*>>pagination code start*/
        $config['base_url'] = base_url().'admin/Admin/list_animation_types/';
        $total_rows = $this->crud->commonRecordCount([
            'cols'=>'id','table_name'=>'animation_types'
        ]);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
        $config['num_links'] = $total_rows;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*<<pagination code end*/
        $this->data['total_records'] = $total_rows;
        $this->data['types_result'] = $this->admin->listAnimationTypes($params=[
            'limit'=>$config['per_page'],
            'start'=>$page,
            'search'=>$search_title,
        ]);
        $this->load->view($this->animation.'list_animation_types',$this->data);
    }
    public function edit_animation_type()
    {
        $animation_type_id = base64_decode($this->uri->segment(4));
        $this->data['url_title'] = PROJECT_NAME.' | Admin';
        $this->data['main_title'] = 'Edit Animation Type';
        $breadcrumb_array = array(
            array('title' => 'Dashboard', 'link' => base_url('admin/dashboard'), 'class' => '', 'icon' => '<span class="glyphicon glyphicon-home
            "></span>'),
            array('title' => 'Add Animation Type', 'link' => base_url('admin/Admin/add_amination_type'), 'class' => 'active', 'icon' => ''),
            array('title' => 'List Animation Types', 'link' => base_url('admin/Admin/list_animation_types'),'class' => '', 'icon'=>''),
            array('title' => 'Edit Animation Type', 'link' => 'javascript:void(0);', 'class' => 'active', 'icon' => ''),
        );
        $setupArray=array(
            'form_id'=>'edit_animation_type',
            'form_jspath'=>ADMIN_PROJECT_PATH.'animationType.js',
            'cancel_link'=>base_url('admin/Admin/list_animation_types'),
            'manage_link' => base_url('admin/Admin/list_animation_types'),
        );
        $this->data['form_setup']=$setupArray;
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->data['animation_result'] = $this->admin->getAnimationTypeData($params=[
            'animation_type_id' => $animation_type_id,
        ]);
        // print_r($this->data['animation_result']);exit;
        $this->load->view($this->animation.'edit_animation_type',$this->data);
    }
    public function update_animation_type()
    {
        $response = [];
        $inputData = file_get_contents('php://input');
        if(isJson($inputData))
        {
            $req_data = json_decode($inputData);
            // print_r($req_data);exit;
            $error = 0;
            $errorMsg = '';
            $title = strip_tags(trim($req_data->title));
            $description = strip_tags(trim($req_data->description));
            $type_id = base64_decode($req_data->type_id);
            if(empty($title)){$error=1;$errorMsg.='Enter Title!';}
            if($error==1){
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = rtrim($errorMsg,',');
            }
            else{
                $params = [
                    'title' => $title,
                    'description' => $description,
                    'id' => $type_id,
                ];
                $update = $this->admin->updateAnimationType($params);
                echo $update;exit;
            }
        }
        else{
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'Input data should be in json format only'; 
        }
        echo json_encode($response);
    }
    /*<<Animation types code end*/
    /*>>Compition  code start*/
    public function add_compition()
    {
        $this->data['url_title'] = PROJECT_NAME.' | Admin';
        $this->data['main_title'] = 'Add Compition';
        $breadcrumb_array = array(
            array('title' => 'Dashboard', 'link' => base_url('admin/dashboard'), 'class' => '', 'icon' => '<span class="glyphicon glyphicon-home
            "></span>'),
            array('title' => 'Add Compition', 'link' => 'javascript:void(0);', 'class' => 'active', 'icon' => ''),
            array('title' => 'List Compitions', 'link' => base_url('admin/Admin/list_compitions'),'class' => '', 'icon'=>''),
        );
        $setupArray=array(
            'form_id'=>'add_compition',
            'form_jspath'=>ADMIN_PROJECT_PATH.'compition.js',
            'cancel_link'=>base_url('admin/Admin/list_compitions'),
            'edit_link'=>base_url('admin/Admin/edit_compition'),
            'manage_link' => base_url('admin/Admin/list_compitions'),
        );
        $this->data['form_setup']=$setupArray;
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $this->data['animation_styles'] = $this->admin->getAnimationStyles();
        $this->load->view($this->compition.'add_compition',$this->data);
    }
    public function insert_compition()
    {
        $response = [];
        $inputData = file_get_contents('php://input');
        if(isJson($inputData)){
            $req_data = json_decode($inputData);
            $err = 0;
            $errMsg = '';
            $category = $req_data->category;
            $casting = strip_tags(trim($req_data->casting));
            $title = strip_tags(trim($req_data->title));
            $date = strip_tags(trim($req_data->datepicker));
            $start_time = strip_tags(trim($req_data->start_time));
            $end_time = strip_tags(trim($req_data->end_time));
            $description = strip_tags(trim($req_data->description));
            if(empty($category)){$err=1;$errMsg.='Category is empty,';}
            if(empty($casting)){$err=1;$errMsg.='Casting is empty,';}
            if(empty($title)){$err=1;$errMsg.='Title is empty,';}
            if(empty($date)){$err=1;$errMsg.='Date is empty,';}
            if(empty($start_time)){$err=1;$errMsg.='Start time is empty,';}
            if(empty($end_time)){$err=1;$errMsg.='End time is empty,';}
            if($err==1){
                $response[CODE] = VALIDATION_CODE;
                $response[MESSAGE] = 'Fail';
                $response[DESCRIPTION] = rtim($errMsg,',');
            }
            else{
                $params = [
                    'category' => $category,
                    'casting' => $casting,
                    'title' => $title,
                    'date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'description' => $description,
                ];
                // print_r($params);exit;
                $insert = $this->admin->insertCompition($params);
                echo $insert;exit;
            }
        }
        else{
            $response[CODE] = VALIDATION_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'Input data should be in json format only';
        }
        echo json_encode($response);
    }
    public function list_compitions()
    {
        $this->data['url_title'] = PROJECT_NAME.' | Admin';
        $this->data['main_title'] = 'List Compitions';
        $breadcrumb_array = [
            ['title'=>'Dashboard', 'link'=>base_url('admin/dashboard'),'class'=>'','icon'=>''],
            ['title'=>'Add Compition','link'=>base_url('admin/Admin/add_compition'),'class'=>'','icon'=>''],
            ['title'=>'List Compitions','link'=>'javascript:void(0);','class'=>'active','icon'=>'']
        ];
        $setup_array = [
            'form_id' => 'list_compitions',
            'form_jspath' => ADMIN_PROJECT_PATH.'compition.js',
            'add_link' => base_url('admin/Admin/add_compition'),
        ];
        $this->data['form_setup'] = $setup_array;
        $this->data['breadcrumb'] = json_encode($breadcrumb_array);
        $search_title = strip_tags(trim($this->input->post('search_title')));
        /*>>pagination code start*/
        $config['base_url'] = base_url().'admin/Admin/list_compitions/';
        $total_rows = $this->crud->commonRecordCount([
            'cols'=>'compition_id','table_name'=>'compitions'
        ]);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
        $config['num_links'] = $total_rows;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['links'] = $this->pagination->create_links();
        /*<<pagination code end*/
        $this->data['total_records'] = $total_rows;
        $this->data['compitions_result'] = $this->admin->listCompitions($params=[
            'limit'=>$config['per_page'],
            'start'=>$page,
            'search'=>$search_title,
        ]);
        // print_r($this->data['compitions_result']->code);exit;
        (!empty($search_title))?$this->data['search_name']=$search_title:'';
        $this->load->view($this->compition.'list_compitions',$this->data);
    }
    /*>>Compition  code end*/
}
