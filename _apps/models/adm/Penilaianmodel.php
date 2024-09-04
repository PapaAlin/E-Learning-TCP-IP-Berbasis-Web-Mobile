<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

class Penilaianmodel extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll($limit=NULL,$orderby=NULL)
	{
		$this->db->from('tbl_penilaian');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}
		
		if(isset($orderby)){
			if($orderby == ""){
				$this->db->order_by("penilaian_id","DESC");
			} else {
				$this->db->order_by("penilaian_id",$orderby);
			}
		} else {
			$this->db->order_by("penilaian_id","DESC");
		}

		$q = $this->db->get();
		return $q->result();
	}

	public function Detail($penilaian_id=NULL)
	{
		$this->db->from('tbl_penilaian');

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		$q = $this->db->get();
		return $q;
	}

	function GetData($number,$offset,$user_id){
		if($user_id != "")
		{
			$this->db->where('user_id',$user_id);
		}
		$this->db->order_by("penilaian_created","DESC");
		return $query = $this->db->get('tbl_penilaian',$number,$offset)->result();		
	}
 
	function total_data($user_id){
		if($user_id != "")
		{
			$this->db->where('user_id',$user_id);
		}
		return $this->db->get('tbl_penilaian')->num_rows();
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