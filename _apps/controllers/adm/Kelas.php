<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Kelasmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		//get title
		if($this->input->get('nama')):
			$data['nama'] = $nama = $this->input->get('nama');
		else:
			$data['nama'] = $nama = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "nama=".$nama."&search=";

        //total data
		$data['total_data'] = $total_data = $this->Kelasmodel->total_data($nama);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/kelas/?'.$get_search;
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

		$data['kelas'] = $this->Kelasmodel->GetData($config['per_page'],$page,$nama);

		$data['page_title'] = "Data Semua Kelas";
		$template = '/backend/content/kelas';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{

		$data['wali_kelas'] = $this->Kelasmodel->GetAllGuru();

		$data['page_title'] = "Form Tambah Kelas";
		$template = '/backend/content/kelas_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== add save ============================ //
	public function add_save()
	{
			
		$data = array(
			"kelas_nama" => $this->input->post('kelas_nama'),
			"kelas_ket" => $this->input->post('kelas_ket'),
			"wali_kelas" => $this->input->post('wali_kelas'),
			"kelas_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Kelasmodel->insert_db("tbl_kelas",$data);
		
		if($insert)
		{
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kelas');
			
		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kelas');
			
		}
	}

	public function edit()
	{
		$data['kelas'] = $this->Kelasmodel->GetAllKelas();

		if (!is_numeric($this->uri->segment(4)))
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di edit.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kelas');
			
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Kelasmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/kelas');
                    
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/kelas');
                
            }
        }

		$kelas_id = $this->uri->segment(4);
		$data['view_kelas'] = $view_kelas = $this->Kelasmodel->Detail($kelas_id)->row();

        $data['wali_kelas'] = $wali_kelas = $this->Kelasmodel->GetAllGuru();

		//$data['kelas'] = $this->Toursmodel->GetAll("2","5");

		$data['page_title'] = "Edit - ".$view_kelas->kelas_nama;
		$template = '/backend/content/kelas_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== Edit save ============================ //
	public function edit_save()
	{

		$data = array(
			"kelas_nama" => $this->input->post('kelas_nama'),
			"kelas_ket" => $this->input->post('kelas_ket'),
			"wali_kelas" => $this->input->post('wali_kelas')
		);
		
		$kelas_id = $this->input->post('kelas_id');
		$update = $this->Kelasmodel->update_db("tbl_kelas","kelas_id",$kelas_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kelas');
			
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kelas');
			
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
            redirect('adm/kelas');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Kelasmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/kelas');
	                
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/kelas');
                
            }
        }

		$view_kelas = $this->Kelasmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Kelasmodel->delete_db('tbl_kelas','kelas_id',$this->uri->segment(4));
		if($delete)
		{			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/kelas');
            
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/kelas');
            
		}
    }
}
