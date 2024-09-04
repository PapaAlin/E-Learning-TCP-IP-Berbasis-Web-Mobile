<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');
		
        // Memanggil library template frontend
        $this->load->library('Template_backend');
        // Memanggil library Admin_Class_menu
        $this->load->library('Admin_Class_menu');

		//helper string
		$this->load->helper('string');

		//database
		$this->load->model('adm/Mainmodel');
        $this->load->model('adm/Penilaianmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

        //cek cookie admin_id
        $option_login_validation = $this->Mainmodel->GetOptions('web_admin_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        $user = $this->session->userdata('admin_id');
        if($user)
		{
			//login sukses
		}
		else if ($cookie <> '')
		{
			$row = $this->Mainmodel->get_by_cookie($cookie)->row();
			if($row)
			{
                set_cookie($option_login_validation,$cookie,86400*365);
                $this->_session_registered($row);
			}
			else
			{
				$url = $this->ambil_url->ambilurl();
				redirect('adm/main/login/?url='.$url.'');
				
			}
		}
		else
		{
			$url = $this->ambil_url->ambilurl();
			redirect('adm/main/login/?url='.$url.'');
			
		}

		$data['page_title'] = "Admin Dashboard";
		$template = '/backend/content/main';
		$template_css = '/backend/include/main_css';
		$template_js = '/backend/include/main_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// ================= login logout =================== //
	public function login(){

		//cek cookie admin_id
        $option_login_validation = $this->Mainmodel->GetOptions('web_admin_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        $user = $this->session->userdata('admin_id');
        if($user)
        {
            //login sukses
            redirect('adm/');
        }
        else if ($cookie <> '')
        {
            $row = $this->Mainmodel->get_by_cookie($cookie)->row();
            if($row)
            {
                set_cookie($option_login_validation,$cookie,86400*365);
                $this->_session_registered($row);
                redirect('adm/');
                
            }
        }

		$data['page_title'] = "Admin Login Page";
		$data['url'] = $this->input->get('url');
		$this->load->view('backend/loginpage',$data);
	}
	
	public function ceklogin(){

		// Memanggil library encrypt
		$this->load->library('Password_encrypt');

		$remember = $this->input->post('remember');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$_password = $this->password_encrypt->encrypt($password);

		$row = $this->Mainmodel->cekLoginAdminRem($email,$_password)->row();
		if($row)
		{
			
			//string random
			$key = random_string('alnum', 32);
			
			if($remember)
			{
				$option_login_validation = $this->Mainmodel->GetOptions('web_admin_validation')->option_value;
				set_cookie($option_login_validation,$key,86400*365);

				$update_key = array(
						'cookie' => $key,
						'admin_login' => date("Y-m-d H:i:s")
					);
				$this->Mainmodel->update_cookie($update_key, $row->admin_id);
			}

			$this->_session_registered($row);

			if($this->input->post('url') != "")
			{
				redirect($this->input->post('url'));
				
			}
			else
			{
				redirect('adm/main');
				
			}
		}
		else
		{
			$url = $this->input->post('url');
			redirect(''.$url.'');
			
		}
	}

	private function _session_registered($row) {
        // 1. Daftarkan Session
        $data_ses = array(
			'admin_id' 	=>	$row->admin_id,
			'admin_name' =>	$row->admin_name,
			'username' 	=>	$row->username,
			'admin_email' => $row->admin_email
		);
        $this->session->set_userdata($data_ses);
    }
	
	public function logout(){
		
		$option_login_validation = $this->Mainmodel->GetOptions('web_admin_validation')->option_value;
		$this->session->sess_destroy();
		delete_cookie($option_login_validation);
		redirect('adm/main');
		
	}
}