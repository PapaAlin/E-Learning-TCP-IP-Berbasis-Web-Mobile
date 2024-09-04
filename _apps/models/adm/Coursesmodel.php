<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @created 30 Maret 2017
*/

class Coursesmodel extends CI_Model 
{

	public function GetAll($limit=NULL)
	{
		$this->db->from('tbl_courses');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}

		$this->db->order_by("course_created","DESC");
		$q = $this->db->get();
		return $q->result();
	}

	public function GetAllSoal($course_id=NULL)
	{
		$this->db->from('tbl_soal');

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		$this->db->order_by("soal_no","ASC");
		$q = $this->db->get();
		return $q->result();
	}

	public function Detail($course_id=NULL)
	{
		$this->db->from('tbl_courses');

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function DetailSoal($soal_id=NULL)
	{
		$this->db->from('tbl_soal');

		if(isset($soal_id)){
			$this->db->where('soal_id', $soal_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function CekAddSoal($course_id){
		$this->db->where('course_id',$course_id);
		$this->db->order_by("soal_no","DESC");
		$this->db->limit("1");
		$a = $this->db->get('tbl_soal');
		return $a;
	}

	function GetData($number,$offset,$title){
		$this->db->like('course_title',$title);
		$this->db->order_by("course_created","DESC");
		return $query = $this->db->get('tbl_courses',$number,$offset)->result();		
	}
 
	function total_data($title){
		$this->db->like('course_title',$title);
		return $this->db->get('tbl_courses')->num_rows();
	}
	
	public function select_db($tbl_name,$col,$id){
        $this->db->from($tbl_name);
		$this->db->where($col,$id);
        return $this->db->get();
    }
	
	public function insert_db($tb_name,$data){
        return $this->db->insert($tb_name,$data);
    }
	
    public function update_db($tb_name,$col,$id,$data){
        $this->db->where($col,$id);
        return $this->db->update($tb_name,$data);
    }
	
    public function delete_db($tb_name,$col,$id){
        $this->db->where($col,$id);
        return $this->db->delete($tb_name);
    }
}