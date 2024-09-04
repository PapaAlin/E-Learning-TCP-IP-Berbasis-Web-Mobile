<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends S_AdmController {

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

		//get name
		if($this->input->get('name')):
			$data['get_name'] = $name = $this->input->get('name');
		else:
			$data['get_name'] = $name = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "&name=".$name."&search=";

        //total data
		$data['total_data'] = $total_data = $this->Adminsmodel->total_data($name);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/admins/?'.$get_search;
		$config['total_rows'] = $total_data;
		$config['per_page'] = 10;
		$config['uri_segment'] = $page;

        $config['next_page']    = "&laquo;";
        $config['prev_page']    = "&raquo;";
		
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-left">';
        $config['full_tag_close'] = '</ul>';
        
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
 
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
 
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
 
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
 
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
 
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		
		$data['paging']=$this->pagination->create_links();
        $data['nopage']=$page;

		$data['admins'] = $this->Adminsmodel->GetData($config['per_page'],$page,$name);

		$data['page_title'] = "Data Semua Guru";
		$template = '/backend/content/admins';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{

		if($this->Adminsmodel->Detail($this->session->userdata('admin_id'))->row()->admin_status == "0")
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Anda tidak di izinkan menambah user.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
        }

		$data['page_title'] = "Tambah Guru";
		$template = '/backend/content/admin_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function add_save()
	{

		$username = $this->input->post('username');
		$admin_name = $this->input->post('admin_name');
		$admin_email = $this->input->post('admin_email');
		$password1 = $this->input->post('password1');
		$password2 = $this->input->post('password2');

		//cek required
		if($username == "" ||$admin_name == "" ||  $admin_email == "" || $password1 == "" || $password2 == ""){

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Kolom Tidak Boleh Kosong.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register');

		}
		else
		{

			//cek email in database
			if($this->Adminsmodel->CekEmail($admin_email))
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Email Sudah terdaftar. Silahkan Ulangi Lagi'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/admins/add');
			}

			//cek kesamaan pasword
			if($password1 != $password2)
			{

				$array_msg = array(
								'type' => 'danger',
								'message' => 'Password yang anda masukkan tidak sama.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/admins/add');

			}

			// Memanggil library encrypt
			$this->load->library('Password_encrypt');
			$_password = $this->password_encrypt->encrypt($password1);

			$data = array(
				"admin_name" => $this->input->post('admin_name'),
				"admin_email" => $admin_email,
				"username" => $this->input->post('username'),
				"password" => $_password,
				"admin_about" => $this->input->post('admin_name'),
				"admin_status" => $this->input->post('admin_status'),
				"admin_login" => date("Y-m-d H:i:s"),
				"admin_date" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Adminsmodel->insert_db("tbl_admins",$data);

			if($insert)
			{

				$array_msg = array(
								'type' => 'success',
								'message' => 'Sukses Menambah Admin.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/admins');

			}
			else
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Coba Ulangi lagi.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/admins');
			}

		}
	}

	public function edit()
	{
		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di edit.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Adminsmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/admins');
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/admins');
            }
        }
        if($this->Adminsmodel->Detail($this->session->userdata('admin_id'))->row()->admin_status == "0")
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Anda tidak di izinkan edit user.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
        }

		$admin_id = $this->uri->segment(4);
		$view_admin = $this->Adminsmodel->Detail($admin_id)->row();

        $data['view_admin'] = $view_admin;

		$data['page_title'] = "Edit - ".$view_admin->admin_name;
		$template = '/backend/content/admin_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function edit_save()
	{

		$admin_id = $this->input->post('admin_id');
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
				"admin_status" => $this->input->post('admin_status'),
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
				redirect('adm/admins');
				
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

	// ========================= delete =================== //
	public function delete(){
			
		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di Hapus..'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Adminsmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/admins');
	                
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/admins');
                
            }
        }

		$view_admin = $this->Adminsmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Mainmodel->delete_db('tbl_admins','admin_id',$this->uri->segment(4));
		if($delete)
		{
			//delete gambar
			if($view_admin->admin_img != "") unlink('./_images/_admins/_small/'.$view_admin->admin_img.'');
			if($view_admin->admin_img != "") unlink('./_images/_admins/_medium/'.$view_admin->admin_img.'');
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
            
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/admins');
            
		}
    }

}
