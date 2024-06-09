<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mapping extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		$this->auth->restrict();

		$this->load->model('job_types_model');
		$this->load->model('job_areas_model');
		$this->load->model('lines_model');
		
	}

    public function job_types(){
        $this->auth->restrict('Planner.Mappings.View');
        if(ISSET($_POST['submit'])){
            $data = array('job_type_name'=> $_POST['job_type_name']);
            if ($this->job_types_model->insert($data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Created new job type ".$_POST['job_type_name'], 'mappings');
                Template::set_message("The Job type <b>".$_POST['job_type_name']."</b> was successfully created", 'alert alert-solid-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered creating the job type. Please check the values submitted.', 'alert alert-solid-danger');
            }
            redirect('mapping/job_types',true);
        }
        Template::set('job_types', $this->job_types_model->get_job_types());
        Template::set_theme('default');
        Template::set('page_title', 'Job Types');
        Template::render('');
    }
    public function edit_job_types(){
        if(ISSET($_POST['submit'])){
            $data = array('job_type_name'=> $_POST['job_type_name']);
            if ($this->job_types_model->update($_POST['job_type_id'],$data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Updated job type ".$_POST['job_type_name'], 'mappings');
                Template::set_message("The Job type <b>".$_POST['job_type_name']."</b> was updated", 'alert fresh-color alert-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered updating the job type. Please check the values submitted.', 'alert fresh-color alert-danger');
            }
            redirect('mapping/job_types',true);
        }
        $job_type_details = $this->job_types_model->as_object()->find($_GET['ch']);
        $url= base_url()."mapping/edit_job_types";
        $token_name = $this->security->get_csrf_token_name();
        $token_hash = $this->security->get_csrf_hash();
        echo <<<eod
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Job Type</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="$url">
                <div class="modal-body">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right">Job Type</label>
                        </div><!-- col -->
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                            <input type="text" name="job_type_name" class="form-control" placeholder="Job Type Name" value="$job_type_details->job_type_name" required>
                            <input type="hidden" name="job_type_id" value="$job_type_details->id" id="job_type_id">
                            <input type="hidden" name="$token_name" value="$token_hash" >
                        </div><!-- col -->
                        <div class="col-md-2"></div>
                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
                </div>
                </form>
            </div>
        </div>
eod;

    }
	public function job_areas(){
		$this->auth->restrict('Planner.Mappings.View');
        if(ISSET($_POST['submit'])){
            $data = array(
                'job_area_name'=> $_POST['job_area_name'],
                'job_type_id'=> $_POST['job_type_id']
            );
            if ($this->job_areas_model->insert($data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Created new Job area ".$_POST['job_area_name'], 'mappings');
                Template::set_message("The job area <b>".$_POST['job_area_name']."</b> was successfully created", 'alert alert-solid-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered creating the job area. Please check the values submitted.', 'alert alert-solid-danger');
            }
            redirect('mapping/job_areas',true);
        }
		Template::set('job_areas', $this->job_areas_model->get_job_areas());
        Template::set('job_types', $this->job_types_model->get_job_types());
        Template::set('job_areas_count', $this->job_areas_model->count_all());
		Template::set_theme('default');
		Template::set('page_title', 'Job Areas');
		Template::render('');
    }

    public function edit_job_area(){
        if(ISSET($_POST['submit'])){
            $data = array(
                'job_area_name'=> $_POST['job_area_name'],
                'job_type_id'=> $_POST['job_type_id']
            );
            if ($this->job_areas_model->update($_POST['job_area_id'],$data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Updated job area ".$_POST['job_area_name'], 'mappings');
                Template::set_message("The Job Area <b>".$_POST['job_area_name']."</b> was updated", 'alert fresh-color alert-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered updating the county. Please check the values submitted.', 'alert fresh-color alert-danger');
            }
            redirect('mapping/job_areas',true);
        }
        $job_area_details = $this->job_areas_model->as_object()->find($_GET['ch']);
        $job_types = $this->job_types_model->get_job_types();
        $url= base_url()."mapping/edit_job_area";
        $token_name = $this->security->get_csrf_token_name();
        $token_hash = $this->security->get_csrf_hash();
        echo <<<eod
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Job Area</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="$url">
                <div class="modal-body">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right">County Name</label>
                        </div><!-- col -->
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                            <input type="text" name="job_area_name" class="form-control" placeholder="Job Area Name" value="$job_area_details->job_area_name" required>
                            <input type="hidden" name="job_area_id" value="$job_area_details->id" id="job_area_id">
                            <input type="hidden" name="$token_name" value="$token_hash" >
                        </div><!-- col -->
                        <div class="col-md-2"></div>
                    </div><!-- row -->
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right">Select type</label>
                        </div><!-- col -->
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                             <select name="job_type_id" id="job_type_id" required class="form-control select2" placeholder="Select Job Type">
                            <option label="Select job type"></option>
eod;

                           foreach ($job_types as $row){
                               $selected = ($row->id==$job_area_details->job_type_id)?"selected":"";
                                echo "<option ".$selected." value='".$row->id."'>".ucwords($row->job_type_name)."</option>";
                            }
            echo <<<eod
    
                        </select>
                        </div><!-- col -->
                        <div class="col-md-2"></div>
                    </div><!-- row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-indigo">Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
                </div>
                </form>
            </div>
        </div>
eod;

    }
    public function lines(){
        $this->auth->restrict('Planner.Mappings.View');
        if(ISSET($_POST['submit'])){
            $capacity = (ISSET($_POST['capacity']))?$_POST['capacity']:"";
            $data = array(
                'job_area_id'=> $_POST['job_area_id'],
                'line_name'=> $_POST['line_name'],
                'capacity'=> $capacity
            );
            if ($this->lines_model->insert($data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Created new line ".$_POST['line_name'], 'mappings');
                Template::set_message("The Line/Tank <b>".$_POST['line_name']."<b> was successfully created", 'alert fresh-color alert-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered creating the line or tank. Please check the values submitted.', 'alert fresh-color alert-danger');
            }
            redirect('mapping/lines',true);
        }

        Template::set('lines', $this->lines_model->get_lines());
        Template::set('job_types', $this->job_types_model->where(array('status' => 1))->find_all());
        Template::set('lines_count', $this->lines_model->count_all());
        Template::set_theme('default');
        Template::set('page_title', 'Lines & Tanks');
        Template::render('');
    }
    public function create_job_areas(){
        $this->auth->restrict('Planner.Job_areas.Edit');
        if(ISSET($_POST['submit'])){
            $data = array(
                        'job_area_name'=> $_POST['job_area_name'],
                    );
            if ($this->job_areas_model->insert($data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Created new job area ".$_POST['name'], 'mappings');
                Template::set_message("The job area <b>".$_POST['job_area_name']."<b> was successfully created", 'alert fresh-color alert-success');
            }else{
                Template::set_message('Error Saving!! A problem was encountered creating the job area. Please check the values submitted.', 'alert fresh-color alert-danger');
            }
        }
        redirect('mapping/job_areas',true);
    }

    public function get_job_areas()
    {
        $job_type=$_GET['ch'];
        $service_job_areas = $this->job_areas_model->where(array('job_type_id' => $job_type,'status' => 1))
                                            ->find_all();
        if($job_type==1){
            $capacity = '
                    <div class="form-group">
                        <input type="text" required class="form-control" name="capacity" id="capacity" placeholder="Tank Capacity">
                    </div>';
        }else{
            $capacity = '';
        }


        echo <<<eod
            <div class="form-group">
               <select name="job_area_id" id="job_area_id" required class="form-control select2" placeholder="Select Job Area">
                 <option label="Select job Area" selected disabled>Select Job Area</option>
eod;

        foreach ($service_job_areas as $row){
            echo "<option value='".$row->id."'>".$row->job_area_name."</option>";
        }
        echo <<<eod
    
                </select>
            </div>
        $capacity
eod;

    }

}