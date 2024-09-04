<?php

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

	class Class_menu
	{

		protected $_ci;
		function __construct()
		{
			$this->_ci =&get_instance();
		}

		function active($menu)
		{
			switch ($menu) {
				case 'home':
					if($this->_ci->uri->segment(1) == "" || $this->_ci->uri->segment(1) == "main")
					{
						return "active";
					}
					break;
				case 'courses':
					if($this->_ci->uri->segment(1) == "courses")
					{
						return "active";
					}
					break;
				case 'about':
					if($this->_ci->uri->segment(2) == "about")
					{
						return "active";
					}
					break;
				case 'profile':
					if($this->_ci->uri->segment(1) == "profile")
					{
						return "active";
					}
					break;
				case 'login':
					if($this->_ci->uri->segment(1) == "login")
					{
						return "active";
					}
					break;
				default:
					return "";
					break;
			}
		}
	}

