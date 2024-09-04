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

class Usersmodel extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAll($limit=NULL,$user_status=NULL)
	{
		$this->db->from('tbl_users');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}

		if(isset($user_status)){
			if($user_status != ""){
				$this->db->where('user_status', $user_status);
			}
		}

		$this->db->order_by("user_date","DESC");
		$q = $this->db->get();
		return $q->result();
	}

	public function Detail($user_id=NULL)
	{
		$this->db->from('tbl_users');

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		$q = $this->db->get();
		return $q;
	}

	//users 0,1,2
	function GetData($number,$offset,$name,$status){
		$this->db->like('user_name',$name);
		if($status != ""):
			$this->db->where('user_status',$status);
		endif;
		$this->db->where_not_in('user_status', '3');
		$this->db->where_not_in('user_status', '4');
		$this->db->order_by("user_date","DESC");
		return $query = $this->db->get('tbl_users',$number,$offset)->result();		
	}
 
	function total_data($name,$status){
		$this->db->like('user_name',$name);
		if($status != ""):
			$this->db->where('user_status',$status);
		endif;
		$this->db->where_not_in('user_status', '3');
		$this->db->where_not_in('user_status', '4');
		return $this->db->get('tbl_users')->num_rows();
	}

	//subscriber 2
	function GetDataSubscriber($number,$offset,$email){
		$this->db->like('user_email',$email);
		$this->db->where('user_newsletter', '1');
		$this->db->order_by("user_date","DESC");
		return $query = $this->db->get('tbl_users',$number,$offset)->result();		
	}
 
	function total_data_subscriber($email){
		$this->db->like('user_email',$email);
		$this->db->where('user_newsletter', '1');
		return $this->db->get('tbl_users')->num_rows();
	}

	//delete 3
	function GetDataDelete($number,$offset,$name){
		$this->db->like('user_name',$name);
		$this->db->where('user_status', '3');
		$this->db->order_by("user_date","DESC");
		return $query = $this->db->get('tbl_users',$number,$offset)->result();		
	}
 
	function total_data_delete($name){
		$this->db->like('user_name',$name);
		$this->db->where('user_status', '3');
		return $this->db->get('tbl_users')->num_rows();
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