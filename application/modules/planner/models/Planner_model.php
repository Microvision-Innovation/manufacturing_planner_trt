<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planner_model extends MY_Model {


    public function get_lines($area_id)
    {
        return $this->db->query("SELECT bf_vision_job_types.job_type_name, job_type_id as job_type_id,bf_vision_job_areas.job_area_name as job_area_name, bf_vision_job_lines.*  FROM bf_vision_job_lines 
                                        LEFT JOIN bf_vision_job_areas ON bf_vision_job_lines.job_area_id = bf_vision_job_areas.id 
                                        LEFT JOIN bf_vision_job_types ON bf_vision_job_areas.job_type_id = bf_vision_job_types.id 
                                        WHERE bf_vision_job_lines.status=1 and job_area_id='".$area_id."' ORDER BY bf_vision_job_lines.line_name")->result();
    }
    public function get_job_area($area_id)
    {
        return $this->db->query("select bf_vision_job_types.job_type_name,bf_vision_job_types.symbol,bf_vision_job_areas.* from bf_vision_job_areas
                                        LEFT JOIN bf_vision_job_types ON bf_vision_job_areas.job_type_id = bf_vision_job_types.id 
                                        WHERE bf_vision_job_areas.status=1 and bf_vision_job_areas.id = '".$area_id."' ")->row();
    }
    public function get_job_areas()
    {
        return $this->db->query("select bf_vision_job_types.job_type_name,bf_vision_job_types.symbol,bf_vision_job_areas.* from bf_vision_job_areas
                                        LEFT JOIN bf_vision_job_types ON bf_vision_job_areas.job_type_id = bf_vision_job_types.id 
                                        WHERE bf_vision_job_areas.status=1 ORDER BY bf_vision_job_areas.job_area_name")->result();
    }
    public function get_job_types()
    {
        return $this->db->query("select * from bf_vision_job_types  WHERE status=1")->result();
    }
}