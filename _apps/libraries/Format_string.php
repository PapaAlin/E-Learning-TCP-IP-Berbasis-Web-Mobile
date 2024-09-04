<?php
/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/
	class Format_string{

		function string_cut($kalimat,$jumlahkarakter)
		{
            $cetak = substr($kalimat,$jumlahkarakter,1);
            if($cetak != " "){
              while($cetak != " "){
                $i=1;
                $jumlahkarakter = $jumlahkarakter+$i;
                $cetak = substr($kalimat,$jumlahkarakter,1);
              }
            }
            $cetak = substr($kalimat,0,$jumlahkarakter);
            return $cetak;
		}

		function rupiah_rp($angka)
        {
            return "Rp.".number_format( $angka,0,",",".")."";
        }
	}

