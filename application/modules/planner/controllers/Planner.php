<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Planner extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		$this->auth->restrict();

		$this->load->model('planner_model');
		$this->load->model('schedule_job_model');
		$this->load->model('schedule_model');
		$this->load->model('schedule_status_model');
		$this->load->model('schedule_logs_model');
		$this->load->model('mapping/job_areas_model');
		$this->load->model('mapping/lines_model');

	}

    public function index($start_date = NULL){
        $this->auth->restrict('Planner.Planner_calendar.View');

        $display_days = 5;
        //if no job area is selseted pick the first job area id
        if(!ISSET($_GET['job_area'])){
            $job_area_id = 1;
        }else{
            $job_area_id = $_GET['job_area'];
        }
        //if no date is selected pick the monday of the current week
        if(!$start_date){
            //get monday of the current week
            $currentDate = new DateTime();
            $currentDate->modify('this week');
            $start_date = $currentDate->format('d-m-Y');
        }

        //get the start date by subtracting 5 days
        $date = new DateTime($start_date);
        $date->modify('+'.$display_days.' days');
        $end_date = $date->format('d-m-Y');

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        Template::set('job_types', $this->planner_model->get_job_types());
        Template::set('job_areas', $this->planner_model->get_job_areas());

        Template::set('job_area', $this->planner_model->get_job_area($job_area_id));
        Template::set('job_lines', $this->planner_model->get_lines($job_area_id));
        Template::set('area_schedules', $this->schedule_model->get_area_schedules($job_area_id,$start_date,$end_date));
        Template::set('start_date', $start_date);
        Template::set('end_date', $end_date);
        Template::set('display_days', $display_days);
        Template::set('all_schedule_statuses', $this->schedule_model->get_all_statuses());


        Template::set_theme('default');
        Template::set('page_title', 'Planner');
        Template::render('');
    }
    public function schedule_modal()
    {
        $schedule_date = date('Y-m-d', strtotime($_GET['schedule_date']));
        $shift_id = $_GET['shift_id'];
        $line_id = $_GET['line_id'];
        $line_details = $this->schedule_model->get_line_details($line_id);
        //get scheduled jobs on the line for the day
        $data['schedules'] = $this->schedule_model->get_line_shift_schedule($shift_id, $line_id, $schedule_date);
        $data['schedule_logs'] = $this->schedule_model->get_line_shift_schedule_logs($shift_id, $line_id, $schedule_date);
        $data['statuses'] = $this->schedule_model->get_statuses($line_details->job_type_id);
        $data['line_details'] = $line_details;
        $data['schedule_date'] = $schedule_date;
        $data['shift_id'] = $shift_id;
        $this->load->view('schedule_modal',$data);
    }
    public function new_schedule()
    {
	    if(ISSET($_POST['submit'])){
	        //save the schedule job
            $schedule_job_data = array(
                'job_number' => $_POST['job_number'],
                'capacity' => $_POST['capacity'],
                'description' => $_POST['description'],
                'status' => 1,
                'deleted' => 0
            );
            $schedule_job_id = $this->schedule_job_model->insert($schedule_job_data);
            //save the schedule
            $schedule_date = date('Y-m-d',strtotime($_POST['schedule_date']));
            $schedule_data = array(
                'schedule_job_id' => $schedule_job_id,
                'job_line_id' => $_POST['line_id'],
                'shift_id' => $_POST['shift_id'],
                'schedule_date' => $schedule_date,
                'capacity' => $_POST['capacity'],
                'status' => 0
            );
            $schedule_id = $this->schedule_model->insert($schedule_data);
            //save the schedule log
            $schedule_log_data = array (
                'schedule_id' => $schedule_id,
                'schedule_status' => 0
            );
            $this->schedule_logs_model->insert($schedule_log_data);
            //log activity
            log_activity($this->auth->user_id(),"Created new schedule for :".$schedule_job_id.", job number: ".$_POST['job_number'], 'planner');
            Template::set_message('The schedule for  <b>'.$_POST['job_number'].'</b> was succesfully created.', 'alert alert-solid-success');
            //redirect to the planner page with the date and job area
            redirect('planner',true);
        }else{
            Template::set_message('Sorry the schedule was not created succefully.', 'alert alert-solid-danger');
            redirect('planner',true);
//            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function extend_schedule()
    {
        $data['extension_job_area_id'] = $_GET['job_area_id'];
        $data['extension_line_id'] = $_GET['line_id'];
        $job_area_details = $this->job_areas_model->as_object()->find($_GET['job_area_id']);
        //get job areas in the current job type
        $data['job_areas'] = $this->job_areas_model->where(array("job_type_id" => $job_area_details->job_type_id,"status"=>1))->find_all();
        //get lines for the current job area
        $data["lines"] = $this->lines_model->where(array("job_area_id"=>$job_area_details->id,"status"=>1))->find_all();
        $this->load->view('extend_schedule',$data);
    }
    public function update_schedule()
    {
        if(ISSET($_POST['submit'])){
            $schedule_id = $_POST['schedule_id'];
            $schedule_job_id = $_POST['schedule_job_id'];
            if(ISSET($_POST['statuses'])){
                //update the schedule status
                $statuses = $_POST['statuses'];
                //get the fields entered
                $schedule_status = $this->schedule_model->get_schedule_logs($schedule_id);
                foreach($statuses as $s){
                    $num =0;
                    foreach ($schedule_status as $row){
                        if($row->schedule_status == $s){$num++;}
                    }
                    if($num==0){
                        $schedule_logs = array(
                            'schedule_id' => $schedule_id,
                            'schedule_status' => $s
                        );
                        $this->schedule_logs_model->insert($schedule_logs);
                        $current_status = $s;
                    }
                }

                //check if the status has changed and update current status
                if(ISSET($current_status)){
                    $schedule_status_update_data = array(
                        'status' => $current_status
                    );
                    $this->schedule_model->update($schedule_id,$schedule_status_update_data);
                }
            }
            //update for the extension of the shift
            if(ISSET($_POST['job_area_id'])&&ISSET($_POST['line_id'])){
                $data = array(
                    'schedule_job_id' => $schedule_job_id,
                    'job_line_id' => $_POST['line_id'],
                    'shift_id' => $_POST['shift_id'],
                    'schedule_date' => $_POST['extension_date'],
                    'status' => 0
                );
                $this->schedule_model->insert($data);
            }
            redirect('planner',true);
        }else{
            Template::set_message('Sorry the schedule was not updated succefully.', 'alert alert-solid-danger');
            redirect('planner',true);
//            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}