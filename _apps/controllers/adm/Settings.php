<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Settings extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		$data['web_logo'] = $this->Mainmodel->GetOptions('web_logo')->option_value;
		$data['web_title'] = $this->Mainmodel->GetOptions('web_title')->option_value;
		$data['web_keywords'] = $this->Mainmodel->GetOptions('web_keywords')->option_value;
		$data['web_about'] = $this->Mainmodel->GetOptions('web_about')->option_value;
		$data['web_contact_email'] = $this->Mainmodel->GetOptions('web_contact_email')->option_value;
		$data['web_contact_address'] = $this->Mainmodel->GetOptions('web_contact_address')->option_value;
		$data['web_contact_telp'] = $this->Mainmodel->GetOptions('web_contact_telp')->option_value;
		$data['web_created'] = $this->Mainmodel->GetOptions('web_created')->option_value;
		$data['web_update'] = $this->Mainmodel->GetOptions('web_update')->option_value;

		$data['page_title'] = "Website Setting";
		$template = '/backend/content/settings';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function general()
	{

		$data['web_logo'] = $this->Mainmodel->GetOptions('web_logo')->option_value;
		$data['web_title'] = $this->Mainmodel->GetOptions('web_title')->option_value;
		$data['web_keywords'] = $this->Mainmodel->GetOptions('web_keywords')->option_value;
		$data['web_about'] = $this->Mainmodel->GetOptions('web_about')->option_value;
		$data['web_contact_email'] = $this->Mainmodel->GetOptions('web_contact_email')->option_value;
		$data['web_contact_address'] = $this->Mainmodel->GetOptions('web_contact_address')->option_value;
		$data['web_contact_telp'] = $this->Mainmodel->GetOptions('web_contact_telp')->option_value;

		$data['page_title'] = "General Setting";
		$template = '/backend/content/setting_general';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function general_save()
	{

		//array date
		$array_options = array(
			1 =>  'web_title',
			'web_keywords',
			'web_logo',
			'web_about',
			'web_contact_email',
			'web_contact_address',
			'web_contact_telp',
			'web_update'
		);

		foreach ($array_options as $view_option)
		{

			$option_where = $view_option;

			//cek update
			if($view_option == "web_update")
			{
				$option_value = date("Y-m-d H:i:s");
			}
			else
			{
				$option_value = $this->input->post($view_option);
			}

			//cek image
			if($view_option == "web_logo")
			{
				if($_FILES['web_logo']['name'] == "")
				{
					$option_value = $this->input->post('web_logo_old');;
				}
				else
				{			
					//upload gambar
					$ext = explode(".",$_FILES['web_logo']['name']);
					$ext = end($ext);
					$option_value = $web_logo = 'LOGO-'.date('Ymd')."-".date('His')."-".rand(1,10000).'.'.$ext;

					//img medium
					$img_config['max_size'] = '2040';
					$img_config['upload_path'] = './_images/';
					$img_config['remove_spaces'] = true;
					$img_config['file_name'] = $web_logo;
					$img_config['allowed_types'] = 'jpg|jpeg|png';

					$this->load->library('upload', $img_config);  // Create custom object
				    $this->upload->initialize($img_config);
				    $upload = $this->upload->do_upload('web_logo');
					
					if(!$upload)
					{
						$array_msg = array(
										'type' => 'danger',
										'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 300kb, Dan format JPG,JPEG dan PNG'
									);
						$this->session->set_flashdata('message_flashdata', $array_msg);
						echo '<script>window.history.back();</script>';
						
					}
					else
					{
						$img = $this->upload->data();
						$c_img_lib = array(
							'image_library' => 'gd2',
							'source_image' => $img['full_path'],
							'new_image' => $web_logo,
							'height' => '300',
							'width' => '300',
							'quality' => '70'
						);
						$this->load->library('image_lib',$c_img_lib);
						if(!$this->image_lib->resize())
						{
							$error = $this->image_lib->display_errors();
							$array_msg = array(
											'type' => 'danger',
											'message' => 'Gagal Tambah Data, '.$error
										);
							$this->session->set_flashdata('message_flashdata', $array_msg);
							echo '<script>window.history.back();</script>';
							
						}
						if($this->input->post('web_logo_old') != "") unlink('./_images/'.$this->input->post('web_logo_old').'');
					}
				}
			}

			$data = array(
				"option_value" => $option_value
			);
			
			$update = $this->Mainmodel->update_db("tbl_options","option_name",$option_where,$data);

		}
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/settings');
			
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			echo '<script>window.history.back();</script>';
			
		}
	}

	public function security()
	{

		$data['web_email_administrator'] = $this->Mainmodel->GetOptions('web_email_administrator')->option_value;
		$data['web_admin_validation'] = $this->Mainmodel->GetOptions('web_admin_validation')->option_value;
		$data['web_user_validation'] = $this->Mainmodel->GetOptions('web_user_validation')->option_value;

		$data['page_title'] = "Security Setting";
		$template = '/backend/content/setting_security';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function security_save()
	{

		//array date
		$array_options = array(
			1 =>  'web_email_administrator',
			'web_admin_validation',
			'web_user_validation',
			'web_update'
		);

		foreach ($array_options as $view_option)
		{

			$option_where = $view_option;

			//cek update
			if($view_option == "web_update")
			{
				$option_value = date("Y-m-d H:i:s");
			}
			else
			{
				$option_value = $this->input->post($view_option);
			}

			$data = array(
				"option_value" => $option_value
			);
			
			$update = $this->Mainmodel->update_db("tbl_options","option_name",$option_where,$data);

		}
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/settings');
			
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			echo '<script>window.history.back();</script>';
			
		}
	}

}
