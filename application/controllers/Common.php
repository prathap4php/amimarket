<?php defined('BASEPATH') or die('Something went wrong!');
class Common extends CI_controller
{
    public $data;
    public function __construct() {
        parent::__construct();
        $this->data=array();
        $this->load->model(array('CommonModel'=>'common_model'));
    }

    public function commonStatusActivity()
    {
        $response = array();
		$tablename = $this->input->post('tablename');
		$updatelist = $this->input->post('updatelist');
		$activity = $this->input->post('activity');
		if ($tablename != '' && $updatelist != '' && $activity != '' && ($activity == 0 || $activity == 1 || $activity == 2)) {
		    $table= '';
		    $setcolumns = '';
		    $wherecondition = '';
		    $updatevalue = '';
            switch ($tablename) {
                case 'animation_types':
                    $table='animation_types';
                    $setcolumns='flag_status';
                    $updatevalue=$activity;
                    $wherecondition="id  IN  (" .$updatelist. ")";
                    break;
                case 'compition':
                    $table='compitions';
                    $setcolumns='flag_status';
                    $updatevalue=$activity;
                    $wherecondition="compition_id  IN  (" .$updatelist. ")";
                    break;
                    
                
            }
            $update = $this->common_model->commonStatusActivity($params=array('tablename'=>$table,'setcolumns'=>$setcolumns,'updatevalue'=>$updatevalue,'wherecondition'=>$wherecondition));
            echo $update;exit;
  		}
  		echo json_encode($response);
    }

    public function commonDelete()
	{
		$response = array();
		$tablename = $this->input->post('tablename');
		$updatelist = $this->input->post('updatelist');
		if ($tablename != '') {
		    $table = '';
		    $wherecondition = '';
		    switch ($tablename) {
                case 'animation_types':
                    $table = 'animation_types';
                    $wherecondition = "id IN  (" . $updatelist . ")";
                    break;
                case 'compition':
                    $table = 'compitions';
                    $wherecondition = "compition_id IN  (" . $updatelist . ")";
                    break;
            }
		    $update = $this->common_model->commonDelete($table,$wherecondition);
            echo $update;exit;
            // echo $this->db->last_query();exit;
		}
		echo json_encode($response);
    }
}