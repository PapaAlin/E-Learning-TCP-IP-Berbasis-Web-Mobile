<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Soal extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Soalmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		//get title
		if($this->input->get('text')):
			$data['text'] = $text = $this->input->get('text');
		else:
			$data['text'] = $text = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "text=".$text."&search=";

        //total data
		$data['total_data'] = $total_data = $this->Soalmodel->total_data($text);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/soal/?'.$get_search;
		$config['total_rows'] = $total_data;
		$config['per_page'] = 20;
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

		$data['soal'] = $this->Soalmodel->GetData($config['per_page'],$page,$text);

		$data['page_title'] = "Data Semua Soal";
		$template = '/backend/content/soal';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{

		$data['page_title'] = "Form Tambah Soal";
		$template = '/backend/content/soal_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== add save ============================ //
	public function add_save()
	{
			
		$data = array(
			"soal_text" => $this->input->post('soal_text'),
			"soal_jawaban_a" => $this->input->post('soal_jawaban_a'),
			"soal_a_nilai" => $this->input->post('soal_a_nilai'),
			"soal_jawaban_b" => $this->input->post('soal_jawaban_b'),
			"soal_b_nilai" => $this->input->post('soal_b_nilai'),
			"soal_jawaban_c" => $this->input->post('soal_jawaban_c'),
			"soal_c_nilai" => $this->input->post('soal_c_nilai'),
			"soal_jawaban_d" => $this->input->post('soal_jawaban_d'),
			"soal_d_nilai" => $this->input->post('soal_d_nilai'),
			"soal_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Soalmodel->insert_db("tbl_soal",$data);
		
		if($insert)
		{
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/soal');
			
		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/soal');
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
			redirect('adm/soal');
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Soalmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/soal');
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/soal');
            }
        }

		$soal_id = $this->uri->segment(4);
		$data['view_soal'] = $view_soal = $this->Soalmodel->Detail($soal_id)->row();

		$data['page_title'] = "Edit - ".$view_soal->soal_text;
		$template = '/backend/content/soal_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== Edit save ============================ //
	public function edit_save()
	{

		$data = array(
			"soal_text" => $this->input->post('soal_text'),
			"soal_jawaban_a" => $this->input->post('soal_jawaban_a'),
			"soal_a_nilai" => $this->input->post('soal_a_nilai'),
			"soal_jawaban_b" => $this->input->post('soal_jawaban_b'),
			"soal_b_nilai" => $this->input->post('soal_b_nilai'),
			"soal_jawaban_c" => $this->input->post('soal_jawaban_c'),
			"soal_c_nilai" => $this->input->post('soal_c_nilai'),
			"soal_jawaban_d" => $this->input->post('soal_jawaban_d'),
			"soal_d_nilai" => $this->input->post('soal_d_nilai')
		);
		
		$soal_id = $this->input->post('soal_id');
		$update = $this->Soalmodel->update_db("tbl_soal","soal_id",$soal_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/soal');
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/soal');
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
            redirect('adm/soal');
        }
        else if($this->Soalmodel->DetailPenilaian($this->uri->segment(4))->num_rows() == "1")
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Soal sudah ada kegiatan penilaian, tidak dapat dihapus, Atau hapus dulu proses penilaian'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/soal');
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Soalmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/soal');
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/soal');
            }
        }

		$view_soal = $this->Soalmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Soalmodel->delete_db('tbl_soal','soal_id',$this->uri->segment(4));
		if($delete)
		{			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/soal');
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/soal');
		}
    }
}
