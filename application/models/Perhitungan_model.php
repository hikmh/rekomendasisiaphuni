<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan_model extends CI_Model
{

	public function get_kriteria()
	{
		$query = $this->db->get('kriteria');
		return $query->result();
	}

	public function get_sub_kriteria()
	{
		$query = $this->db->get('sub_kriteria');
		return $query->result();
	}

	public function data_sub_kriteria($id_kriteria)
	{
		$query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai DESC;");
		return $query->result_array();
	}

	public function get_alternatif()
	{
		$query = $this->db->get('alternatif');
		return $query->result();
	}

	public function data_nilai($id_alternatif, $id_kriteria)
	{
		$query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
		return $query->row_array();
	}

	public function get_detail($id_alternatif)
	{
		$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif WHERE hasil.id_alternatif='$id_alternatif';");
		return $query->row_array();
	}

	public function data_ket($id_alternatif, $id_kriteria)
	{
		$query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
		return $query->row_array();
	}

	public function get_nilai($id_kriteria)
	{
		$query = $this->db->query("SELECT sub_kriteria.nilai FROM `penilaian` JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria WHERE penilaian.id_kriteria='$id_kriteria';");
		return $query->result_array();
	}

	public function get_max_min($id_kriteria)
	{
		$query = $this->db->query("SELECT max(sub_kriteria.nilai) as max, min(sub_kriteria.nilai) as min, sub_kriteria.nilai as nilai, 
			kriteria.jenis FROM `penilaian` 
			JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria 
			JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria 
			WHERE penilaian.id_kriteria='$id_kriteria'");
		return $query->row_array();
	}

	public function get_max_min_rekomendasi($id_kriteria)
	{
		$query = $this->db->query("SELECT max(sub_kriteria.rekomendasi) as max, min(sub_kriteria.rekomendasi) as min, sub_kriteria.rekomendasi as rekomendasi, 
			kriteria.jenis FROM `penilaian` 
			JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria 
			JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria 
			WHERE penilaian.id_kriteria='$id_kriteria'");
		return $query->row_array();
	}

	public function get_min_b()
	{
		$query = $this->db->query("SELECT min(nilai) as min_b FROM nilai_b");
		return $query->row_array();
	}

	public function get_min_c()
	{
		$query = $this->db->query("SELECT min(nilai) as min_c FROM nilai_c");
		return $query->row_array();
	}

	public function get_min_bc()
	{
		$query = $this->db->query("SELECT min(nilai) as min_bc FROM nilai_bc");
		return $query->row_array();
	}

	public function get_hasil()
	{
		$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY nilai DESC LIMIT 3;");
		return $query->result();
	}

	public function get_rank1()
	{
		$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY nilai DESC LIMIT 1;");
		return $query->row_array();
	}

	public function insert_nilai_bc($n_bc = [])
	{
		$result = $this->db->insert('nilai_bc', $n_bc);
		return $result;
	}

	public function hapus_nilai_bc()
	{
		$query = $this->db->query("TRUNCATE TABLE nilai_bc;");
		return $query;
	}

	public function insert_nilai_c($n_c = [])
	{
		$result = $this->db->insert('nilai_c', $n_c);
		return $result;
	}

	public function hapus_nilai_c()
	{
		$query = $this->db->query("TRUNCATE TABLE nilai_c;");
		return $query;
	}

	public function insert_nilai_b($n_b = [])
	{
		$result = $this->db->insert('nilai_b', $n_b);
		return $result;
	}

	public function hapus_nilai_b()
	{
		$query = $this->db->query("TRUNCATE TABLE nilai_b;");
		return $query;
	}

	public function insert_nilai_hasil($hasil_akhir = [])
	{
		$result = $this->db->insert('hasil', $hasil_akhir);
		return $result;
	}

	public function update_rekomendasi_hasil($id_alternatif, $rekomendasi)
	{
		$result = $this->db->query("UPDATE hasil SET rekomendasi = '$rekomendasi' WHERE hasil.id_alternatif = '$id_alternatif';");
		return $result;
	}

	public function hapus_hasil()
	{
		$query = $this->db->query("TRUNCATE TABLE hasil;");
		return $query;
	}

	public function get_hasil_rekomendasi_tertinggi()
	{
		$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY rekomendasi DESC LIMIT 1;");
		return $query->row_array();
	}

	public function get_hasil_rekomendasi_2_3()
	{
		$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif = alternatif.id_alternatif WHERE rekomendasi NOT IN (SELECT MAX(rekomendasi) FROM hasil) ORDER BY rekomendasi DESC LIMIT 2;");
		return $query->result_array();
	}
}
