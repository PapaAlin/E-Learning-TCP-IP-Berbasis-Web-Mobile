<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends S_UserController
{

	public function __construct()
	{
        parent::__construct();
        $this->load->library('pagination');
		$this->load->library('form_validation');
		
		// Memanggil library template frontend
		$this->load->library('Template_frontend');

		//database
		$this->load->model('main/Mainmodel');
		$this->load->model('main/Coursesmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = $title->option_value;

		$data['courses'] = $this->Coursesmodel->GetAll("5","DESC");

		//seo
        $data['keywords'] = $this->Mainmodel->GetOptions("web_keywords")->option_value;
        $data['description'] = substr(strip_tags(stripslashes($this->Mainmodel->GetOptions("web_about")->option_value)),0,550);
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;
        
		$template = '/frontend/content/main';
		$this->template_frontend->display($template, $data);
	}
}
