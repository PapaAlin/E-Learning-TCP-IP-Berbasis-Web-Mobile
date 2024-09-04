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

class Page404 extends S_UserController
{

	public function __construct()
	{
        parent::__construct();
		
		// Memanggil library template frontend
		$this->load->library('Template_frontend');
		//Mainmodel
		$this->load->model('main/Mainmodel');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{
        $title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "404 Not Found - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$template = '/frontend/content/page404';
		$this->template_frontend->display($template, $data);
	}
}
