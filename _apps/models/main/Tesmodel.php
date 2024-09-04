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

class Tesmodel extends CI_Model 
{
	
	
	public function CekJawabanPosttest($user_id,$course_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('course_id',$course_id);
		$this->db->where('jawaban_status',"0");
		$this->db->where('jawaban_type',"posttest");
		$this->db->order_by("soal_id","DESC");
		$this->db->limit("1");
		$a = $this->db->get('tbl_jawaban');
		return $a;
	}

	public function CekSesiPosttest($user_id,$course_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('course_id',$course_id);
		$this->db->where('jawaban_status',"1");
		$this->db->where('jawaban_type',"posttest");
		$this->db->order_by("jawaban_created","DESC");
		$this->db->limit("1");
		$a = $this->db->get('tbl_jawaban');
		return $a;
	}

	//pretest
	public function CekJawabanPretest($user_id,$course_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('course_id',$course_id);
		$this->db->where('jawaban_status',"0");
		$this->db->where('jawaban_type',"pretest");
		$this->db->order_by("jawaban_created","DESC");
		$this->db->limit("1");
		$a = $this->db->get('tbl_jawaban');
		return $a;
	}

	public function CekSesiPretest($user_id,$course_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('course_id',$course_id);
		$this->db->where('jawaban_status',"1");
		$this->db->where('jawaban_type',"pretest");
		$this->db->order_by("jawaban_created","DESC");
		$this->db->limit("1");
		$a = $this->db->get('tbl_jawaban');
		return $a;
	}

	public function LihatSesi($jawaban_sesi,$user_id)
	{
		$this->db->from('tbl_jawaban');

		if(isset($jawaban_sesi)){
			$this->db->where('jawaban_sesi', $jawaban_sesi);
		}

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function LihatByJawabanNilai($jawaban_nilai,$jawaban_type,$jawaban_sesi,$user_id,$course_id)
	{
		$this->db->from('tbl_jawaban');

		if(isset($jawaban_nilai)){
			$this->db->where('jawaban_nilai', $jawaban_nilai);
		}

		if(isset($jawaban_type)){
			$this->db->where('jawaban_type', $jawaban_type);
		}
		
		if(isset($jawaban_sesi)){
			$this->db->where('jawaban_sesi', $jawaban_sesi);
		}

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function DetailSoal($soal_id=NULL)
	{
		$this->db->from('tbl_soal');

		if(isset($soal_id)){
			$this->db->where('soal_id', $soal_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function DetailSoalByNoUrut($course_id,$soal_no)
	{
		$this->db->from('tbl_soal');

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		if(isset($soal_no)){
			$this->db->where('soal_no', $soal_no);
		}

		$q = $this->db->get();
		return $q;
	}

	public function DetailKepribadian($kepribadian_id=NULL)
	{
		$this->db->from('tbl_kepribadian');

		if(isset($kepribadian_id)){
			$this->db->where('kepribadian_id', $kepribadian_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function DetailPenilaian($user_id,$course_id,$penilaian_type,$penilaian_sesi)
	{
		$this->db->from('tbl_penilaian');

		if(isset($penilaian_type)){
			$this->db->where('penilaian_type', $penilaian_type);
		}
		
		if(isset($penilaian_sesi)){
			$this->db->where('penilaian_sesi', $penilaian_sesi);
		}

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		$q = $this->db->get();
		return $q;
	}

	public function GetPenilaian($user_id,$course_id,$penilaian_type)
	{
		$this->db->from('tbl_penilaian');

		if(isset($user_id)){
			$this->db->where('user_id', $user_id);
		}

		if(isset($course_id)){
			$this->db->where('course_id', $course_id);
		}

		if(isset($penilaian_type)){
			$this->db->where('penilaian_type', $penilaian_type);
		}

		$q = $this->db->get();
		return $q->result();
	}
	
    public function update_jawaban_status($user_id,$data){
        $this->db->where('user_id',$user_id);
        $this->db->where('jawaban_status',"0");
        return $this->db->update('tbl_jawaban',$data);
    }
	
	public function select_db($tbl_name,$col,$id){
        $this->db->from($tbl_name);
		$this->db->where($col,$id);
        return $this->db->get();
    }
	
	public function insert_db($tb_name,$data){
        return $this->db->insert($tb_name,$data);
    }
	
    public function update_db($tb_name,$col,$id,$data){
        $this->db->where($col,$id);
        return $this->db->update($tb_name,$data);
    }
	
    public function delete_db($tb_name,$col,$id){
        $this->db->where($col,$id);
        return $this->db->delete($tb_name);
    }
}