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

class Mainmodel extends CI_Model 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function GetAllSlideheaders($status=NULL,$limit=NULL,$slideheader_order=NULL)
	{
		$this->db->from('tbl_slideheaders');

		if(isset($status)){
			if($status != ""){
				$this->db->where('status', $status);
			}
		}
		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}
		if(isset($slideheaders_order)){
			if($slideheaders_order == ""){
				$this->db->order_by("slideheader_order","DESC");
			} else {
				$this->db->order_by("slideheader_order",$slideheader_order);
			}
		} else {
			$this->db->order_by("slideheader_order","DESC");
		}

		$q = $this->db->get();
		return $q->result();
	}

	public function CekProduct($product_id)
	{
		$this->db->from('tbl_products');

		if(isset($product_id)){
			$this->db->where('product_id', $product_id);
		}

		$this->db->where('product_status', "2");
		$q = $this->db->get();
		return $q;
	}

	public function GetOptions($option_name=NULL)
	{
		$this->db->from('tbl_options');

		if(isset($option_name)){
			if($option_name == ""){
				$this->db->where('option_name', 'web_title');
			} else {
				$this->db->where('option_name', $option_name);
			}
		} else {
			$this->db->where('option_name', 'web_title');
		}

		$q = $this->db->get();
		return $q->row();
	}

	public function ReadAdmin($admin_id=NULL)
	{
		$this->db->from('tbl_admins');

		if(isset($admin_id)){
			$this->db->where('admin_id', $admin_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function ReadUser($user_id=NULL)
	{
		$this->db->from('tbl_users');

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function CekUser($username=NULL)
	{
		$this->db->from('tbl_users');

		if(isset($username)){
			$this->db->where('username', $username);
		}

		$q = $this->db->get();
		return $q;
	}

    // ambil data berdasarkan tabel
    public function GetTotal($tbl,$col,$id)
    {
    	if(isset($col)){
			if($col != ""){
				$this->db->where($col,$id);
			}
		}

        $this->db->from($tbl);
        return $this->db->get();
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