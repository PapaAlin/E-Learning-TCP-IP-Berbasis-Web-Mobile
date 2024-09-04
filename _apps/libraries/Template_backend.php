<?php

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

	class Template_backend
	{
		protected $_ci;
		function __construct()
		{
			$this->_ci =&get_instance();
		}

		function display($template, $template_css=null, $template_js=null, $data=null)
		{
			$data['_content'] = $this->_ci->load->view($template, $data, true);
			$data['_header'] = $this->_ci->load->view('/backend/include/header', $data, true);
			$data['_sidebar'] = $this->_ci->load->view('/backend/include/sidebar', $data, true);
			$data['_footer'] = $this->_ci->load->view('/backend/include/footer', $data, true);

			$data['_template_css'] = $this->_ci->load->view($template_css, $data, true);
			$data['_template_js'] = $this->_ci->load->view($template_js, $data, true);

			$this->_ci->load->view('/backend/template.php', $data);

		}
	}
?>