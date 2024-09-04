<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Penilaian extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Penilaianmodel');
		$this->load->model('main/Tesmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		//wali_kelas
		$wali_kelas = $this->session->userdata('admin_id');

		//get title
		if($this->input->get('user_id')):
			$data['user_id'] = $user_id = $this->input->get('user_id');
		else:
			$data['user_id'] = $user_id = "";
		endif;

		//get page
		$page = $this->input->get('per_page');
		if(!$page):
           $offset = 0;
        else:
           $offset = $page;
        endif;

        //get url search
        $get_search = "user_id=".$user_id."&search=";

        //total data
        $data['total_data'] = $total_data = $this->Penilaianmodel->total_data($user_id);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/penilaian/?'.$get_search;
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

		$data['penilaian'] = $this->Penilaianmodel->GetData($config['per_page'],$page,$user_id);

		$data['page_title'] = "Data Semua Penilaian";
		$template = '/backend/content/penilaian';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function detail()
	{
		if (!is_numeric($this->uri->segment(4)))
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di lihat.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/penilaian');
			
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Penilaianmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di lihat.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/penilaian');
                    
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di lihat.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/penilaian');
                
            }
        }

        //view penilaian
		$penilaian_id = $this->uri->segment(4);
        $data['view_penilaian_detail'] = $view_penilaian_detail  = $this->Penilaianmodel->Detail($penilaian_id)->row();

        //view User
		$view_user = $this->Penilaianmodel->select_db("tbl_users","user_id",$view_penilaian_detail->user_id)->row();
		$user_id = $view_user->user_id;

        //view sesi
		$data['sesi'] = $sesi = $view_penilaian_detail->penilaian_sesi;

		//detail by total nilai
		$data['view_total_nilai'] = $this->Tesmodel->LihatByJawabanNilai($sesi,$user_id,$limit="2")->result();

		//detail penilaian detail
		$data['view_penilaian'] = $view_penilaian = $this->Tesmodel->DetailPenilaian($sesi,$user_id)->row();
		$data['view_kepribadian_1'] = $view_kepribadian_1 = $this->Tesmodel->DetailKepribadian($view_penilaian->kepribadian_id_1)->row();
		$data['view_kepribadian_2'] = $view_kepribadian_2 = $this->Tesmodel->DetailKepribadian($view_penilaian->kepribadian_id_2)->row();      

		$data['page_title'] = "Detail Penilaian - Nama : ".$view_user->user_name;
		$template = '/backend/content/penilaian_detail';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}
}
