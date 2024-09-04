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
	
	
	public function CekEmail($email){
		$this->db->where('user_email',$email);
		$a = $this->db->get('tbl_users');
		return $a->result();
	}

	public function CekEmailNewsletter($email){
		$this->db->where('user_email',$email);
		$this->db->where('user_status',"3");
		$a = $this->db->get('tbl_users');
		return $a->result();
	}

	public function CekUsername($username){
		$this->db->where('username',$username);
		$a = $this->db->get('tbl_users');
		return $a->result();
	}
	
	public function cekLogin($user_email,$password){
		$this->db->where('user_email',$user_email);
		$this->db->where('password',$password);
		$this->db->where('user_status',"1");
		$a = $this->db->get('tbl_users');
		return $a;
	}

	public function cekDetailEmail($user_email){
		$this->db->where('user_email',$user_email);
		$this->db->where('user_status',"0");
		$a = $this->db->get('tbl_users');
		return $a;
	}

	public function cekUserStatus($user_email){
		$this->db->where('user_email',$user_email);
		$a = $this->db->get('tbl_users');
		return $a;
	}

	public function cekActive($user_email){
		$this->db->where('user_email',$user_email);
		$this->db->where('user_status',"1");
		$a = $this->db->get('tbl_users');
		return $a->result();
	}

	public function DetailEmail($user_email){
		$this->db->where('user_email',$user_email);
		$a = $this->db->get('tbl_users');
		return $a;
	}

	// update user status
    public function Active($username,$user_email,$user_newsletter,$activation_code,$user_status,$cookie)
    {
        $this->db->where('username', $username);
		$this->db->where('user_email',$user_email);
		$this->db->where('user_newsletter',$user_newsletter);
		$this->db->where('activation_code',$activation_code);
		$this->db->where('user_status',$user_status);
		$this->db->where('cookie',$cookie);
        
        $a = $this->db->get('tbl_users');
		return $a;
    }

    // update user status
    public function update_status($data, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users', $data);
    }

	// update user
    public function update_cookie($data, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_users', $data);
    }
        
    // ambil data berdasarkan cookie
    public function get_by_cookie($cookie)
    {
        $this->db->where('cookie', $cookie);
        $this->db->from('tbl_users');
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