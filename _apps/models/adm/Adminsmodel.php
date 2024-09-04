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

class Adminsmodel extends CI_Model 
{

	public function CekEmail($email){
		$this->db->where('admin_email',$email);
		$a = $this->db->get('tbl_admins');
		return $a->result();
	}

	public function GetAll($limit=NULL,$admin_status=NULL)
	{
		$this->db->from('tbl_admins');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}

		$this->db->order_by("admin_date","DESC");
		$q = $this->db->get();
		return $q->result();
	}

	public function Detail($admin_id=NULL)
	{
		$this->db->from('tbl_admins');

		if(isset($admin_id)){
			$this->db->where('admin_id', $admin_id);
		}

		$q = $this->db->get();
		return $q;
	}

	function GetData($number,$offset,$name){
		$this->db->like('admin_name',$name);
		$this->db->order_by("admin_date","DESC");
		return $query = $this->db->get('tbl_admins',$number,$offset)->result();		
	}
 
	function total_data($name){
		$this->db->like('admin_name',$name);
		return $this->db->get('tbl_admins')->num_rows();
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