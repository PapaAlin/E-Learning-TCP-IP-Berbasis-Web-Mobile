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

class Register extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        $this->load->library('pagination');
		$this->load->library('form_validation');

		//model
		$this->load->model('main/Mainmodel');
		$this->load->model('main/Usersmodel');
		
        // Memanggil library Admin_Class_menu
        $this->load->library('Class_menu');

		// Memanggil library recaptcha
		$this->load->library('Recaptcha');
		
		// Memanggil library template frontend
		$this->load->library('Template_frontend');

        date_default_timezone_set("Asia/Jakarta");
    }

	public function index()
	{
		//cek cookie admin_id
        $option_login_validation = $this->Mainmodel->GetOptions('web_user_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        $user = $this->session->userdata('user_id');
        if($user)
        {
            //login sukses
            redirect('profile');
            
        }
        else if ($cookie <> '')
        {
            $row = $this->Usersmodel->get_by_cookie($cookie)->row();
            if($row)
            {
                set_cookie($option_login_validation,$cookie,86400*365);
                $this->_session_registered($row);
                redirect('profile');
                
            }
        }

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Register - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$template = '/frontend/content/register';
		$this->template_frontend->display($template, $data);
	}

	public function proses()
	{

		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');

		//cek required
		if($username == "" || $email == "" || $password == "" || $password2 == ""){

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Kolom Tidak Boleh Kosong.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register');

		}
		else
		{

			//cek alphanumeric username
			if(!ctype_alnum ($username))
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Username harus terdiri dari Huruf dan angka.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register');
			}

			//cek email in database
			if($this->Usersmodel->CekEmail($email))
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Email Sudah terdaftar. Silahkan Login'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register');

			}

			//cek kesamaan pasword
			if($password != $password2)
			{

				$array_msg = array(
								'type' => 'danger',
								'message' => 'Password yang anda masukkan tidak sama.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register');

			}

			// Memanggil library encrypt
			$this->load->library('Password_encrypt');
			$_password = $this->password_encrypt->encrypt($password);

			//helper string
			$this->load->helper('string');
			$activation_code = random_string('alnum', 32);

			//create NIP (tahun-regional(12)-random)
			$random = random_string('numeric', 4);
			$user_nip = date("Y").'12'.$random;

			$data = array(
				"user_nip" => $user_nip,
				"username" => $this->input->post('username'),
				"user_name" => $this->input->post('username'),
				"user_email" => $this->input->post('email'),
				"password" => $_password,
				"user_status" => "1",
				"cookie" => $_password,
				"user_login" => date("Y-m-d H:i:s"),
				"user_date" => date("Y-m-d H:i:s")
			);
			
			$insert = $this->Usersmodel->insert_db("tbl_users",$data);

			if($insert)
			{

				//send email
				//$activation_url = base_url()."register/active/".$this->input->post('username')."/".$this->input->post('email')."/".$user_newsletter."/".$activation_code."/0/".$_password."";
				//$this->_send_email($activation_url,$this->input->post('email'),$this->input->post('username'));

				$array_msg = array(
								'type' => 'success',
								'message' => 'Terima Kasih Sudah mendaftar, Silahkan Login.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('login');

			}
			else
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Coba Ulangi lagi.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register');
				
			}

		}
	}

	public function active()
	{
		$username = $this->uri->segment(3);
		$user_email = $this->uri->segment(4);
		$user_newsletter = $this->uri->segment(5);
		$activation_code = $this->uri->segment(6);
		$user_status = $this->uri->segment(7);
		$cookie = $this->uri->segment(8);

		if($this->Usersmodel->CekEmail($user_email))
		{
			if($this->Usersmodel->cekActive($user_email))
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Akun Sudah di Aktifasi, Silahkan Login.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('login');
				
			}
			else
			{
				
				$row = $this->Usersmodel->Active($username,$user_email,$user_newsletter,$activation_code,$user_status,$cookie)->row();
				if($row)
				{
					$update_key = array(
							'user_status' => "1"
						);
					$this->Usersmodel->update_status($update_key, $row->user_id);

					$array_msg = array(
									'type' => 'success',
									'message' => 'Akun Sudah di Aktifasi, Silahkan Login.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
					redirect('login');
					
				}
				else
				{
					$array_msg = array(
									'type' => 'danger',
									'message' => 'Akun Gagal di Aktifasi, Silahkan Ulangi lagi atau kirim ulang link activasi ke email.'
								);
					$this->session->set_flashdata('message_flashdata', $array_msg);
					redirect('login');
					
				}
			}
		}
		else
		{
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Email Belum Terdaftar.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register');
			
		}
	}

	public function resend()
	{
		//cek cookie admin_id
        $option_login_validation = $this->Mainmodel->GetOptions('cookie_user_validation')->option_value;
        $cookie = get_cookie($option_login_validation);

        $user = $this->session->userdata('user_id');
        if($user)
        {
            //login sukses
            redirect('profile');
            
        }
        else if ($cookie <> '')
        {
            $row = $this->Usersmodel->get_by_cookie($cookie)->row();
            if($row)
            {
                set_cookie($option_login_validation,$cookie,86400*365);
                $this->_session_registered($row);
                redirect('profile');
                
            }
        }

		$title = $this->Mainmodel->GetOptions("web_title");
		$data['page_title'] = "Resend Activation Code - ".$title->option_value;

		//seo
        $data['keywords'] = "";
        $data['description'] = "";
        $data['image_src'] = base_url()."_images/".$this->Mainmodel->GetOptions("web_logo")->option_value;

		$template = '/frontend/content/resend';
		$this->template_frontend->display($template, $data);
	}

	public function resend_proses()
	{

		$email = $this->input->post('email');

		//cek required
		if($email == ""){

			$array_msg = array(
							'type' => 'danger',
							'message' => 'Kolom Tidak Boleh Kosong.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register/resend');
			

		}
		else
		{

			//cek email in database
			if(!$this->Usersmodel->CekEmail($email))
			{

				$array_msg = array(
								'type' => 'danger',
								'message' => 'Email Belum terdaftar.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register/resend');
				

			}

			//cek akun aktif
			if($this->Usersmodel->CekUserStatus($email)->row()->user_status != "0")
			{

				$array_msg = array(
								'type' => 'danger',
								'message' => 'Akun Sudah Diaktifasi, Silahkan Login.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register/login');
				

			}

			$resend = $this->Usersmodel->CekDetailEmail($email)->row();			

			if($resend)
			{

				//send email
				$activation_url = base_url()."register/active/".$resend->username."/".$this->input->post('email')."/".$resend->user_newsletter."/".$resend->activation_code."/0/".$resend->cookie."";
				$this->_send_email($activation_url,$this->input->post('email'),$resend->username);

			}
			else
			{
				$array_msg = array(
								'type' => 'danger',
								'message' => 'Coba Ulangi lagi.'
							);
				$this->session->set_flashdata('message_flashdata', $array_msg);
				redirect('register/resend');
				
			}

		}
	}

	//==================== save mass email =================== //
	private function _send_email($url,$email,$username){
		
		// load library email
        $this->load->library('Mailer');

		//awal phpmailer
		$mail             = new PHPMailer();
		
		//untuk php 5.6 keatas
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		$mail->IsSMTP(); // menggunakan SMTP
		//$mail->SMTPDebug  = 2;   // mengaktifkan debug SMTP
		$mail->SMTPDebug  = false;   // disable debug SMTP
		
		$mail->SMTPAuth   = true;   // mengaktifkan Autentifikasi SMTP
		//$mail->Host = '182.253.238.208'; // host sesuaikan dengan hosting mail anda
		$mail->Host = 'mail.al-ayubi.com'; // host sesuaikan dengan hosting mail anda
		$mail->Port       = 587;  // post gunakan port 25
		//$mail->Port       = 465;  // post gunakan port 25
		$mail->Username   = "admin@kain.al-ayubi.com"; // username email akun
		$mail->Password   = "kaintenun123!!";        // password akun
		
		$mail->SetFrom('admin@kain.al-ayubi.com', $this->Mainmodel->GetOptions("web_title")->option_value);
		
		$mail->Subject    = "Email Activation Code";
		//$html = "<div>Link : ".$url."</div>";
		$html = $this->_email_body($url,$email,$username);
		$mail->MsgHTML($html);
		//*/

		$mail->AddAddress($email, $username);
	
		if(!$mail->Send()) {
			//echo "Oops, Mailer Error: " . $mail->ErrorInfo;
			$array_msg = array(
							'type' => 'danger',
							'message' => 'Gagal Kirim Email..'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register');
			
		} else {
			//echo $mail->ErrorInfo;
			//echo '<script>alert("Sukses Kirim Email");window.history.back(); </script>';
			$array_msg = array(
							'type' => 'success',
							'message' => 'Cek email dan aktifkan akun anda dengan klik link yang di kirim ke email anda.'
						);
			$this->session->set_flashdata('message_flashdata', $array_msg);
			redirect('register');
			
		}
		//akhir phpmailer
	}

	private function _email_body($url,$email,$username)
	{
		return
		'
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html>
			<head>
			<!-- If you delete this meta tag, the ground will open and swallow you. -->
			<meta name="viewport" content="width=device-width" />

			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>ZURBemails</title>

			<style type="text/css">
			/* ------------------------------------- 
			GLOBAL 
			------------------------------------- */
			* { 
				margin:0;
				padding:0;
			}
			* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

			img { 
				max-width: 100%; 
			}
			.collapse {
				margin:0;
				padding:0;
			}
			body {
				-webkit-font-smoothing:antialiased; 
				-webkit-text-size-adjust:none; 
				width: 100%!important; 
				height: 100%;
			}


			/* ------------------------------------- 
					ELEMENTS 
			------------------------------------- */
			a { color: #2BA6CB;}

			.btn {
				text-decoration:none;
				color: #FFF;
				background-color: #666;
				padding:10px 16px;
				font-weight:bold;
				margin-right:10px;
				text-align:center;
				cursor:pointer;
				display: inline-block;
			}

			p.callout {
				padding:15px;
				background-color:#ECF8FF;
				margin-bottom: 15px;
			}
			.callout a {
				font-weight:bold;
				color: #2BA6CB;
			}

			table.social {
			/* 	padding:15px; */
				background-color: #ebebeb;
				
			}
			.social .soc-btn {
				padding: 3px 7px;
				font-size:12px;
				margin-bottom:10px;
				text-decoration:none;
				color: #FFF;font-weight:bold;
				display:block;
				text-align:center;
			}
			a.fb { background-color: #3B5998!important; }
			a.tw { background-color: #1daced!important; }
			a.gp { background-color: #DB4A39!important; }
			a.ig { background-color: #B16767!important; }
			a.ms { background-color: #000!important; }

			.sidebar .soc-btn { 
				display:block;
				width:100%;
			}

			/* ------------------------------------- 
					HEADER 
			------------------------------------- */
			table.head-wrap { width: 100%;}

			.header.container table td.logo { padding: 15px; }
			.header.container table td.label { padding: 15px; padding-left:0px;}


			/* ------------------------------------- 
					BODY 
			------------------------------------- */
			table.body-wrap { width: 100%;}


			/* ------------------------------------- 
					FOOTER 
			------------------------------------- */
			table.footer-wrap { width: 100%;	clear:both!important;
			}
			.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
			.footer-wrap .container td.content p {
				font-size:10px;
				font-weight: bold;
				
			}


			/* ------------------------------------- 
					TYPOGRAPHY 
			------------------------------------- */
			h1,h2,h3,h4,h5,h6 {
			font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
			}
			h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

			h1 { font-weight:200; font-size: 44px;}
			h2 { font-weight:200; font-size: 37px;}
			h3 { font-weight:500; font-size: 27px;}
			h4 { font-weight:500; font-size: 23px;}
			h5 { font-weight:900; font-size: 17px;}
			h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

			.collapse { margin:0!important;}

			p, ul { 
				margin-bottom: 10px; 
				font-weight: normal; 
				font-size:14px; 
				line-height:1.6;
			}
			p.lead { font-size:17px; }
			p.last { margin-bottom:0px;}

			ul li {
				margin-left:5px;
				list-style-position: inside;
			}

			/* ------------------------------------- 
					SIDEBAR 
			------------------------------------- */
			ul.sidebar {
				background:#ebebeb;
				display:block;
				list-style-type: none;
			}
			ul.sidebar li { display: block; margin:0;}
			ul.sidebar li a {
				text-decoration:none;
				color: #666;
				padding:10px 16px;
			/* 	font-weight:bold; */
				margin-right:10px;
			/* 	text-align:center; */
				cursor:pointer;
				border-bottom: 1px solid #777777;
				border-top: 1px solid #FFFFFF;
				display:block;
				margin:0;
			}
			ul.sidebar li a.last { border-bottom-width:0px;}
			ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



			/* --------------------------------------------------- 
					RESPONSIVENESS
					Nuke it from orbit. It s the only way to be sure. 
			------------------------------------------------------ */

			/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
			.container {
				display:block!important;
				max-width:600px!important;
				margin:0 auto!important; /* makes it centered */
				clear:both!important;
			}

			/* This should also be a block element, so that it will fill 100% of the .container */
			.content {
				padding:15px;
				max-width:600px;
				margin:0 auto;
				display:block; 
			}

			/* Let s make sure tables in the content area are 100% wide */
			.content table { width: 100%; }


			/* Odds and ends */
			.column {
				width: 300px;
				float:left;
			}
			.column tr td { padding: 15px; }
			.column-wrap { 
				padding:0!important; 
				margin:0 auto; 
				max-width:600px!important;
			}
			.column table { width:100%;}
			.social .column {
				width: 280px;
				min-width: 279px;
				float:left;
			}

			/* Be sure to place a .clear element after each set of columns, just to be safe */
			.clear { display: block; clear: both; }


			/* ------------------------------------------- 
					PHONE
					For clients that support media queries.
					Nothing fancy. 
			-------------------------------------------- */
			@media only screen and (max-width: 600px) {
				
				a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

				div[class="column"] { width: auto!important; float:none!important;}
				
				table.social div[class="column"] {
					width:auto!important;
				}

			}
			</style>

			</head>
			 
			<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

			<!-- HEADER -->
			<table class="head-wrap" bgcolor="#999999">
				<tr>
					<td></td>
					<td class="header container">
						
							<div class="content">
								<table bgcolor="#999999">
								<tr>
									<td width="25%"><img src="http://laxo.net.id/assets/logo2.png" /></td>
									<td align="right"><h3 class="collapse">'.$this->Mainmodel->GetOptions("web_title")->option_value.'</h3></td>
								</tr>
							</table>
							</div>
							
					</td>
					<td></td>
				</tr>
			</table><!-- /HEADER -->


			<!-- BODY -->
			<table class="body-wrap">
				<tr>
					<td></td>
					<td class="container" bgcolor="#FFFFFF">

						<div class="content">
						<table>
							<tr>
								<td>
									
									<h3>Welcome, '.$username.'</h3>
									
									<!-- Callout Panel -->
									<p class="callout">
										Anda akan menerima pemberitahuan dari '.$this->Mainmodel->GetOptions("web_title")->option_value.'. <a href="#">Klik Disini</a> Jika ingin berhenti berlanganan
									</p><!-- /Callout Panel -->
									
									<p>
									<h5 class="">Akun Info:</h5>
									Username : '.$username.'<br>
									Email : '.$email.'<br>
									Password : **********
									</p>

									<p>Akun anda sudah terdaftar di '.$this->Mainmodel->GetOptions("web_title")->option_value.'. status akun anda masih tidak aktif. jika anda ingin melanjutkan transaksi atau kegiatan yang lain di website kami, maka akun anda perlu di aktifasi dengan cara klik link di bawah ini atau copy link berikut : <a href="'.$url.'">'.$url.'</a>.</p>
									<a class="btn" href="'.$url.'">Click Here!</a>
															
									<br/>
									<br/>							
															
									<!-- social & contact -->
									<table class="social" width="100%">
										<tr>
											<td>
												<!--- column 1 -->
												<table align="left" class="column">
													<tr>
														<td>
															<h5 class="">Connect with Us:</h5>
															<p class="">
																<a href="'.$this->Mainmodel->GetDetailSite("1")->row()->site_url.'" class="soc-btn fb">Facebook</a> 
																<a href="'.$this->Mainmodel->GetDetailSite("2")->row()->site_url.'" class="soc-btn tw">Twitter</a> 
																<a href="'.$this->Mainmodel->GetDetailSite("3")->row()->site_url.'" class="soc-btn ig">Instagram</a> 
																<a href="'.$this->Mainmodel->GetDetailSite("4")->row()->site_url.'" class="soc-btn gp">Google+</a>
															</p>
														</td>
													</tr>
												</table><!-- /column 1 -->	
												
												<!--- column 2 -->
												<table align="left" class="column">
													<tr>
														<td>
															<h5 class="">Contact Info:</h5>
															<p>Phone: <strong>'.$this->Mainmodel->GetOptions("web_contact_telp")->option_value.'</strong><br/>
			                Email: <strong><a href="'.$this->Mainmodel->GetOptions("web_contact_email")->option_value.'">'.$this->Mainmodel->GetOptions("web_contact_email")->option_value.'</a></strong></p>
			                
														</td>
													</tr>
												</table><!-- /column 2 -->
												
												<span class="clear"></span>	
												
											</td>
										</tr>
									</table><!-- /social & contact -->
								
								
								</td>
							</tr>
						</table>
						</div>
												
					</td>
					<td></td>
				</tr>
			</table><!-- /BODY -->

			</body>
			</html>
		';
	}
}
