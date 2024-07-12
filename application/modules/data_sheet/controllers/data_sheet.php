<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_sheet extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		$this->auth->restrict();		
		$this->load->model('schedule_model');
		
	}

    
    public function index(){
        if(ISSET($_POST['submit'])){
            $start_date = date('Y-m-d', strtotime($_POST['start_date']));
            $end_date = date('Y-m-d', strtotime($_POST['end_date']));
        }else{
            $start_date = date('Y-m-d');
            $display_days = 5;
            //get the end date by adding 5 days
            $date = new DateTime($start_date);
            $date->modify('+'.$display_days.' days');
            $end_date = $date->format('d-m-Y');
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            //use current month for this case
            $start_date = date('Y-m-1', strtotime($start_date));
            $end_date = date('Y-m-t', strtotime($start_date));
        }
        Template::set('schedule_data', $this->schedule_model->get_data_sheet_data($start_date,$end_date));
        Template::set('start_date', $start_date);
        Template::set('end_date', $end_date);
        Template::set_theme('default');
        Template::set('page_title', 'Planner');
        Template::render('');
    }
   

}