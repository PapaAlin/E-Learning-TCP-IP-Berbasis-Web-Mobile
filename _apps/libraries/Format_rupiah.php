<?php
/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/
	class Format_rupiah{

		function rupiah_notrp($angka)
		{
			return number_format($angka,0,",",".")."";
		}

		function rupiah_rp($angka)
        {
            return "Rp.".number_format($angka,0,",",".")."";
        }
	}

