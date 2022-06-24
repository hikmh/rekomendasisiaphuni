<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Alternatif_model');
        $this->load->model('Pesan_model');

        if ($this->session->userdata('id_user_level') != "1") {
?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location = '<?php echo base_url("Login/home"); ?>'
            </script>
<?php
        }
    }

    public function index()
    {
        $data = [
            'page' => "Pesan",
            'kriteria' => $this->Pesan_model->get_kriteria(),
            'list' => $this->Alternatif_model->tampil(),
            'responden' => $this->Pesan_model->get_responden()
        ];
        $this->load->view('pesan/index', $data);
    }

    public function tambah_pesan()
    {
        $id_pesan = $this->input->post('id_pesan');
        $id_kriteria = $this->input->post('id_kriteria');
        $nilai = $this->input->post('nilai');
        $i = 0;
        echo var_dump($nilai);
        foreach ($nilai as $key) {
            $this->Penilaian_model->tambah_penilaian($id_pesan, $id_kriteria[$i], $key);
            $i++;
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        redirect('penilaian');
    }
    public function destroy($id_responden)
    {
        $this->Pesan_model->delete($id_responden);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('Pesan');
    }
}
