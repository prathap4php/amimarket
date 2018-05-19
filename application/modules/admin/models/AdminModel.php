<?php defined('BASEPATH') or die('Something went wrong!');
class AdminModel extends CI_model
{
    public function login($params)
    {
        // print_r($params);exit;
        $response=array();
        $email=$params['email'];
        $password=$params['password']; 
        $exists=  $this->crud->checkAndReturnRow(
            array(
                'table'=> 'admin',
                'column'=> 'admin_id,username,email,password',
                'condition'=> ['email'=>$email]
            )
        );
        // print_r($exists);exit;
        if($exists!=''){
            if($exists->password==md5($password))
            {
                $sess_array = array(
                    ADMIN_SESS_CODE.'adminid'=>$exists->admin_id,
                    ADMIN_SESS_CODE.'name'=>$exists->username,
                    ADMIN_SESS_CODE.'email'=>$exists->email,
                );
                $this->session->set_userdata($sess_array);
                $response[CODE]=SUCCESS_CODE;
                $response[MESSAGE]='Success';
                $response[DESCRIPTION]='Login success...please wait';

            }
            else{
                $response[CODE]=FAIL_CODE;
                $response[MESSAGE]='Fail';
                $response[DESCRIPTION]='Invalid password!';
            }
        }
        else{
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE]='Fail';
            $response[DESCRIPTION]=$email.' not exists';
        }
        return json_encode($response);
    }
    public function insertAnimationType($params)
    {
        $response = [];
        $title = $params['title'];
        $description = $params['description'];
        $duplication = $this->crud->duplicationCheck($params = [
            'table' => 'animation_types',
            'column' => 'id',
            'condition' => ['title'=>$title],
        ]);
        if($duplication==0){
            $data = [
                'title' => $title,
                'description' => $description,
                'created_on' => DATE,
                'flag_status' => 1,
            ];
            $insert = $this->crud->commonInsert([
                'table' => 'animation_types',
                'insertData' => $data,
                'successMessage' => $title.' added successful',
                'failMessage' => 'some error occured, please contact admin',
            ]);
            return $insert;
        }
        else{
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = $title.' already exists!';
        }
        return json_encode($response);
    }
    public function listAnimationTypes($params)
    {
        $response = [];
        $search_title = $params['search'];
        $limit = $params['limit'];
        $start = $params['start'];
        $cols = 'id as type_id,title as type_name,description,created_on as createdOn'
        .',modified_on as modifiedOn,flag_status as status';
        $this->db->select($cols)->from('animation_types');
        ($search_title!='')?$this->db->like('title',$search_title,'both'):$this->db->limit($limit,$start);
        $sql = $this->db->order_by('title','ASC')->get();
        $dbError = $this->db->error();
        if($dbError['code']==0){
            $count = $sql->num_rows();
            $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
            $response[MESSAGE] = ($count > 0)?'Success':'Fail';
            $response['types_result'] = ($count > 0)?$sql->result():array();
            $response['count'] = $count;
        }
        else{
            $response[CODE] = DB_ERROR_CODE;
            $response[MESSAGE] = 'DB Error';
            $response[DESCRIPTION] = (QUERY_DEBUG==1)?$dbError['message']:'Something went wrong';
        }
        return json_encode($response);
    }
    public function getAnimationTypeData($params)
    {
        $animation_type_id = $params['animation_type_id'];
        $result = $this->crud->checkAndReturnRow($params=[
            'column' => 'id as type_id,title as type_title,description',
            'table' => 'animation_types',
            'condition' => ['id'=>$animation_type_id],
        ]);
        return json_encode($result);
    }
    public function updateAnimationType($params)
    {
        $response = [];
        $title = $params['title'];
        $description = $params['description'];
        $type_id = $params['id'];
        $duplication= $this->crud->duplicationCheck(
            array(
                'table'=>  'animation_types',
                'column'=>'id',
                'condition'=>array('id'=>$type_id)
            )
        );
        if($duplication!=0)
        {
            $data=array(
                'title'=>$title,
                'description' => $description,
                'modified_on'=>DATE,
            );
            $where=array('id'=>$type_id);
            $update=  $this->crud->commonUpdate(
                array(
                    'table'=> 'animation_types',
                    'updateData'=>$data,
                    'whereCondition'=>$where,
                    'successMessage'=>$title.' updated successfully',
                    'failMessage'=>'Some thing error occured while updating '.$title,
                )
            );
            return $update;
        }
        else
        {
            $response[CODE]=EXISTS_CODE;
            $response[MESSAGE]='Not Exists';
            $response[DESCRIPTION]=$title.' not exists';
        }
        return json_encode($response);
    }
    public function getAnimationStyles()
    {
        $response = [];
        $animation_result = $this->crud->getData($params=[
            'cols' => 'id,title',
            'table' => 'animation_types',
            'orderby' => 'title'
        ]);
        return $animation_result;
    }
    public function insertCompition($params)
    {
        $response = [];
        $category = $params['category'];
        $casting = $params['casting'];
        $title = $params['title'];
        $date = $params['date'];
        $start_time = $params['start_time'];
        $end_time = $params['end_time'];
        $description = $params['description'];
        $duplication = $this->crud->duplicationCheck($params=[
            'table' => 'compitions',
            'column' => 'compition_id',
            'condition' => ['title'=>$title],
        ]);
        if($duplication){
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = $title.' compition already exists';

        }
        else{
            $data = [
                // 'category' => $category,
                'casting' => $casting,
                'title' => $title,
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'description' => $description,
                'created_on' => DATE,
                'flag_status' => 1,
            ];
            $insert = json_decode($this->crud->commonInsert([
                'table' => 'compitions',
                'insertData' => $data,
                'successMessage' => $title.' added successful',
                'failMessage' => 'some error occured, please contact admin',
            ]));
            // print_r($insert);exit;
            if($insert->code==SUCCESS_CODE){
                foreach($category as $catg){
                    $insertData = [
                        'compition_id' => $insert->insert_id,
                        'category_id' => $catg,                        
                    ];
                    $catgInsert = $this->crud->commonInsert([
                        'table' => 'compition_category',
                        'insertData' => $insertData,
                    ]);                    
                }
                // $catgInsert->code
            }
            return json_encode($insert);
        }
        return json_encode($response);

    }
    public function listCompitions($params)
    {
        // $response = [];
        // $search_title = $params['search'];
        // $limit = $params['limit'];
        // $start = $params['start'];
        $cols = 'compition_id as id,casting as casting,title as compition,date as compition_on'
            .',start_time as startTime,end_time as endTime,description,created_on as createdOn'
        .',modified_on as modifiedOn,flag_status as status';
        // $this->db->select($cols)->from('compitions');
        // ($search_title!='')?$this->db->like('title',$search_title,'both'):$this->db->limit($limit,$start);
        // $sql = $this->db->order_by('title','ASC')->get();
        // $dbError = $this->db->error();
        // if($dbError['code']==0){
        //     $count = $sql->num_rows();
        //     $response[CODE] = ($count > 0)?SUCCESS_CODE:FAIL_CODE;
        //     $response[MESSAGE] = ($count > 0)?'Success':'Fail';
        //     $response['compitions_result'] = ($count > 0)?$sql->result():array();
        //     $response['count'] = $count;
        // }
        // else{
        //     $response[CODE] = DB_ERROR_CODE;
        //     $response[MESSAGE] = 'DB Error';
        //     $response[DESCRIPTION] = (QUERY_DEBUG==1)?$dbError['message']:'Something went wrong';
        // }
        // return json_encode($response);
        $response=array('compition'=>array());
        //Chapters query
        $this->db->select($cols)->from('compitions');
        if ($params['search'] == '') {
            $this->db->limit($params['limit'], $params['start']);
        }
        if ($params['search'] != '') {
            ($params['search'] != '') ? $this->db->like('title',$params['search'],'both') : '';
        }
        $sql=$this->db->order_by('title','ASC')->get();
        // echo $this->db->last_query();exit;
        $compitioncount=$sql->num_rows();
        if($compitioncount > 0)
        {
            $response[CODE]=SUCCESS_CODE;
            $compitionArray=array();
            foreach($sql->result() as $compitionresult)
            {
                foreach ($compitionresult as $key => $res) {
                  $compitionArray[$key]=$res;
                }
                $compitionArray['category']=array();
                $main_id=$compitionresult->id;
                //Second level Code starts
                $catgsql=$this->db->select('ani.title as category')->from('compition_category cg')
                ->join('animation_types ani','ani.id=cg.category_id')
                ->where('compition_id',$main_id)->order_by('title','ASC')->get();
                $categorycount=$catgsql->num_rows();
                // echo $this->db->last_query();exit;
                if($categorycount > 0)
                {
                    $response[CODE]=SUCCESS_CODE;
                    $catgArray=array('code'=>SUCCESS_CODE);
                    foreach ($catgsql->result() as $catgresponse) {
                        foreach($catgresponse as $catgkey=>$catg_value )
                        {
                            $catgArray[$catgkey]=$catg_value;
                        }
                        array_push($compitionArray['category'],$catgArray);
                    }
                }                
                $response[CODE] = SUCCESS_CODE;
                $response[MESSAGE] = 'Success';
                $response[DESCRIPTION] = $compitioncount.' records found';
                array_push($response['compition'], $compitionArray);
            }
        }
        else
        {
            $response[CODE]=FAIL_CODE;
            $response[MESSAGE] = 'Fail';
            $response[DESCRIPTION] = 'No records found!';
        }
        return json_encode($response);
    }
}