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

	}

    public function index($start_date = NULL, $job_area_id = NULL){
        $this->auth->restrict('Planner.Planner_calendar.View');

        $display_days = 5;
        //if no job area is selseted pick the first job area id
        if(!$job_area_id){
            $job_area_id = 1;
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


        Template::set('job_types', $this->planner_model->get_job_types());
        Template::set('job_areas', $this->planner_model->get_job_areas());

        Template::set('job_area', $this->planner_model->get_job_area($job_area_id));
        Template::set('job_lines', $this->planner_model->get_lines($job_area_id));
        Template::set('area_schedules', $this->schedule_model->get_area_schedules($job_area_id,$start_date,$end_date));
        Template::set('start_date', $start_date);
        Template::set('display_days', $display_days);


        Template::set_theme('default');
        Template::set('page_title', 'Planner');
        Template::render('');
    }
    public function schedule_modal()
    {
        $schedule_date = $_GET['schedule_date'];
        $shift_id = $_GET['shift_id'];
        $line_id = $_GET['line_id'];
        //get scheduled jobs on the line for the day
        $data['schedules'] = $this->schedule_model->get_line_shift_schedule($shift_id, $line_id, $schedule_date);
        $data['title'] = 'New Schedule modal';
        $this->load->view('schedule_modal',$data);
    }
    public function extend_schedule()
    {
        $data['title'] = 'New Schedule modal';
        $this->load->view('extend_schedule',$data);
    }
}