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

class Tes extends S_UserController
{

	public function __construct()
	{
        parent::__construct();
        $this->load->library('pagination');
		$this->load->library('form_validation');

		//model
		$this->load->model('main/Mainmodel');
		$this->load->model('main/Usersmodel');
		$this->load->model('main/Tesmodel');

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

		//cek jawaban
		$cek_jawaban = $this->Tesmodel->CekJawaban($view_user->user_id)->result();
		$view_jawaban = $this->Tesmodel->CekJawaban($view_user->user_id)->row();
		if($cek_jawaban)
		{
			$soal_id = $view_jawaban->soal_id+1;
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
		}
		else
		{
			$soal_id = "1";
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
		}

		//cek sesi
		$cek_sesi = $this->Tesmodel->CekSesi($view_user->user_id)->result();
		$view_sesi = $this->Tesmodel->CekSesi($view_user->user_id)->row();
		if($cek_sesi)
		{
			$data['jawaban_sesi'] = $view_sesi->jawaban_sesi+1;
		}
		else
		{
			$data['jawaban_sesi'] = "1";
		}

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Uji Kepribadian - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/tes';
		$this->template_frontend->display($template, $data);
	}

	// =========== tes save ============================ //
	public function tes_save()
	{

		$user_id = $this->session->userdata('user_id');

		if($this->input->post('soal_id') != "40")
		{

			$data = array(
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $this->input->post('jawaban_nilai'),
				"jawaban_status" => "0",
				"jawaban_created" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Tesmodel->insert_db("tbl_jawaban",$data);
			
			if($insert)
			{
				redirect('tes');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('tes');
			}

		}
		else
		{

			$data = array(
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $this->input->post('jawaban_nilai'),
				"jawaban_status" => "0",
				"jawaban_created" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Tesmodel->insert_db("tbl_jawaban",$data);
			
			if($insert)
			{
				//update status
				$data = array(
					"jawaban_status" => "1"
				);				
				$update = $this->Tesmodel->update_jawaban_status($user_id,$data);
				if($update)
				{

					//tes penilaian
					$sesi = $this->input->post('jawaban_sesi');
					$view_by_penilaian = $this->Tesmodel->LihatByJawabanNilai($sesi,$user_id,$limit="2")->result();

					$kepribadian_id_1 = $view_by_penilaian["0"]->jawaban_nilai;
					$kepribadian_id_2 = $view_by_penilaian["1"]->jawaban_nilai;

					$data = array(
						"user_id" => $user_id,
						"penilaian_sesi" => $sesi,
						"kepribadian_id_1" => $kepribadian_id_1,
						"kepribadian_id_2" => $kepribadian_id_2,
						"penilaian_created" => date("Y-m-d H:i:s")
					);

					$insert = $this->Tesmodel->insert_db("tbl_penilaian",$data);

				}
				
				$sesi = $this->input->post('jawaban_sesi');
				redirect('tes/hasil?sesi='.$sesi.'');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('tes');
			}
		}
	}

	public function hasil()
	{

		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		//view sesi
		$sesi = $this->input->get('sesi');

		//detail by total nilai
		$data['view_total_nilai'] = $this->Tesmodel->LihatByJawabanNilai($sesi,$user,$limit="2")->result();

		//detail penilaian
		$data['view_penilaian'] = $view_penilaian = $this->Tesmodel->DetailPenilaian($sesi,$user)->row();
		$data['view_kepribadian_1'] = $view_kepribadian_1 = $this->Tesmodel->DetailKepribadian($view_penilaian->kepribadian_id_1)->row();
		$data['view_kepribadian_2'] = $view_kepribadian_2 = $this->Tesmodel->DetailKepribadian($view_penilaian->kepribadian_id_2)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Hasil Uji Kepribadian - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/hasil';
		$this->template_frontend->display($template, $data);
	}

}
