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

class Courses extends S_UserController
{

	public function __construct()
	{
        parent::__construct();
        $this->load->library('pagination');
		$this->load->library('form_validation');

		//model
		$this->load->model('main/Mainmodel');
		$this->load->model('main/Usersmodel');
		$this->load->model('main/Coursesmodel');
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

		//get name
		if($this->input->get('title')):
			$data['get_title'] = $title = $this->input->get('title');
		else:
			$data['get_title'] = $title = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "&title=".$title."&search=";

        //total data
		$data['total_data'] = $total_data = $this->Coursesmodel->total_data($title);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'courses/?'.$get_search;
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

		$data['courses'] = $this->Coursesmodel->GetData($config['per_page'],$page,$title);

		//get user
		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		//get user
		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Courses - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/courses';
		$this->template_frontend->display($template, $data);
	}

	public function detail()
	{
		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

		$course_id = $this->uri->segment(3);
		$view_courses = $this->Coursesmodel->Detail($course_id)->row();

        $data['view_courses'] = $view_courses;
		$data['page_title'] = "Detail - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/course_menu';
		$this->template_frontend->display($template, $data);
	}

	public function detailmateri()
	{
		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

		$course_id = $this->uri->segment(3);
		$view_courses = $this->Coursesmodel->Detail($course_id)->row();

        $data['view_courses'] = $view_courses;
		$data['page_title'] = "Detail - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/course_detailmateri';
		$this->template_frontend->display($template, $data);
	}

	public function detailpdf()
	{
		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

		$course_id = $this->uri->segment(3);
		$view_courses = $this->Coursesmodel->Detail($course_id)->row();

        $data['view_courses'] = $view_courses;
		$data['page_title'] = "Detail PDF - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/course_detailpdf';
		$this->template_frontend->display($template, $data);
	}

	public function pretest_start()
	{

		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

        //view course
		$course_id = $this->uri->segment(3);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user_id = $this->session->userdata('user_id');
		$this->_get_user($user_id);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user_id)->row();

