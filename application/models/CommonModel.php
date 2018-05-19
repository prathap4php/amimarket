<?php defined('BASEPATH') or die('Something went wrong!');
class CommonModel extends CI_model
{

	public function commonStatusActivity($params)
    {
        // print_r($params);exit;
        $response=array();
        $update_sql=$this->db->update_string($params['tablename'],array($params['setcolumns']=>$params['updatevalue']),$params['wherecondition']);
        $qry=$this->db->query($update_sql);
        // echo $this->db->last_query();exit; 
        $update=$this->db->affected_rows();
        // echo $update;
        switch($params['updatevalue']){
            case 0:
            $updatestatus="$update De-Activated Successfully ";break;
            case 1:
            $updatestatus="$update Activated Successfully ";break;
        }
        $response['code']=($update > 0)?200:204;
        $response['message']=($update > 0)?'Success':'Fail';
        $response['description']=($update > 0)?"<b>$updatestatus</b>":'<b style="color:red;font-weight:bold;">Unable to update</b>';
        return json_encode($response);
    }
    
    public function commonDelete($table,$conditionarray)
    {
        $response=array();
        $sql=$this->db->delete($table,$conditionarray);
        $action=$this->db->affected_rows();
            $response['code']=200;
            $response['message']='Success';
            $response['description']="<b style='color:green;font-weight:bold;'>".$action.' Deleted Succesfully !!!</b>';
         return json_encode($response);
    }
}