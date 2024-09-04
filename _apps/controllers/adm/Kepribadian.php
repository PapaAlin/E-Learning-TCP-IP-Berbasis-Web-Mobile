<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kepribadian extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Kepribadianmodel');
        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		//get name
		if($this->input->get('nama')):
			$data['get_nama'] = $nama = $this->input->get('nama');
		else:
			$data['get_nama'] = $nama = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "&nama=".$nama."&search=";

        //total data
		$data['total_data'] = $total_data = $this->Kepribadianmodel->total_data($nama);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/kepribadian/?'.$get_search;
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

		$data['kepribadian'] = $this->Kepribadianmodel->GetData($config['per_page'],$page,$nama);

		$data['page_title'] = "Data Semua Kepribadian";
		$template = '/backend/content/kepribadian';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{

		$data['page_title'] = "Tambah Kepribadian";
		$template = '/backend/content/kepribadian_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function add_save()
	{

		$data = array(
			"kepribadian_nama" => $this->input->post('kepribadian_nama'),
			"kepribadian_kekuatan" => $this->input->post('kepribadian_kekuatan'),
			"kepribadian_kelemahan" => $this->input->post('kepribadian_kelemahan'),
			"kepribadian_ket" => $this->input->post('kepribadian_ket'),
			"kepribadian_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Kepribadianmodel->insert_db("tbl_kepribadian",$data);

		if($insert)
		{

			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Menambah Dta.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kepribadian');			

		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal, Coba Ulangi lagi.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kepribadian');			
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
            redirect('adm/kepribadian');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Kepribadianmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/kepribadian');
                    
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

		$kepribadian_id = $this->uri->segment(4);
		$view_kepribadian = $this->Kepribadianmodel->Detail($kepribadian_id)->row();

        $data['view_kepribadian'] = $view_kepribadian;

		$data['page_title'] = "Edit - ".$view_kepribadian->kepribadian_nama;
		$template = '/backend/content/kepribadian_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== edit save ============================ //
	public function edit_save()
	{

		$data = array(
			"kepribadian_nama" => $this->input->post('kepribadian_nama'),
			"kepribadian_kekuatan" => $this->input->post('kepribadian_kekuatan'),
			"kepribadian_kelemahan" => $this->input->post('kepribadian_kelemahan'),
			"kepribadian_ket" => $this->input->post('kepribadian_ket')
		);
		
		$kepribadian_id = $this->input->post('kepribadian_id');
		$update = $this->Kepribadianmodel->update_db("tbl_kepribadian","kepribadian_id",$kepribadian_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/kepribadian');			
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
            redirect('adm/kepribadian');            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Kepribadianmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/kepribadian');	                
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/kepribadian');                
            }
        }

		$delete = $this->Mainmodel->delete_db('tbl_kepribadian','kepribadian_id',$this->uri->segment(4));
		if($delete)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/kepribadian');            
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/kepribadian');            
		}
    }

}
