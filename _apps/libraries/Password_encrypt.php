<?php
/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/
	class Password_encrypt{

		function encrypt($password)
		{
			// perlu dibuat sembarang pengacak
			$_pengacak  = "NDJS3289JSKS190JISJI";
			$_password = md5($_pengacak . md5($password) . $_pengacak);
			return $_password;
		}
	}