		//view penilaian
		$data['penilaian'] = $penilaian = $this->Tesmodel->GetPenilaian($user_id,$course_id,'pretest');

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Pretest Start - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/pretest_start';
		$this->template_frontend->display($template, $data);
	}

	public function pretest()
	{

		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

        //view course
		$course_id = $this->uri->segment(3);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		//cek jawaban
		$cek_jawaban_pretest = $this->Tesmodel->CekJawabanPretest($view_user->user_id,$course_id)->result();
		$view_jawaban_pretest = $this->Tesmodel->CekJawabanPretest($view_user->user_id,$course_id)->row();
		if($cek_jawaban_pretest)
		{
			$view_soal_by_old = $this->Tesmodel->DetailSoal($$view_jawaban_pretest->soal_id)->row();
			$soal_no = $view_soal_by_old->soal_no+1;
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoalByNoUrut($course_id,$soal_no)->row();
		}
		else
		{
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoalByNoUrut($course_id,'1')->row();
		}

		//cek sesi
		$cek_sesi_pretest = $this->Tesmodel->CekSesiPretest($view_user->user_id,$course_id)->result();
		$view_sesi_pretest = $this->Tesmodel->CekSesiPretest($view_user->user_id,$course_id)->row();
		if($cek_sesi_pretest)
		{
			$data['jawaban_sesi'] = $view_sesi_pretest->jawaban_sesi+1;
		}
		else
		{
			$data['jawaban_sesi'] = "1";
		}

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Pretest - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/pretest';
		$this->template_frontend->display($template, $data);
	}

	// =========== tes save ============================ //
	public function pretest_save()
	{

		$course_id = $this->input->post('course_id');
		$post_jawaban_nilai = $this->input->post('jawaban_nilai');
		$user_id = $this->session->userdata('user_id');

		if($this->input->post('soal_no') != "5")
		{

			//pengecekan jawaban benar
			$soal_id = $this->input->post('soal_id');
			$view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
			if($post_jawaban_nilai == $view_soal->soal_jawaban_benar)
			{
				$jawaban_nilai = "benar";
			}
			else
			{
				$jawaban_nilai = "salah";
			}

			$data = array(
				"course_id" => $this->input->post('course_id'),
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"jawaban_type" => $this->input->post('jawaban_type'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $jawaban_nilai,
				"jawaban_status" => "0",
				"jawaban_created" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Tesmodel->insert_db("tbl_jawaban",$data);
			
			if($insert)
			{
				redirect('courses/pretest/'.$course_id.'');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('courses/pretest/'.$course_id.'');
			}

		}
		else
		{

			//pengecekan jawaban benar
			$soal_id = $this->input->post('soal_id');
			$view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
			if($post_jawaban_nilai == $view_soal->soal_jawaban_benar)
			{
				$jawaban_nilai = "benar";
			}
			else
			{
				$jawaban_nilai = "salah";
			}

			$data = array(
				"course_id" => $this->input->post('course_id'),
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"jawaban_type" => $this->input->post('jawaban_type'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $jawaban_nilai,
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
					$penilaian_benar = $this->Tesmodel->LihatByJawabanNilai('benar','pretest',$sesi,$user_id,$course_id)->num_rows();
					$penilaian_salah = $this->Tesmodel->LihatByJawabanNilai('salah','pretest',$sesi,$user_id,$course_id)->num_rows();

					$data = array(
						"user_id" => $user_id,
						"course_id" => $course_id,
						"penilaian_type" => "pretest",
						"penilaian_sesi" => $sesi,
						"penilaian_benar" => $penilaian_benar,
						"penilaian_salah" => $penilaian_salah,
						"penilaian_created" => date("Y-m-d H:i:s")
					);

					$insert = $this->Tesmodel->insert_db("tbl_penilaian",$data);

				}
				
				$sesi = $this->input->post('jawaban_sesi');
				redirect('courses/pretest_hasil?sesi='.$sesi.'&type=pretest&user_id='.$user_id.'&course_id='.$course_id.'');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('courses/detail/'.$course_id.'');
			}
		}
	}

	public function pretest_hasil()
	{
		$user_id = $this->input->get('user_id');
		$course_id = $this->input->get('course_id');
		$penilaian_type = $this->input->get('type');
		$penilaian_sesi = $this->input->get('sesi');

		/*
		if($user_id != "" && $course_id != "" && $penilaian_type != "" && $penilaian_sesi != "" )
        {
            if($this->Coursesmodel->DetailPenilaian($user_id,$course_id,$penilaian_type,$penilaian_sesi)->num_rows() == "0")
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('courses');
                
            }
        }
        else
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('courses');
            
        }
        */

        //view penilaian
		$data['view_penilaian'] = $view_penilaian = $this->Tesmodel->DetailPenilaian($user_id,$course_id,$penilaian_type,$penilaian_sesi)->row();

        //view course
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Pretest - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/pretest_hasil';
		$this->template_frontend->display($template, $data);
	}

	public function posttest_start()
	{

		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

        //view course
		$course_id = $this->uri->segment(3);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user_id = $this->session->userdata('user_id');
		$this->_get_user($user_id);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user_id)->row();

		//view penilaian
		$data['penilaian'] = $penilaian = $this->Tesmodel->GetPenilaian($user_id,$course_id,'posttest');

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Posttest Start - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/posttest_start';
		$this->template_frontend->display($template, $data);
	}

	public function posttest()
	{

		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

        //view course
		$course_id = $this->uri->segment(3);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		//cek jawaban
		$cek_jawaban_posttest = $this->Tesmodel->CekJawabanPosttest($view_user->user_id,$course_id)->result();
		$view_jawaban_posttest = $this->Tesmodel->CekJawabanPosttest($view_user->user_id,$course_id)->row();
		if($cek_jawaban_posttest)
		{
			$view_soal_by_old = $this->Tesmodel->DetailSoal($view_jawaban_posttest->soal_id)->row();
			$soal_no = $view_soal_by_old->soal_no+1;
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoalByNoUrut($course_id,$soal_no)->row();
		}
		else
		{
			$data['view_soal'] = $view_soal = $this->Tesmodel->DetailSoalByNoUrut($course_id,'1')->row();
		}

		//cek sesi posttest
		$cek_sesi_posttest = $this->Tesmodel->CekSesiPosttest($view_user->user_id,$course_id)->result();
		$view_sesi_posttest = $this->Tesmodel->CekSesiPosttest($view_user->user_id,$course_id)->row();
		if($cek_sesi_posttest)
		{
			$data['jawaban_sesi'] = $view_sesi_posttest->jawaban_sesi+1;
		}
		else
		{
			$data['jawaban_sesi'] = "1";
		}

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Posttest - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/posttest';
		$this->template_frontend->display($template, $data);
	}

	// =========== tes save ============================ //
	public function posttest_save()
	{

		$course_id = $this->input->post('course_id');
		$post_jawaban_nilai = $this->input->post('jawaban_nilai');
		$user_id = $this->session->userdata('user_id');

		if($this->input->post('soal_no') != "10")
		{

			//pengecekan jawaban benar
			$soal_id = $this->input->post('soal_id');
			$view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
			if($post_jawaban_nilai == $view_soal->soal_jawaban_benar)
			{
				$jawaban_nilai = "benar";
			}
			else
			{
				$jawaban_nilai = "salah";
			}

			$data = array(
				"course_id" => $this->input->post('course_id'),
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"jawaban_type" => $this->input->post('jawaban_type'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $jawaban_nilai,
				"jawaban_status" => "0",
				"jawaban_created" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Tesmodel->insert_db("tbl_jawaban",$data);
			
			if($insert)
			{
				redirect('courses/posttest/'.$course_id.'');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('courses/posttest/'.$course_id.'');
			}

		}
		else
		{

			//pengecekan jawaban benar
			$soal_id = $this->input->post('soal_id');
			$view_soal = $this->Tesmodel->DetailSoal($soal_id)->row();
			if($post_jawaban_nilai == $view_soal->soal_jawaban_benar)
			{
				$jawaban_nilai = "benar";
			}
			else
			{
				$jawaban_nilai = "salah";
			}

			$data = array(
				"course_id" => $this->input->post('course_id'),
				"jawaban_sesi" => $this->input->post('jawaban_sesi'),
				"jawaban_type" => $this->input->post('jawaban_type'),
				"user_id" => $user_id,
				"soal_id" => $this->input->post('soal_id'),
				"jawaban_nilai" => $jawaban_nilai,
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
					$penilaian_benar = $this->Tesmodel->LihatByJawabanNilai('benar','posttest',$sesi,$user_id,$course_id)->num_rows();
					$penilaian_salah = $this->Tesmodel->LihatByJawabanNilai('salah','posttest',$sesi,$user_id,$course_id)->num_rows();

					$data = array(
						"user_id" => $user_id,
						"course_id" => $course_id,
						"penilaian_type" => "posttest",
						"penilaian_sesi" => $sesi,
						"penilaian_benar" => $penilaian_benar,
						"penilaian_salah" => $penilaian_salah,
						"penilaian_created" => date("Y-m-d H:i:s")
					);

					$insert = $this->Tesmodel->insert_db("tbl_penilaian",$data);

				}
				
				$sesi = $this->input->post('jawaban_sesi');
				redirect('courses/posttest_hasil?sesi='.$sesi.'&type=posttest&user_id='.$user_id.'&course_id='.$course_id.'');
			}
			else
			{
				
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('courses/detail/'.$course_id.'');
			}
		}
	}

	public function posttest_hasil()
	{
		$user_id = $this->input->get('user_id');
		$course_id = $this->input->get('course_id');
		$penilaian_type = $this->input->get('type');
		$penilaian_sesi = $this->input->get('sesi');

		/*
		if($user_id != "" && $course_id != "" && $penilaian_type != "" && $penilaian_sesi != "" )
        {
            if($this->Coursesmodel->DetailPenilaian($user_id,$course_id,$penilaian_type,$penilaian_sesi)->num_rows() == "0")
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('courses');
                
            }
        }
        else
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('courses');
            
        }
        */

        //view penilaian
		$data['view_penilaian'] = $view_penilaian = $this->Tesmodel->DetailPenilaian($user_id,$course_id,$penilaian_type,$penilaian_sesi)->row();

        //view course
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user = $this->session->userdata('user_id');
		$this->_get_user($user);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user)->row();

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Post Test Hasil - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/posttest_hasil';
		$this->template_frontend->display($template, $data);
	}

	public function hasil()
	{

		if (!is_numeric($this->uri->segment(3)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Data Tidak di temukan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('courses');
            
        }
        else
        {
            if($this->uri->segment(3) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(3))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Data Tidak di temukan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Data Tidak di temukan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

        //view course
		$course_id = $this->uri->segment(3);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		//view user 
		$user_id = $this->session->userdata('user_id');
		$this->_get_user($user_id);
		$data['view_user'] = $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$user_id)->row();

		//view penilaian
		$data['penilaian'] = $penilaian = $this->Tesmodel->GetPenilaian($user_id,$course_id,'posttest');
		$data['penilaian_pretest'] = $penilaian_pretest = $this->Tesmodel->GetPenilaian($user_id,$course_id,'pretest');

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Courses Result - ".$view_courses->course_title;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$url = $this->ambil_url->ambilurl();
		$data['url'] = $this->input->get('url');
		
		$template = '/frontend/content/course_hasil';
		$this->template_frontend->display($template, $data);
	}

}
