<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_sync extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
//		$this->auth->restrict();

		$this->load->model('data_sync_model');
		$this->load->model('schedule_job_model');

	}

    public function index()
    {
        //$start_date = date('Y-m-d', strtotime('2024-03-01'));
        //$end_date = date('Y-m-d', strtotime('2024-07-31'));
        //$sync_data = $this->data_sync_model->get_scheduled_jobs($start_date, $end_date);
        //print_r($sync_data); die();
        $sync_data = $this->data_sync_model->scheduled_jobs();
       //loop through the list
        $duplicates = 0;
        $new = 0;
        foreach($sync_data as $row) {
            //check if job number exists in our records
            //$job_check = $this->schedule_job_model->as_object()->where(array('job_number'=> $row->JobNumber))->find();
            $job_check = $this->schedule_job_model->as_object()->find_by("job_number",$row->job_no);
            if($job_check){
                //if it exists check schedule and update status
                $duplicates ++;
            }else{
                //check last char if bulk and save in orders
//                $last_character = substr($row->job_no, -1);
                $last_character = $row->job_no[strlen($row->job_no) - 1];
                $job_type = ($last_character=='B')?1:2;
                $data = array(
                    'job_number' => $row->job_no,
                    'job_type' => $job_type,
                    'capacity' => $row->qty,
                    'description' => $row->item_name,
                    'planned_start_date' => $row->planned_start_date,
                    'status' => 1,
                    'deleted' => 0,
                    'created_by' => 1
                );
                $this->schedule_job_model->insert($data);
                $new ++;
            }
        }
        echo $new." New Jobs added <br>".$duplicates." Jobs where updated";
    }
   
}