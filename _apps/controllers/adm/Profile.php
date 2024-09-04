<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Profile extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Adminsmodel');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
	{

		$admin_id = $this->session->userdata('admin_id');
		$view_admin = $this->Adminsmodel->Detail($admin_id)->row();

        $data['view_admin'] = $view_admin;

		$data['page_title'] = "Edit - ".$view_admin->admin_name;
		$template = '/backend/content/profile';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function edit()
	{

		$admin_id = $this->session->userdata('admin_id');
		$view_admin = $this->Adminsmodel->Detail($admin_id)->row();

        $data['view_admin'] = $view_admin;

		$data['page_title'] = "Edit - ".$view_admin->admin_name;
		$template = '/backend/content/profile_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function edit_save()
	{

		$admin_id = $this->session->userdata('admin_id');
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');
		$password_old = $this->input->post('password_old');
		$admin_email = $this->input->post('admin_email');
		$admin_email_old = $this->input->post('admin_email_old');

		if($admin_id)
		{

			if($password1 != "")
			{
				//cek kesamaan pasword
				if($password1 != $password2)
				{

					$array_msg = array(
									'type' => 'danger',
									'message' => 'Password yang anda masukkan tidak sama.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
					echo '<script>window.history.back();</script>';
					

				}
				else
				{
					// Memanggil library encrypt
					$this->load->library('Password_encrypt');
					$_password = $this->password_encrypt->encrypt($password1);
				}
			}
			else
			{
				$_password = $this->input->post('password_old');
			}

			if($admin_email != $admin_email_old)
			{
				//cek email in database
				if($this->Adminsmodel->CekEmail($admin_email))
				{
					$array_msg = array(
									'type' => 'danger',
									'message' => 'Email Sudah terdaftar. Silahkan Ulangi Lagi'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
					echo '<script>window.history.back();</script>';
					
				}
				else
				{
					$admin_email = $this->input->post('admin_email');
				}
			}
			else
			{
				$admin_email = $this->input->post('admin_email_old');
			}

			$data = array(
				"admin_name" => $this->input->post('admin_name'),
				"username" => $this->input->post('username'),
				"password" => $_password,
				"admin_email" => $admin_email,
				"admin_about" => $this->input->post('admin_about')
			);
			
			$update = $this->Adminsmodel->update_db("tbl_admins","admin_id",$admin_id,$data);
			
			if($update)
			{
				
				$array_msg = array(
								'type' => 'success',
								'message' => 'Sukses Edit Data.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/profile');
				
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/profile');
				
			}
		}
		else
		{

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/admins');
			

		}
	}

}
