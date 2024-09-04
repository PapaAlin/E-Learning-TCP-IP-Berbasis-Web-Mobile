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
	
	public function cekLoginAdmin($admin_email,$password){
		$this->db->where('admin_email',$admin_email);
		$this->db->where('password',$password);
		$a = $this->db->get('tbl_admins');
		return $a->result();
	}
	
	public function cekLoginAdminRem($admin_email,$password){
		$this->db->where('admin_email',$admin_email);
		$this->db->where('password',$password);
		$a = $this->db->get('tbl_admins');
		return $a;
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

	public function GetMenuHeader($limit=NULL,$menu_parent=NULL)
	{
		$this->db->from('tbl_menu_frontend');

		if(isset($limit)){
			if($limit == ""){
				$this->db->limit($limit);
			}
		}

		if(isset($menu_parent)){
			if($menu_parent != ""){
				$this->db->where('menu_parent',$menu_parent);
			} else {
				$this->db->where('menu_parent', '0');
			}
		} else {
			$this->db->where('menu_parent', '0');
		}

		$this->db->where('menu_status', 2);
		$this->db->order_by("menu_order","ASC");
		$q = $this->db->get();
		return $q->result();
	}

	public function CekMenuHeaderParent($menu_id=NULL)
	{
		$this->db->from('tbl_menu_frontend');

		$this->db->where('menu_parent', $menu_id);
		$this->db->where('menu_status', 2);

		$q = $this->db->get();
		return $q->num_rows();
	}

	// update user
    public function update_cookie($data, $admin_id)
    {
        $this->db->where('admin_id', $admin_id);
        $this->db->update('tbl_admins', $data);
    }
        
    // ambil data berdasarkan cookie
    public function get_by_cookie($cookie)
    {
        $this->db->where('cookie', $cookie);
        $this->db->from('tbl_admins');
        return $this->db->get();
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

	public function GetSites($limit=NULL)
	{
		$this->db->from('tbl_sites');

		if(isset($limit)){
			if($limit != ""){
				$this->db->limit($limit);
			}
		}

		$this->db->where('site_status', 1);
		$this->db->order_by("site_order","ASC");
		$q = $this->db->get();
		return $q->result();
	}

    //detail site
	function GetDetailSite($site_id=NULL){
		$this->db->where('site_id', $site_id);
		$this->db->where('site_status', '1');
		$this->db->order_by("site_date","ASC");
		return $this->db->get('tbl_sites');		
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