<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Courses extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Coursesmodel');
		$this->load->model('adm/Soalmodel');
        date_default_timezone_set("Asia/Jakarta");
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
		$config['base_url'] = base_url().'adm/courses/?'.$get_search;
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

		$data['course'] = $this->Coursesmodel->GetData($config['per_page'],$page,$title);

		$data['page_title'] = "Data Semua Courses";
		$template = '/backend/content/courses';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{

		$data['page_title'] = "Tambah Courses";
		$template = '/backend/content/course_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== add save ============================ //
	public function add_save()
	{

		//save img
		if($_FILES['course_img']['name'] == "")
		{
			$course_img = "";
		}
		else
		{			
			//upload gambar
			$ext = explode(".",$_FILES['course_img']['name']);
			$ext = end($ext);
			$course_img = 'COURSE-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//img medium
			$img_config['max_size'] = '10000';
			$img_config['upload_path'] = './_images/_courses/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $course_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadmedium');  // Create custom object
		    $this->uploadmedium->initialize($img_config);
		    $upload_medium = $this->uploadmedium->do_upload('course_img');
			
			if(!$upload_medium)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 10MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/courses');
			}
			else
			{
				$img = $this->uploadmedium->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $course_img,
					'height' => '800',
					'width' => '800',
					'quality' => '70'
				);
				$this->load->library('image_lib',$c_img_lib,'resizemedium');
				if(!$this->resizemedium->resize())
				{
					echo $this->resizemedium->display_errors();
				}
			}
		}

		//*save pdf
		if($_FILES['course_pdf']['name'] == "")
		{
			$course_pdf = "";
		}
		else
		{			
			//upload pdf
			$ext = explode(".",$_FILES['course_pdf']['name']);
			$ext = end($ext);
			$course_pdf = 'COURSE-PDF-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//pdf
			$pdf_config['max_size'] = '100000';
			$pdf_config['upload_path'] = './_images/_pdf/';
			$pdf_config['remove_spaces'] = true;
			$pdf_config['file_name'] = $course_pdf;
			$pdf_config['allowed_types'] = 'pdf';

			$this->load->library('upload', $pdf_config, 'upload_pdf');  // Create custom object
		    $this->upload_pdf->initialize($pdf_config);
		    $upload = $this->upload_pdf->do_upload('course_pdf');
			
			if(!$upload)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, File PDF Tidak Boleh lebih dari 100MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/courses');
			}
			else
			{
				//success
			}
		}
		//*//

		$data = array(
			"course_title" => $this->input->post('course_title'),
			"course_img" => $course_img,
			"course_pdf" => $course_pdf,
			"course_desc" => $this->input->post('course_desc'),
			"course_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Coursesmodel->insert_db("tbl_courses",$data);

		if($insert)
		{

			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Menambah Dta.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses');			

		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal, Coba Ulangi lagi.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses');			
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
            redirect('adm/courses');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

		$course_id = $this->uri->segment(4);
		$view_courses = $this->Coursesmodel->Detail($course_id)->row();

        $data['view_courses'] = $view_courses;

		$data['page_title'] = "Edit - ".$view_courses->course_title;
		$template = '/backend/content/course_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function edit_save()
	{

		//course img old
		$course_img_old = $this->input->post('course_img_old');

		if($_FILES['course_img']['name'] == "")
		{
			$course_img = $course_img_old;
		}
		else
		{			
			//upload gambar
			$ext = explode(".",$_FILES['course_img']['name']);
			$ext = end($ext);
			$course_img = 'COURSE-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//img medium
			$img_config['max_size'] = '2000';
			$img_config['upload_path'] = './_images/_courses/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $course_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadmedium');  // Create custom object
		    $this->uploadmedium->initialize($img_config);
		    $upload_medium = $this->uploadmedium->do_upload('course_img');
			
			if(!$upload_medium)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 2MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/courses');
			}
			else
			{
				$img = $this->uploadmedium->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $course_img,
					'height' => '800',
					'width' => '800',
					'quality' => '70'
				);
				$this->load->library('image_lib',$c_img_lib,'resizemedium');
				if(!$this->resizemedium->resize())
				{
					echo $this->resizemedium->display_errors();
				}
				//jika ada gambar lama, maka hapus
				if($course_img_old != "") unlink('./_images/_courses/'.$course_img_old.'');
			}
		}

		//course img old
		$course_pdf_old = $this->input->post('course_pdf_old');

		//*save pdf
		if($_FILES['course_pdf']['name'] == "")
		{
			$course_pdf = $course_pdf_old;
		}
		else
		{			
			//upload pdf
			$ext = explode(".",$_FILES['course_pdf']['name']);
			$ext = end($ext);
			$course_pdf = 'COURSE-PDF-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//pdf
			$pdf_config['max_size'] = '10000';
			$pdf_config['upload_path'] = './_images/_pdf/';
			$pdf_config['remove_spaces'] = true;
			$pdf_config['file_name'] = $course_pdf;
			$pdf_config['allowed_types'] = 'pdf';

			$this->load->library('upload', $pdf_config, 'upload_pdf');  // Create custom object
		    $this->upload_pdf->initialize($pdf_config);
		    $upload = $this->upload_pdf->do_upload('course_pdf');
			
			if(!$upload)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Edit Data, File PDF Tidak Boleh lebih dari 10MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('adm/courses');
			}
			else
			{
				//jika ada pdf lama, maka hapus
				if($course_pdf_old != "") unlink('./_images/_pdf/'.$course_pdf_old.'');
			}
		}
		//*//

		$data = array(
			"course_title" => $this->input->post('course_title'),
			"course_img" => $course_img,
			"course_pdf" => $course_pdf,
			"course_desc" => $this->input->post('course_desc')
		);
		
		$course_id = $this->input->post('course_id');
		$update = $this->Coursesmodel->update_db("tbl_courses","course_id",$course_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses');			
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

	// ========================= delete =================== //
	public function delete(){
			
		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di Hapus..'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses');            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/courses');	                
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/courses');                
            }
        }

		$view_courses = $this->Coursesmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Mainmodel->delete_db('tbl_courses','course_id',$this->uri->segment(4));
		if($delete)
		{

			//delete gambar
			if($view_courses->course_img != "") unlink('./_images/_courses/'.$view_courses->course_img.'');
			//delete soal+jawaban+penilaian
			$delete_soal = $this->Mainmodel->delete_db('tbl_soal','course_id',$this->uri->segment(4));
			$delete_jawaban = $this->Mainmodel->delete_db('tbl_jawaban','course_id',$this->uri->segment(4));
			$delete_penilaian = $this->Mainmodel->delete_db('tbl_penilaian','course_id',$this->uri->segment(4));
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses');            
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses');            
		}
    }

    //soal daftar course
    public function soal()
	{

		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang ditampilkan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang ditampilkan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/courses');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang ditampilkan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                echo '<script>window.history.back();</script>';
                
            }
        }

		//get source
		$course_id = $this->uri->segment(4);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		$data['soal'] = $this->Coursesmodel->GetAllSoal($course_id);

		$data['page_title'] = "Data Semua Soal - ".$view_courses->course_title;
		$template = '/backend/content/course_soal';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	//soal add course
    public function soal_add()
	{

		$course_id = $this->uri->segment(4);

		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang ditampilkan.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses/soal/'.$course_id.'');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Coursesmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang ditampilkan.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/courses/soal/'.$course_id.'');
                    
                }
            }
            else
            {
            	$array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang ditampilkan.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/courses/soal/'.$course_id.'');
                
            }
        }

		//get source
		$course_id = $this->uri->segment(4);
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		$data['soal'] = $this->Coursesmodel->GetAllSoal($course_id);

		$data['page_title'] = "Data Semua Soal - ".$view_courses->course_title;
		$template = '/backend/content/course_soal_add';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== add save ============================ //
	public function soal_add_save()
	{

		$course_id = $this->input->post('course_id');

		//cek no urut soal
		$cek_add_soal = $this->Coursesmodel->CekAddSoal($course_id)->result();
		$view_soal = $this->Coursesmodel->CekAddSoal($course_id)->row();
		if($cek_add_soal)
		{
			$soal_no = $view_soal->soal_no+1;
		}
		else
		{
			$soal_no = "1";
		}
			
		$data = array(
			"course_id" => $course_id,
			"soal_text" => $this->input->post('soal_text'),
			"soal_no" => $soal_no,
			"soal_jawaban_a" => $this->input->post('soal_jawaban_a'),
			"soal_jawaban_b" => $this->input->post('soal_jawaban_b'),
			"soal_jawaban_c" => $this->input->post('soal_jawaban_c'),
			"soal_jawaban_d" => $this->input->post('soal_jawaban_d'),
			"soal_jawaban_e" => $this->input->post('soal_jawaban_e'),
			"soal_jawaban_benar" => $this->input->post('soal_jawaban_benar'),
			"soal_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Coursesmodel->insert_db("tbl_soal",$data);
		
		if($insert)
		{
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses/soal/'.$course_id.'');
			
		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses/soal/'.$course_id.'');
		}
	}

	public function soal_edit()
	{
		$soal_id = $this->uri->segment(4);
		$view_soal = $this->Coursesmodel->DetailSoal($soal_id)->row();

		//get source
		$course_id = $view_soal->course_id;
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();

		if (!is_numeric($this->uri->segment(4)))
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di edit.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses/soal/'.$course_id.'');
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Coursesmodel->DetailSoal($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/courses/soal/'.$course_id.'');
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/courses/soal/'.$course_id.'');
            }
        }

		$soal_id = $this->uri->segment(4);
		$data['view_soal'] = $view_soal = $this->Coursesmodel->DetailSoal($soal_id)->row();

		$data['page_title'] = "Edit - ".$view_soal->soal_text;
		$template = '/backend/content/course_soal_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== Edit save ============================ //
	public function soal_edit_save()
	{

		$course_id = $this->input->post('course_id');

		$data = array(
			"soal_text" => $this->input->post('soal_text'),
			"soal_jawaban_a" => $this->input->post('soal_jawaban_a'),
			"soal_jawaban_b" => $this->input->post('soal_jawaban_b'),
			"soal_jawaban_c" => $this->input->post('soal_jawaban_c'),
			"soal_jawaban_d" => $this->input->post('soal_jawaban_d'),
			"soal_jawaban_e" => $this->input->post('soal_jawaban_e'),
			"soal_jawaban_benar" => $this->input->post('soal_jawaban_benar')
		);
		
		$soal_id = $this->input->post('soal_id');
		$update = $this->Coursesmodel->update_db("tbl_soal","soal_id",$soal_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses/soal/'.$course_id.'');
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/courses/soal/'.$course_id.'');
		}
	}

	// ========================= delete =================== //
	public function soal_delete()
	{

		$soal_id = $this->uri->segment(4);
		$view_soal = $this->Coursesmodel->DetailSoal($soal_id)->row();

		//get source
		$course_id = $view_soal->course_id;
		$data['view_courses'] = $view_courses = $this->Coursesmodel->Detail($course_id)->row();
			
		if (!is_numeric($this->uri->segment(4)))
        {
            $array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada Soal yang akan di Hapus..'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses/soal/'.$course_id.'');
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Soalmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada Soal yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/courses/soal/'.$course_id.'');
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada Soal yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
            	redirect('adm/courses/soal/'.$course_id.'');
            }
        }

		$view_soal = $this->Soalmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Coursesmodel->delete_db('tbl_soal','soal_id',$this->uri->segment(4));
		if($delete)
		{			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Soal.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses/soal/'.$course_id.'');
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus SOal.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/courses/soal/'.$course_id.'');
		}
    }

}
