<?php

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

	class Admin_Class_menu
	{

		protected $_ci;
		function __construct()
		{
			$this->_ci =&get_instance();
		}

		function active($menu)
		{
			switch ($menu) {
				case 'dashboard':
					if($this->_ci->uri->segment(2) == "" || $this->_ci->uri->segment(2) == "main")
					{
						return "active";
					}
					break;
				case 'articles':
					if($this->_ci->uri->segment(2) == "articles" || $this->_ci->uri->segment(2) == "categories")
					{
						return "active";
					}
					break;
				case 'contact':
					if($this->_ci->uri->segment(2) == "contact")
					{
						return "active";
					}
					break;
				case 'product':
					if($this->_ci->uri->segment(2) == "products" || $this->_ci->uri->segment(2) == "productcat"  || $this->_ci->uri->segment(2) == "promotions"  || $this->_ci->uri->segment(2) == "comments"  || $this->_ci->uri->segment(2) == "massemail")
					{
						return "active";
					}
					break;
				case 'menu':
					if($this->_ci->uri->segment(2) == "menu")
					{
						return "active";
					}
					break;
				case 'users':
					if($this->_ci->uri->segment(2) == "users")
					{
						return "active";
					}
					break;
				case 'admin':
					if($this->_ci->uri->segment(2) == "admins")
					{
						return "active";
					}
					break;
				case 'slideheaders':
					if($this->_ci->uri->segment(2) == "slideheaders")
					{
						return "active";
					}
					break;
				case 'kepribadian':
					if($this->_ci->uri->segment(2) == "kepribadian")
					{
						return "active";
					}
					break;
				case 'events':
					if($this->_ci->uri->segment(2) == "events")
					{
						return "active";
					}
					break;
				case 'courses':
					if($this->_ci->uri->segment(2) == "courses")
					{
						return "active";
					}
					break;
				case 'orders':
					if($this->_ci->uri->segment(2) == "poin")
					{
						return "active";
					}
					break;
				case 'soal':
					if($this->_ci->uri->segment(2) == "soal")
					{
						return "active";
					}
					break;
				case 'penilaian':
					if($this->_ci->uri->segment(2) == "penilaian")
					{
						return "active";
					}
					break;
				case 'shipping':
					if($this->_ci->uri->segment(2) == "shipping" || $this->_ci->uri->segment(2) == "pickuppoint" || $this->_ci->uri->segment(2) == "shippingcost" || $this->_ci->uri->segment(2) == "shipment")
					{
						return "active";
					}
					break;
				case 'messages':
					if($this->_ci->uri->segment(2) == "messages")
					{
						return "active";
					}
					break;
				case 'settings':
					if($this->_ci->uri->segment(2) == "settings"  || $this->_ci->uri->segment(2) == "sites"  || $this->_ci->uri->segment(2) == "popup")
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

