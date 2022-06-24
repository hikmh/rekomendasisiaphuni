<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->get('alternatif');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('alternatif');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('alternatif', $data);
        return $result;
    }

    public function show($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $query = $this->db->get('alternatif');
        return $query->row();
    }

    public function update_yes($id_alternatif, $data = [])
    {
        $ubah = array(
            'nama'  => $data['nama'],
            'lokasi'  => $data['lokasi'],
            'kategori'  => $data['kategori'],
            'harga'  => $data['harga'],
            'angsuran'  => $data['angsuran'],
            'tipe'  => $data['tipe'],
            'luastanah'  => $data['luastanah'],
            'listrik'  => $data['listrik'],
            'air'  => $data['air'],
            'keamanan' => $data['keamanan'],
            'jalan'  => $data['jalan'],
            'gambar'  => $data['gambar']

        );

        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->update('alternatif', $ubah);
    }

    public function update_no($id_alternatif, $data = [])
    {
        $ubah = array(
            'nama'  => $data['nama'],
            'lokasi'  => $data['lokasi'],
            'kategori'  => $data['kategori'],
            'harga'  => $data['harga'],
            'angsuran'  => $data['angsuran'],
            'tipe'  => $data['tipe'],
            'luastanah'  => $data['luastanah'],
            'listrik'  => $data['listrik'],
            'air'  => $data['air'],
            'keamanan' => $data['keamanan'],
            'jalan'  => $data['jalan']
        );

        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->update('alternatif', $ubah);
    }


    public function delete($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->delete('alternatif');
    }
}
