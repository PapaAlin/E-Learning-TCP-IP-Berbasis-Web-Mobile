<?php

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

	class Template_frontend
	{
		protected $_ci;
		function __construct()
		{
			$this->_ci =&get_instance();
		}

		function display($template, $data=null)
		{
			$data['_content'] = $this->_ci->load->view($template, $data, true);
			$data['_header'] = $this->_ci->load->view('/frontend/include/header', $data, true);
			//$data['_sidebar'] = $this->_ci->load->view('/frontend/include/sidebar', $data, true);
			$data['_footer'] = $this->_ci->load->view('/frontend/include/footer', $data, true);

			$this->_ci->load->view('/frontend/template.php', $data);

		}
	}
?>