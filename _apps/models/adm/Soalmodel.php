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

class Soalmodel extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll($limit=NULL,$orderby=NULL)
	{
		$this->db->from('tbl_soal');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}
		
		if(isset($orderby)){
			if($orderby == ""){
				$this->db->order_by("soal_id","ASC");
			} else {
				$this->db->order_by("soal_id",$orderby);
			}
		} else {
			$this->db->order_by("soal_id","DESC");
		}

		$q = $this->db->get();
		return $q->result();
	}

	public function Detail($soal_id=NULL)
	{
		$this->db->from('tbl_soal');

		if(isset($soal_id)){
			$this->db->where('soal_id', $soal_id);
		}

		$q = $this->db->get();
		return $q;
	}

	function GetData($number,$offset,$text){
		$this->db->like('soal_text',$text);
		$this->db->order_by("soal_id","AESC");
		return $query = $this->db->get('tbl_soal',$number,$offset)->result();		
	}
 
	function total_data($text){
		$this->db->like('soal_text',$text);
		return $this->db->get('tbl_soal')->num_rows();
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