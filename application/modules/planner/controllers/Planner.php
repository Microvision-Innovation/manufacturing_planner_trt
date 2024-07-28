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
		$this->load->model('comments_model');
		$this->load->model('mapping/job_areas_model');
		$this->load->model('mapping/lines_model');

	}

    public function index($start_date = NULL, $job_area_id = NULL){
//        echo $start_date."<br>";
//        echo $job_area_id;
//        die();
        $this->auth->restrict('Planner.Planner_calendar.View');
        $display_days = 5;
        //if no job area is selected pick the first job area id
        if(!ISSET($_GET['job_area']) and !$job_area_id){
            $job_area_id = 1;
        }elseif(ISSET($_GET['job_area'])){
            $job_area_id = $_GET['job_area'];
        }
        //if no date is selected pick the monday of the current week
        if(!$start_date){
            //get monday of the current week
            $currentDate = new DateTime();
            $currentDate->modify('this week');
            $start_date = $currentDate->format('d-m-Y');
        }

        //get the end date by adding display days
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
        Template::set('active_job_area', $job_area_id);
        Template::set('display_days', $display_days);
        Template::set('all_schedule_statuses', $this->schedule_model->get_all_statuses());


        Template::set_theme('default');
        Template::set('page_title', 'Planner');
        Template::render('');
    }
    public function data_sheet(){
	    $start_date = $_GET['start_date'];
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

        $data['schedule_data'] = $this->schedule_model->get_data_sheet_data($start_date,$end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $this->load->view('data_sheet_modal',$data);
    }
    public function schedule_modal()
    {
        $schedule_date = date('Y-m-d', strtotime($_GET['schedule_date']));
        $shift_id = $_GET['shift_id'];
        $line_id = $_GET['line_id'];
        $line_details = $this->schedule_model->get_line_details($line_id);
        //get scheduled jobs on the line for the day
        $data['schedules'] = $this->schedule_model->get_line_shift_schedule($shift_id, $line_id, $schedule_date);
        $data['related_schedules'] = $this->schedule_model->get_related_line_shifts_schedules($shift_id, $line_id, $schedule_date);
        $data['schedule_extensions'] = $this->schedule_model->get_line_shift_schedule_extensions($shift_id, $line_id, $schedule_date);
        //get comments for schedules
        $data['job_comments'] = $this->comments_model->get_line_shift_comments($shift_id, $line_id, $schedule_date);
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
            $schedule_job_id = $_POST['jobs_id'];
            $line_details = $this->lines_model->as_object()->find($_POST['line_id']);
            $job_details = $this->schedule_job_model->as_object()->find($_POST['jobs_id']);
//            $schedule_job_data = array(
//                'job_number' => $_POST['job_number'],
//                'capacity' => $_POST['capacity'],
//                'description' => $_POST['description'],
//                'status' => 1,
//                'deleted' => 0
//            );
//            $schedule_job_id = $this->schedule_job_model->insert($schedule_job_data);
            //save the schedule
            $schedule_date = date('Y-m-d',strtotime($_POST['schedule_date']));
            $schedule_data = array(
                'schedule_job_id' => $_POST['jobs_id'],
                'job_line_id' => $_POST['line_id'],
                'shift_id' => $_POST['shift_id'],
                'schedule_date' => $schedule_date,
                'capacity' => $job_details->capacity,
                'comments' => $_POST['comments'],
                'status' => 0
            );
            $schedule_id = $this->schedule_model->insert($schedule_data);
            //check if there are comments and insert in comments
            if((ISSET($_POST['comments'])) and ($_POST['comments'] != "") ){
                $comment_data = array(
                    'schedule_id' => $schedule_id,
                    'comments' => $_POST['comments']
                );
                $this->comments_model->insert($comment_data);
            }
            //save the schedule log
            $schedule_log_data = array (
                'schedule_id' => $schedule_id,
                'schedule_status' => 0
            );
            $this->schedule_logs_model->insert($schedule_log_data);
            //save schedule status
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
            //log activity
            log_activity($this->auth->user_id(),"Created new schedule for :".$schedule_job_id.", job number: ".$job_details->job_number, 'planner');
            Template::set_message('The schedule for  <b>'.$job_details->job_number.'</b> was succesfully created.', 'alert alert-solid-success');
            //redirect to the planner page with the date and job area
            redirect('planner/index/'.$schedule_date.'/'.$line_details->job_area_id,true);
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
        if(ISSET($_POST['submit']) AND $_POST['submit'] == 'submit'){
            $schedule_job_id = $_POST['schedule_job_id'];
            $job_details = $this->schedule_job_model->as_object()
                ->join('bf_vision_job_types jt','jt.id=bf_vision_schedule_jobs.job_type','left')
                ->select('bf_vision_schedule_jobs.*,job_type_name,symbol')
                ->find($schedule_job_id);
            //check if it's an extension or status update for an existing schedule
            if(ISSET($_POST['schedule_id'])){
                $schedule_id = $_POST['schedule_id'];
                //update for the extension of the shift
                $schedule_details = $this->schedule_model->as_object()->find($schedule_id);
                $extension_status = $schedule_details->status;
                if(ISSET($_POST['job_area_id'])&&ISSET($_POST['line_id'])){
                    //get status from an existing job and use it as the current job status
                    $data = array(
                        'schedule_job_id' => $schedule_job_id,
                        'job_line_id' => $_POST['line_id'],
                        'shift_id' => $_POST['shift_id'],
                        'schedule_date' => $_POST['extension_date'],
                        'status' => $extension_status
                    );
                    $this->schedule_model->insert($data);
                }
                //todo:move all statuses from the schedule to the job
                //get all jobs for the schedule and update each of them
                $schedule_jobs = $this->schedule_model->where(array('schedule_job_id'=>$schedule_job_id,'deleated'=>0))->find_all();
                foreach($schedule_jobs as $sj) {
                    $schedule_id = $sj->id;
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
                }

                //log activity
                log_activity($this->auth->user_id(),"Updated status or extension schedule for :".$schedule_job_id.", job number: ".$job_details->job_number, 'planner');
                Template::set_message('The schedule for  <b>'.$job_details->job_number.'</b> was succesfully updated.', 'alert alert-solid-success');
            }else{
                //we are creating a new schedule for an existing job
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
                //todo:move all statuses from the schedule to the job
                //get all jobs for the schedule and update each of them
                $schedule_jobs = $this->schedule_model->where(array('schedule_job_id'=>$schedule_job_id,'deleated'=>0))->find_all();
                foreach($schedule_jobs as $sj){
                    $schedule_id = $sj->id;

                    //save the status for the schedule
                    if(ISSET($_POST['statuses'])) {
                        //update the schedule status
                        $statuses = $_POST['statuses'];
                        foreach ($statuses as $s) {
                            $schedule_logs = array(
                                'schedule_id' => $schedule_id,
                                'schedule_status' => $s
                            );
                            $this->schedule_logs_model->insert($schedule_logs);
                            $current_status = $s;
                        }
                        //check if the status was selected and update current status
                        if (isset($current_status)) {
                            $schedule_status_update_data = array(
                                'status' => $current_status
                            );
                            $this->schedule_model->update($schedule_id, $schedule_status_update_data);
                        }
                    }
                    //save the schedule log
                    $schedule_log_data = array (
                        'schedule_id' => $schedule_id,
                        'schedule_status' => 0
                    );
                    $this->schedule_logs_model->insert($schedule_log_data);
                }

                //log activity
                log_activity($this->auth->user_id(),"Created new schedule for :".$schedule_job_id.", job number: ".$job_details->job_number, 'planner');
                Template::set_message('The schedule for  <b>'.$job_details->job_number.'</b> was succesfully created.', 'alert alert-solid-success');
            }
            //check if its a comment addition and update
            if((ISSET($_POST['comments'])) and ($_POST['comments'] != "") ){
                $schedule_id = (ISSET($schedule_id))?$schedule_id:$_POST['comments_schedule_id'];
                $comment_data = array(
                    'schedule_id' => $schedule_id,
                    'comments' => $_POST['comments']
                );
                $this->comments_model->insert($comment_data);
            }
            $schedule_details = $this->schedule_model->as_object()
                                                ->join('bf_vision_job_lines l','l.id = job_line_id','left')
                                                ->select('bf_vision_schedules.*,l.job_area_id')
                                                ->find($schedule_id);

            redirect('planner/index/'.$schedule_details->schedule_date.'/'.$schedule_details->job_area_id,true);
        }elseif(ISSET($_POST['submit']) AND $_POST['submit'] == 'Delete'){
            if(ISSET($_POST['schedule_id'])){
                $schedule_id = $_POST['schedule_id'];
                //we delete the schedule
                $this->schedule_model->delete($schedule_id);
                $schedule_details = $this->schedule_model->as_object()
                    ->join('bf_vision_job_lines l','l.id = job_line_id','left')
                    ->join('bf_vision_schedule_jobs sj','sj.id=bf_vision_schedules.schedule_job_id','left')
                    ->select('bf_vision_schedules.*,l.job_area_id,sj.job_number')
                    ->find($schedule_id);
                //log activity
                log_activity($this->auth->user_id(),"Deleted schedule :".$schedule_id.", job number: ".$schedule_details->job_number, 'planner');
                Template::set_message('The schedule for  <b>'.$schedule_details->job_number.'</b> was succesfully deleted.', 'alert alert-solid-success');
                redirect('planner/index/'.$schedule_details->schedule_date.'/'.$schedule_details->job_area_id,true);
            }

        }else{
            Template::set_message('Sorry the schedule was not updated successfully.', 'alert alert-solid-danger');
            redirect('planner',true);
//            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_schedule($schedule_id)
    {
        //we delete the schedule
        $this->schedule_model->delete($schedule_id);
        $schedule_details = $this->schedule_model->as_object()
            ->join('bf_vision_job_lines l','l.id = job_line_id','left')
            ->join('bf_vision_schedule_jobs sj','sj.id=bf_vision_schedules.schedule_job_id','left')
            ->select('bf_vision_schedules.*,l.job_area_id, sj.job_number')
            ->find($schedule_id);
        //log activity
        log_activity($this->auth->user_id(),"Deleted schedule :".$schedule_id.", job number: ".$schedule_details->job_number, 'planner');
        Template::set_message('The schedule for  <b>'.$schedule_details->job_number.'</b> was succesfully deleted.', 'alert alert-solid-success');
        redirect('planner/index/'.$schedule_details->schedule_date.'/'.$schedule_details->job_area_id,true);
    }
    public function filter_job_lines()
    {
        $area_id = $_GET['job_area_id'];
        //area details
        $area_details = $this->job_areas_model->as_object()
                                                        ->join('bf_vision_job_types jt','jt.id=bf_vision_job_areas.job_type_id','left')
                                                        ->select('bf_vision_job_areas.*, jt.symbol')
                                                        ->find_by('bf_vision_job_areas.id',$area_id);
        $lines = $this->lines_model->where(array('job_area_id'=>$area_id,'status'=>1))->find_all();
        if($lines){
            $labels = ($area_details->symbol=='Bulk')?'Tank':'Line';
            echo <<<eod
            <select class="form-control" name="line_id" id="line_id">
                <option label="Choose $labels"></option>
eod;
            foreach($lines as $l){
                    echo "<option value='".$l->id."'>".$l->line_name."</option>";
            }
            echo "</select>";
        }else{
            echo "Ops! There are no options for this job area";
        }
    }
    public function search_job_numbers()
    {
        $job_number = $_GET['job_number'];
        //search the job numbers
        $search_results = $this->schedule_model->get_search_results($job_number);
        //display the results
        if($search_results){
            $url=base_url()."planner/job_search_modal";
            echo <<<eod
            <br>
            <h5>Search Results</h5>
            <table width="100%" border="0">
                <thead>
                <tr>
                    <th><span class="pull-left">Job Numbers</span></th>
                    <th>Types</th>
                </tr>
                </thead>
                <tbody>
eod;
            foreach($search_results as $row){
                echo "
                <tr class='clickable-cell' data-toggle='modal' data-target='#txtResult' onclick=\"htmlData('$url','job_number=$row->id')\">
                    <td align='left' ><span class='pull-left'>".$row->job_number."</span></td>
                    <td>".$row->symbol."</td>
                </tr>
                ";
            }

            echo <<<eod
                </tbody>
            </table>
eod;
        }else{
            echo "No search results matched the job number";
        }
    }
    public function search_job_type_numbers()
    {
        $job_number = $_GET['job_number'];
        $job_type = $_GET['job_type'];
        $data['statuses'] = $this->schedule_status_model
            ->where(array("job_type_id" => $job_type,"status"=>1))
            ->find_all();
        //search the job numbers
        $data['search_results'] = $this->schedule_model->get_search_results2($job_number,$job_type);
        $this->load->view('new_schedule_search_results',$data);
    }
    public function job_search_modal()
    {
        $job_number = $_GET['job_number'];
        //get job details
        $job_details = $this->schedule_job_model->as_object()
                                        ->join('bf_vision_job_types jt','jt.id=bf_vision_schedule_jobs.job_type','left')
                                        ->select('bf_vision_schedule_jobs.*,job_type_name,symbol')
                                        ->find($job_number);
        $data['job_details'] = $job_details;
        //get job schedules
        $data['job_schedules'] = $this->schedule_model
                                                    ->join('bf_vision_job_lines l','l.id =bf_vision_schedules.job_line_id ','left')
                                                    ->join('bf_vision_job_areas a','a.id =l.job_area_id','left')
                                                    ->join('bf_vision_shifts s','s.id =bf_vision_schedules.shift_id','left')
                                                    ->join('bf_vision_schedule_status sts','sts.id =bf_vision_schedules.status','left')
                                                    ->join('bf_vision_job_types jt','jt.id =a.job_type_id','left')
                                                    ->where(array("schedule_job_id" => $job_number,"deleated"=>0))
                                                    ->select('bf_vision_schedules.*,l.line_name,a.job_area_name,s.shift_name,sts.schedule_status, jt.symbol,l.job_area_id')
                                                    ->find_all();
        //get related schedules/jobs
        $trimmed_job_number = rtrim($job_details->job_number, 'B');
        $data['related_jobs'] = $this->schedule_model->get_related_job_schedules($trimmed_job_number, $job_details->id);
        //get job logs
        $data['schedule_logs']= $this->schedule_logs_model
                                                    ->join('bf_vision_schedules s','s.id=bf_vision_schedule_logs.schedule_id','inner')
                                                    ->join('bf_vision_schedule_status ss','ss.id=bf_vision_schedule_logs.schedule_status','inner')
                                                    ->join('bf_users u','u.id =bf_vision_schedule_logs.created_by','inner')
                                                    ->select('bf_vision_schedule_logs.*,ss.schedule_status as schedule_status_name,ss.step_order,u.display_name')
                                                    ->where(array("s.schedule_job_id" => $job_number,"deleted"=>0))
                                                    ->find_all();
        $data['statuses'] = $this->schedule_status_model
                                                    ->where(array("job_type_id" => $job_details->job_type,"status"=>1))
                                                    ->find_all();
        //get scheduling details based on the job type
        //get job areas in the current job type
        $data['job_areas'] = $this->job_areas_model->where(array("job_type_id" => $job_details->job_type,"status"=>1))->find_all();
        //get lines for the current job type
        $data["lines"] = $this->lines_model
                                            ->join('bf_vision_job_areas a','a.id =bf_vision_job_lines.job_area_id','inner')
                                            ->where(array("a.job_type_id"=>$job_details->job_type,"bf_vision_job_lines.status"=>1))
                                            ->select('bf_vision_job_lines.*')
                                            ->find_all();
        //get comments
        $data['job_comments'] = $this->comments_model->get_schedule_comments($job_details->id);
        $this->load->view('job_search_schedule_modal',$data);
    }
    public function open_jobs($job_id){
        //get the last status on the job before it was put on hold
        $last_status = $this->schedule_status_model->get_last_status($job_id);
        //get all schedules for the job
        $schedules = $this->schedule_model->where(array("schedule_job_id"=>$job_id,"deleated"=>0))->find_all();
        //update all status to current status
        foreach($schedules as $row){
            $data = array('status' => $last_status->status);
            $this->schedule_model->update($row->id,$data);
            $schedule_id = $row->id;
        }
        //get detailed from the last job through the last schedule updated
        $schedule_details = $this->schedule_model->as_object()
            ->join('bf_vision_job_lines l','l.id = job_line_id','left')
            ->join('bf_vision_schedule_jobs sj','sj.id=bf_vision_schedules.schedule_job_id','left')
            ->select('bf_vision_schedules.*,l.job_area_id, sj.job_number')
            ->find($schedule_id);
        //log the activity
        log_activity($this->auth->user_id(),"Re-opened job number: ".$schedule_details->job_number." that was on hold", 'planner');
        Template::set_message('The schedule for  <b>'.$schedule_details->job_number.'</b> was succesfully reopened.', 'alert alert-solid-success');
        //die();
        redirect('planner/index/'.$schedule_details->schedule_date.'/'.$schedule_details->job_area_id,true);
    }


}