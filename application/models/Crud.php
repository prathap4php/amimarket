<?php
defined('BASEPATH') or die('Some thing error occured');

class Crud extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function commonInsert($params)
    {
         $response = array();
         $tableName= strtolower($params['table']);
         $inputData = $params['insertData'];
         $displayInsertID = isset($params['insertID'])?$params['insertID']:0;
         $successMsg =isset($params['successMessage'])?$params['successMessage']:'Record added successfully.';
         $failMsg = isset($params['failMessage'])?$params['failMessage']:'Unable to insert record';
         $sql = $this->db->insert_string($tableName,$inputData);
         $qry = $this->db->query($sql);
         $count = $this->db->affected_rows();
         $insert_id= $this->db->insert_id();
         $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
         $response[MESSAGE] = ($count > 0)?'success':'fail';
         $response[DESCRIPTION] = ($count > 0)?$successMsg:$failMsg;
         $response['insert_id'] = ($count > 0)?$insert_id:0;
         return json_encode($response);
    }
    
    public function getSingleData($params)
    {
        $table = $params['table'];
        $column = $params['column'];
        $where  = $params['condition'];
        $result='';
        $sql= $this->db->select($column)->from($table)->where($where)->get();
        $count =  $sql->num_rows();
        if($count > 0)
        {
                $row =  $sql->row();
                $result = fetch_ucfirst($row->$column);
        }
        return $result;
    }
    
    public function duplicationCheck($params)
    {
        $returnData='';
        $table =  $params['table'];
        $cols=  $params['column'];
        $where =  $params['condition'];
        $sql = $this->db->Select($cols)->from($table)->where($where)->get();
        //echo $this->db->last_query();exit;
        $dbError = $this->db->error();
        if($dbError['code']==0)
        {
            $returnData = ($sql->num_rows() > 0)?1:0;
        }
        return $returnData;
    }
    
    public function commonUpdate($params)
    {
         $response = array();
         $tableName= strtolower($params['table']);
         $updateData = $params['updateData'];
         $whereCondition = $params['whereCondition'];
         $successMsg =isset($params['successMessage'])?$params['successMessage']:'Record updated successfully.';
         $failMsg = isset($params['failMessage'])?$params['failMessage']:'Data not modified or Some thing went wrong';
         $sql = $this->db->update_string($tableName,$updateData,$whereCondition);
         $qry = $this->db->query($sql);
        //  echo $this->db->last_query();exit;
         $count = $this->db->affected_rows();
         $response[CODE]=($count > 0)?SUCCESS_CODE:FAIL_CODE;
         $response[MESSAGE] = ($count > 0)?'success':'fail';
         $response[DESCRIPTION] = ($count > 0)?$successMsg:$failMsg;
         return json_encode($response);
    }

    public function commonDelete($params)
    {
        $response=array();
        $sql=$this->db->delete($params['table'],$params['conditionarray']);
        $action=$this->db->affected_rows();
        //echo $this->db->last_query();exit;
            $response['code']='200';
            $response['message']='Success';
            $response['description']=$action.' Deleted Succesfully !!!';
         return json_encode($response);
    }    
    
    public function checkAndReturn($params)
    {
        $returnData='';
        $table =  $params['table'];
        $cols=  $params['column'];
        $where =  $params['condition'];
        $sql = $this->db->Select($cols)->from($table)->where($where)->limit(1)->get();
        $dbError = $this->db->error();
        if($dbError['code']==0)
        {
           $count =  $sql->num_rows();
           if($count > 0)
           {
               $returnData =  $sql->row();
           }
        }
        return $returnData;
    }

    public function checkAndReturnRow($params)
    {
        $returnData='';
        $table =  $params['table'];
        $cols=  $params['column'];
        $where =  $params['condition'];
        $sql = $this->db->Select($cols)->from($table)->where($where)->limit(1)->get();
        $dbError = $this->db->error();
        // echo $this->db->last_query();exit;
        if($dbError['code']==0)
        {
           $count =  $sql->num_rows();
           if($count > 0)
           {
               $returnData =  $sql->row();
           }
        }
        return $returnData;
    }

    public function checkAndReturnResult($params)
    {
        $returnData='';
        $table =  $params['table'];
        $cols=  $params['column'];
        $where =  $params['condition'];
        $sql = $this->db->Select($cols)->from($table)->where($where)->get();
        // echo $this->db->last_query();exit;
        $dbError = $this->db->error();
        if($dbError['code']==0)
        {
           $count =  $sql->num_rows();
           if($count > 0)
           {
               $returnData =  $sql->result();
           }
        }
        return $returnData;
    }
    
    public function commonStatusUpdate($table, $update_data, $update_condition, $input_status, $debug = NULL) {
        $response = array();
        if (is_array($update_data)) {
            $sql = $this->db->update_string($table, $update_data, $update_condition);
            if (isset($debug) && $debug == 'debug') {
                $response[QUERY_MESSAGE] = $sql;
            } else {
                $update = $this->db->query($sql);
                $error = $this->db->error();
                $error_message = $error['message'];
                if ($error['code'] == 0) {
                    try {
                        $count = $this->db->affected_rows();
                        if ($count > 0) {
                            $status_message='';
                            switch ($input_status){
                                case 0:$status_message='De-Activated';break;
                                case 1:$status_message='Activated';break;
                                case 5:$status_message='Deleted';break;
                            }
                            $activation_message = $status_message;
                            $response[CODE] = SUCCESS_CODE;
                            $response[MESSAGE] = 'Success';
                            $response[DESCRIPTION] = $count . " results $activation_message successfully";
                        } else {
                            $response[CODE] = FAIL_CODE;
                            $response[MESSAGE] = 'Fail';
                            $response[DESCRIPTION] = 'Data not modified';
                        }
                    } catch (Exception $ex) {
                        $response[CODE] = FAIL_CODE;
                        $response[MESSAGE] = 'Fail';
                        $response[DESCRIPTION] = 'Some thing error occured';
                    }
                } else {
                    $response[CODE] = DB_ERROR_CODE;
                    $response[MESSAGE] = 'Database Error';
                    $response[DESCRIPTION] = $error_message;
                }
                if (QUERY_DEBUG == 1) {
                    $response[QUERY_DEBUG_MESSAGE] = $error_message;
                    $response[QUERY_MESSAGE] = $sql;
                }
            }
        } else {
            $response[CODE] = FAIL_CODE;
            $response[MESSAGE] = 'Invalid format';
            $response[DESCRIPTION] = 'Input data is in invalid format';
        }
        return json_encode($response);
    }
    
    public function moduleStatusActivity($params,$status)
    {
        $response=array();
        //print_r($params);
        $table=$params['table'];
        $updateData=$params['updatedata'];
        $updateCondition=$params['wherecondition'];
        $displayMsg=($status==1)?'Activated':'In-activated';
        $updateSql= $this->db->update_string($table,$updateData,$updateCondition);
        $update= $this->db->query($updateSql);
        $updateStatus= $this->db->affected_rows();
        $response[CODE]=($updateStatus > 0)?SUCCESS_CODE:FAIL_CODE;
        $response[MESSAGE]=($updateStatus > 0)?'Success':'Fail';
        $response[DESCRIPTION]=($updateStatus > 0)?$displayMsg.' successfully':'Unable to update condition';
        return json_encode($response);
    }

    public function commonRecordCount($params)
    {       
        $sql=$this->db->select($params['cols'])->from($params['table_name'])->get();
        $count=$sql->num_rows();
        return $count;
    }

    public function commonRecordCountWhere($params)
    {       
        $sql=$this->db->select($params['cols'])->from($params['table_name'])->where($params['whereCondition'])->get();
        $count=$sql->num_rows();
        return $count;
    }

    public function getData($params){
        $response=array();
        $this->db->select($params['cols'])->from($params['table'])->order_by($params['orderby'],'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $db_error = $this->db->error();
        if($db_error['code']!=0){
            $response['code'] = '575';
            $response['message'] = 'Fail';
            $response['description'] = (QUERY_DEBUG==1)?$db_error['message']:'Some error occured!';
        }
        else{
            $count=$query->num_rows();
            $response['code'] = ($count>0)?SUCCESS_CODE:FAIL_CODE;
            $response['message'] = ($count>0)?'Success':'Fail';
            $response['description'] = ($count>0)?'Fetching the data':'No data found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count>0)?$query->result():array();
        }
        return json_encode($response);
    }
    public function getDataWhere($params){
        $response=array();
        $this->db->select($params['cols'])->from($params['table'])->order_by($params['orderby'],'ASC');
        $this->db->where($params['where']);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $db_error = $this->db->error();
        if($db_error['code']!=0){
            $response['code'] = '575';
            $response['message'] = 'Fail';
            $response['description'] = (QUERY_DEBUG==1)?$db_error['message']:'Some error occured!';
        }
        else{
            $count=$query->num_rows();
            $response['code'] = ($count>0)?SUCCESS_CODE:FAIL_CODE;
            $response['message'] = ($count>0)?'Success':'Fail';
            $response['description'] = ($count>0)?'Fetching the data':'No data found';
            $response['result_count'] = $count;
            $response['common_result'] = ($count>0)?$query->result():array();
        }
        return json_encode($response);
    }

    /*>>Method to compress an image code start*/
    public function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/jpg')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/JPG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/PNG')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/GIF')
            $image = imagecreatefrompng($source_url);
        elseif ($info['mime'] == 'image/JPEG')
            $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }
    /*<<Method to compress an image code end*/
    /*>>Method to compress image and to return compressed image name code start*/
    public function imageConfig($field_name,$image_path,$percentage)
    {
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
      //  print_r($config);exit;
        $files = $_FILES;
        $_FILES[$field_name]['name']= time().name_converter($files[$field_name]['name']);
        $_FILES[$field_name]['type'] = $files[$field_name]['type'];
        $_FILES[$field_name]['tmp_name'] = $files[$field_name]['tmp_name'];
        $_FILES[$field_name]['error'] = $files[$field_name]['error'];
        $_FILES[$field_name]['size'] = $files[$field_name]['size'];
        $upload_image = $_FILES[$field_name]['name'];
        $upload_file = $_FILES[$field_name]['tmp_name'];
        $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $url = $_SERVER['DOCUMENT_ROOT'] . $projectpath . $image_path . $upload_image;
        if($files[$field_name]['name']!=''){
            $filename = $this->compress_image($upload_file, $url, $percentage);
           
            $image_name = $upload_image;
        }
        else 
            $image_name = '';
        return $image_name;
    }
    /*>>Method to compress image and to return compressed image name code end*/
    public function imageArrayConfig($field_name,$image_path,$percentage)
    {
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000000';
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $files = $_FILES;
        // echo count($files[$field_name]['name']);exit;
        $image_name_array='';
        for ($i=0; $i < count($files[$field_name]['name']); $i++) { 
            $_FILES[$field_name]['name']= time().name_converter($files[$field_name]['name'][$i]);
            $_FILES[$field_name]['type'] = $files[$field_name]['type'][$i];
            $_FILES[$field_name]['tmp_name'] = $files[$field_name]['tmp_name'][$i];
            $_FILES[$field_name]['error'] = $files[$field_name]['error'][$i];
            $_FILES[$field_name]['size'] = $files[$field_name]['size'][$i];
            $upload_image = $_FILES[$field_name]['name'];
            $upload_file = $_FILES[$field_name]['tmp_name'];
            $projectpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $url = $_SERVER['DOCUMENT_ROOT'] . $projectpath . $image_path . $upload_image;
            if($files[$field_name]['name'][$i]!=''){
                $filename = $this->compress_image($upload_file, $url, $percentage);
                $image_name_array.= $upload_image.',';
            }
            else 
                $image_name_array.= '';
        }        
        return $image_name_array;
    }     
}

