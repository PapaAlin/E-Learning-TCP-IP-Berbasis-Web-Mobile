<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends S_AdmController {

	public function __construct(){
        parent::__construct();

        $this->load->library('pagination');
		$this->load->library('form_validation');

		//database
		$this->load->model('adm/Mainmodel');
		$this->load->model('adm/Usersmodel');

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
		$data['total_data'] = $total_data = $this->Usersmodel->total_data($nama,$status=1);

		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url().'adm/users/?'.$get_search;
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

		$data['user'] = $this->Usersmodel->GetData($config['per_page'],$page,$nama,$status=1);

		$data['page_title'] = "Data Semua User";
		$template = '/backend/content/users';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	public function add()
	{
		$data['kelas'] = $this->Usersmodel->GetAllKelas();

		$data['page_title'] = "Form Tambah User";
		$template = '/backend/content/user_add';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== add save ============================ //
	public function add_save()
	{

		if($_FILES['user_img']['name'] == "")
		{
			$user_img = "";
		}
		else
		{			
			//upload gambar
			$ext = explode(".",$_FILES['user_img']['name']);
			$ext = end($ext);
			$user_img = 'SISWA-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//img medium
			$img_config['max_size'] = '2000';
			$img_config['upload_path'] = './_images/_user/_medium/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadmedium');  // Create custom object
		    $this->uploadmedium->initialize($img_config);
		    $upload_medium = $this->uploadmedium->do_upload('user_img');
			
			if(!$upload_medium)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
				
			}
			else
			{
				$img = $this->uploadmedium->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
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

			//img small
			$img_config['max_size'] = '2024';
			$img_config['upload_path'] = './_images/_user/_small/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadsmall');  // Create custom object
		    $this->uploadsmall->initialize($img_config);
		    $upload_small = $this->uploadsmall->do_upload('user_img');
			
			if(!$upload_small)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
				
			}
			else
			{
				$img = $this->uploadsmall->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
					'height' => '400',
					'width' => '400',
					'quality' => '40'
				);
				$this->load->library('image_lib',$c_img_lib,'resizesmall');
				if(!$this->resizesmall->resize())
				{
					echo $this->resizesmall->display_errors();
					
				}
			}
		}
			
		$data = array(
			"user_name" => $this->input->post('user_name'),
			"user_alamat" => $this->input->post('user_alamat'),
			"user_jk" => $this->input->post('user_jk'),
			"user_img" => $user_img,
			"user_created" => date("Y-m-d H:i:s")
		);
		
		$insert = $this->Usersmodel->insert_db("tbl_user",$data);
		
		if($insert)
		{
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/users');
			
		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Tambah Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/users');
			
		}
	}

	public function edit()
	{
		$data['kelas'] = $this->Usersmodel->GetAllKelas();

		if (!is_numeric($this->uri->segment(4)))
        {
        	$array_msg = array(
							'type' => 'warning',
							'message' => 'Tidak ada data yang akan di edit.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/users');
			
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Usersmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di edit.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/users');
                    
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di edit.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/users');
                
            }
        }

		$user_id = $this->uri->segment(4);
		$view_user = $this->Usersmodel->Detail($user_id)->row();

        $data['view_user'] = $view_user;

		//$data['user'] = $this->Toursmodel->GetAll("2","5");

		$data['page_title'] = "Edit - ".$view_user->user_name;
		$template = '/backend/content/user_edit';
		$template_css = '/backend/include/form_css';
		$template_js = '/backend/include/form_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
	}

	// =========== Edit save ============================ //
	public function edit_save()
	{
			
		//tour img old
		$user_img_old = $this->input->post('user_img_old');

		if($_FILES['user_img']['name'] == "")
		{
			$user_img = "";
		}
		else
		{			
			//upload gambar
			$ext = explode(".",$_FILES['user_img']['name']);
			$ext = end($ext);
			$user_img = 'SISWA-'.date('Ymd')."-".date('His')."-".rand(1,1000).'.'.$ext;

			//img medium
			$img_config['max_size'] = '2000';
			$img_config['upload_path'] = './_images/_user/_medium/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadmedium');  // Create custom object
		    $this->uploadmedium->initialize($img_config);
		    $upload_medium = $this->uploadmedium->do_upload('user_img');
			
			if(!$upload_medium)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
				
			}
			else
			{
				$img = $this->uploadmedium->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
					'height' => '800',
					'width' => '800',
					'quality' => '70'
				);
				$this->load->library('image_lib',$c_img_lib,'resizemedium');
				if(!$this->resizemedium->resize())
				{
					echo $this->resizemedium->display_errors();
				}
				if($user_img_old != "") unlink('./_images/_user/_medium/'.$user_img_old.'');
			}

			//img small
			$img_config['max_size'] = '2024';
			$img_config['upload_path'] = './_images/_user/_small/';
			$img_config['remove_spaces'] = true;
			$img_config['file_name'] = $user_img;
			$img_config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $img_config, 'uploadsmall');  // Create custom object
		    $this->uploadsmall->initialize($img_config);
		    $upload_small = $this->uploadsmall->do_upload('user_img');
			
			if(!$upload_small)
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Gagal Tambah Data, Gambar Tidak Boleh lebih dari 1MB'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				echo '<script>window.history.back();</script>';
				
			}
			else
			{
				$img = $this->uploadsmall->data();
				$c_img_lib = array(
					'image_library' => 'gd2',
					'source_image' => $img['full_path'],
					'new_image' => $user_img,
					'height' => '400',
					'width' => '400',
					'quality' => '40'
				);
				$this->load->library('image_lib',$c_img_lib,'resizesmall');
				if(!$this->resizesmall->resize())
				{
					echo $this->resizesmall->display_errors();
				}
				if($user_img_old != "") unlink('./_images/_user/_small/'.$user_img_old.'');
			}
		}

		$data = array(
			"user_name" => $this->input->post('user_name'),
			"user_email" => $this->input->post('user_email'),
			"user_alamat" => $this->input->post('user_alamat'),
			"user_jk" => $this->input->post('user_jk'),
			"user_img" => $user_img
		);
		
		$user_id = $this->input->post('user_id');
		$update = $this->Usersmodel->update_db("tbl_user","user_id",$user_id,$data);
		
		if($update)
		{
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Edit Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/users');
			
		}
		else
		{
			
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Edit Data'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('adm/users');
			
		}
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
			redirect('adm/users');
			
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Usersmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                	$array_msg = array(
									'type' => 'warning',
									'message' => 'Tidak ada data yang akan di lihat.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
                    redirect('adm/users');
                    
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di lihat.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/users');
                
            }
        }

		$user_id = $this->uri->segment(4);
		$view_user = $this->Usersmodel->Detail($user_id)->row();

        $data['view_user'] = $view_user;

		//$data['user'] = $this->Toursmodel->GetAll("2","5");

		$data['page_title'] = "Detail - ".$view_user->user_name;
		$template = '/backend/content/user_detail';
		$template_css = '/backend/include/table_css';
		$template_js = '/backend/include/table_js';

		$this->template_backend->display($template, $template_css, $template_js, $data);
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
            redirect('adm/users');
            
        }
        else
        {
            if($this->uri->segment(4) != "" )
            {
                if($this->Usersmodel->Detail($this->uri->segment(4))->num_rows() == "0")
                {
                    $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
					$this->session->set_flashdata('message_flashdata', $array_msg);
	                redirect('adm/users');
	                
                }
            }
            else
            {
                $array_msg = array(
								'type' => 'warning',
								'message' => 'Tidak ada data yang akan di Hapus.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
                redirect('adm/users');
                
            }
        }

		$view_user = $this->Usersmodel->Detail($this->uri->segment(4))->row();
		$delete = $this->Usersmodel->delete_db('tbl_user','user_id',$this->uri->segment(4));
		if($delete)
		{
			//delete gambar
			if($view_user->user_img != "") unlink('./_images/_user/_small/'.$view_user->user_img.'');
			if($view_user->user_img != "") unlink('./_images/_user/_medium/'.$view_user->user_img.'');
			
			$array_msg = array(
							'type' => 'success',
							'message' => 'Sukses Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/users');
            
		}
		else
		{
			$array_msg = array(
							'type' => 'warning',
							'message' => 'Gagal Hapus Data.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
            redirect('adm/users');
            
		}
    }
}
