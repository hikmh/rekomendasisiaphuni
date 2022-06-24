<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesan_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->get('penilaian');
        return $query->result();
    }


    public function tambah_pesan($id_responden, $id_sub_kriteria)
    {
        $query = $this->db->simple_query("INSERT INTO pesan (id_pesan, id_responden, id_sub_kriteria) VALUES (DEFAULT, '$id_responden', '$id_sub_kriteria');");
        return $query;
    }

    public function edit_pesan($id_alternatif, $id_kriteria, $nilai)
    {
        $query = $this->db->simple_query("UPDATE penilaian SET nilai=$nilai WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        return $query;
    }

    public function delete($id_responden)
    {
        $this->db->where('id_responden', $id_responden);
        $this->db->delete('responden');
    }

    public function tambah_responden($nama, $email)
    {
        $query = $this->db->simple_query("INSERT INTO responden VALUES (DEFAULT,'$nama','$email');");
        return $query;
    }

    public function get_responden()
    {
        $query = $this->db->query("SELECT * FROM responden;");
        return $query->result_array();
    }

    public function get_spesific_responden($nama, $email)
    {
        $result = $this->db->query("SELECT * FROM responden WHERE nama = '$nama' AND email = '$email';");
        return $result->row_array();
    }

    public function get_spesific_sub_kriteria($id_sub_kriteria)
    {
        $result = $this->db->query("SELECT * FROM sub_kriteria WHERE id_sub_kriteria = '$id_sub_kriteria'");
        return $result->row_array();
    }

    public function get_spesific_pesan($id_responden)
    {
        $result = $this->db->query("SELECT * FROM pesan WHERE id_responden = '$id_responden'");
        return $result->result_array();
    }

    public function get_kriteria()
    {
        $query = $this->db->get('kriteria');
        return $query->result_array();
    }

    public function get_alternatif()
    {
        $query = $this->db->query("SELECT * FROM alternatif");
        return $query->result();
    }

    public function get_sub_kriteria()
    {
        $query = $this->db->get('sub_kriteria');
        return $query->result();
    }

    public function data_penilaian($id_alternatif, $id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        return $query->row_array();
    }
    public function untuk_tombol($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif';");
        return $query->num_rows();
    }
    public function data_sub_kriteria($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai DESC;");
        return $query->result_array();
    }
    public function data_nilai($id_alternatif, $id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
        return $query->row_array();
    }

    // Edit
    public function data_ket($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM kriteria WHERE kriteria.id_kriteria='$id_kriteria';");
        return $query->row_array();
    }
    //hapus
    
    
}
