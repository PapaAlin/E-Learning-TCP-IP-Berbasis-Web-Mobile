<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 13 Juni 2020
*/

class Profile extends S_UserController
{

	public function __construct()
	{
        parent::__construct();
        $this->load->library('pagination');
		$this->load->library('form_validation');

		//model
		$this->load->model('main/Mainmodel');
		$this->load->model('main/Usersmodel');

		// Memanggil library recaptcha
		$this->load->library('Recaptcha');
		
		// Memanggil library template frontend
		$this->load->library('Template_frontend');

        date_default_timezone_set("Asia/Jakarta");
    }

    private function _get_user($user)
    {

    	//cek cookie user
        $option_login_validation = $this->Mainmodel->GetOptions('web_user_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        if($user)
        {
            //login sukses
        }
        else if ($cookie <> '')
        {
			$row = $this->Usersmodel->get_by_cookie($cookie)->row();
            if($row)
            {
                set_cookie($option_login_validation,$cookie,86400*365);
                // 1. Daftarkan Session
                $data_ses = array(
                    'user_id'   =>  $row->user_id,
                    'username' =>   $row->username,
                    'user_email' => $row->user_email
                );
                $this->session->set_userdata($data_ses);
			}
			else
			{
				//not create session
	            $this->session->sess_destroy();
	            delete_cookie($option_login_validation);

				$url = $this->ambil_url->ambilurl();
				redirect('login/?url='.$url.'');
			}
		}
		else
		{
			//not create session
            $this->session->sess_destroy();
            delete_cookie($option_login_validation);
			
			$url = $this->ambil_url->ambilurl();
			redirect('login/?url='.$url.'');
		}

    }

	public function index()
	{

		$user = $this->session->userdata('user_id');
		$this->_get_user($user);

		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "My Profile - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/profile';
		$this->template_frontend->display($template, $data);
	}

	public function edit()
	{

		$user = $this->session->userdata('user_id');
		$this->_get_user($user);

		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Edit Profile - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/profile_edit';
		$this->template_frontend->display($template, $data);
	}

	// =========== edit save ============================ //
	public function edit_save()
	{

		$user_id = $this->session->userdata('user_id');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');
		$password_old = $this->input->post('password_old');
		$user_email = $this->input->post('user_email');
		$user_email_old = $this->input->post('user_email_old');

		if($user_id)
		{

			/*
			if($password != "")
			{
				//cek kesamaan pasword
				if($password != $password2)
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
					$_password = $this->password_encrypt->encrypt($password);
				}
			}
			else
			{
				$_password = $this->input->post('password_old');
			}
			//**/

			if($user_email != $user_email_old)
			{
				//cek email in database
				if($this->Usersmodel->CekEmail($user_email))
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
					$user_email = $this->input->post('user_email');
				}
			}
			else
			{
				$user_email = $this->input->post('user_email_old');
			}

			$data = array(
				"user_name" => $this->input->post('user_name'),
				"user_email" => $user_email,
				"user_telp" => $this->input->post('user_telp'),
				"tgl_lahir" => $this->input->post('tgl_lahir'),
				"user_jk" => $this->input->post('user_jk'),
				"user_alamat" => $this->input->post('user_alamat'),
				"user_about" => $this->input->post('user_about')
			);
			
			$update = $this->Usersmodel->update_db("tbl_users","user_id",$user_id,$data);
			
			if($update)
			{
				
				$array_msg = array(
								'type' => 'success',
								'message' => 'Sukses Edit Data.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('profile');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('profile');
			}
		}
		else
		{

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('profile');
		}
	}

	public function biodata_img()
	{

		$user = $this->session->userdata('user_id');
		$this->_get_user($user);

		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Upload Gambar - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/biodata_img';
		$this->template_frontend->display($template, $data);
	}

	// =========== edit save ============================ //
	public function img_save()
	{

		if($_FILES['user_img']['name'] == "")
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gambar Tidak Boleh kosong.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('profile/biodata_img');
		}
		else
		{

			$user_img_old = $this->input->post("user_img_old");

			//upload gambar
			$ext = explode(".",$_FILES['user_img']['name']);
			$ext = end($ext);
			$user_img = 'USER-'.date('Ymd')."-".date('His')."-".rand(1,10000).'.'.$ext;

			//img medium
			$img_config['max_size'] = '1000';
			$img_config['upload_path'] = './_images/_users/_medium/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadmedium');  // Create custom object
		    $this->uploadmedium->initialize($img_config);
		    $upload_medium = $this->uploadmedium->do_upload('user_img');
			
			if(!$upload_medium)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
			}
			else
			{
				$img = $this->uploadmedium->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
					'height' => '700',
					'width' => '700',
					'quality' => '70'
				);
				$this->load->library('image_lib',$c_img_lib,'resizemedium');
				if(!$this->resizemedium->resize())
				{
					echo $this->resizemedium->display_errors();
				}
				if($user_img_old != "") unlink('./_images/_users/_medium/'.$user_img_old.'');
			}

			//img small
			$img_config['max_size'] = '1000';
			$img_config['upload_path'] = './_images/_users/_small/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadsmall');  // Create custom object
		    $this->uploadsmall->initialize($img_config);
		    $upload_small = $this->uploadsmall->do_upload('user_img');
			
			if(!$upload_small)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
			}
			else
			{
				$img = $this->uploadsmall->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
					'height' => '300',
					'width' => '300',
					'quality' => '40'
				);
				$this->load->library('image_lib',$c_img_lib,'resizesmall');
				if(!$this->resizesmall->resize())
				{
					echo $this->resizesmall->display_errors();
				}
				if($user_img_old != "") unlink('./_images/_users/_small/'.$user_img_old.'');
			}
		}

		$data = array(
			"user_img" => $user_img
		);

		$user_id = $this->session->userdata('user_id');
		$update = $this->Mainmodel->update_db("tbl_users","user_id",$user_id,$data);

		if($update)
		{

			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Upload Gambar.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('profile');

		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Coba Ulangi lagi.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('profile/biodata_img');
		}

	}

	public function profile_pass_edit()
	{

		$user = $this->session->userdata('user_id');
		$this->_get_user($user);

		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Edit Password - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/profile_pass_edit';
		$this->template_frontend->display($template, $data);
	}

	// =========== edit save ============================ //
	public function profile_pass_edit_save()
	{

		$user_id = $this->session->userdata('user_id');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');

		if($user_id)
		{

			if($password != "")
			{
				//cek kesamaan pasword
				if($password != $password2)
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
					$_password = $this->password_encrypt->encrypt($password);
				}
			}
			else
			{
				$_password = $this->input->post('password_old');
			}

			$data = array(
				"password" => $_password
			);
			
			$update = $this->Usersmodel->update_db("tbl_users","user_id",$user_id,$data);
			
			if($update)
			{
				
				$array_msg = array(
								'type' => 'success',
								'message' => 'Sukses Edit Password.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('profile');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Password'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('profile');
			}
		}
		else
		{

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('profile');
		}
	}

}
