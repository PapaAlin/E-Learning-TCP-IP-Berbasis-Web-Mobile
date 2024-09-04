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

class S_UserController extends CI_Controller {
    
    
    
    public function __construct(){
        parent::__construct();

        //database
        $this->load->model('main/Mainmodel');
        $this->load->model('main/Usersmodel');
        // Memanggil library Admin_Class_menu
        $this->load->library('Class_menu');
        
        //cek cookie admin_id
        $option_login_validation = $this->Mainmodel->GetOptions('web_user_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        $user = $this->session->userdata('user_id');
        if($user)
        {
            //login sukses
            //
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
                //
            }
            else
            {
                //not create session
                $this->session->sess_destroy();
                delete_cookie($option_login_validation);
                //
            }
        }
        else
        {
            //not create session
            $this->session->sess_destroy();
            delete_cookie($option_login_validation);
            //
        }
    }

}

class S_AdmController extends CI_Controller {
    
    
	
    public function __construct(){
        parent::__construct();

        // Memanggil library template frontend
        $this->load->library('Template_backend');
        // Memanggil library Admin_Class_menu
        $this->load->library('Admin_Class_menu');
        //database
        $this->load->model('adm/Mainmodel');
        $this->load->model('adm/Penilaianmodel');
        
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
                // 1. Daftarkan Session
                $data_ses = array(
                    'admin_id'  =>  $row->admin_id,
                    'admin_name' => $row->admin_name,
                    'username'  =>  $row->username,
                    'admin_email' => $row->admin_email
                );
                $this->session->set_userdata($data_ses);
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
    }

}