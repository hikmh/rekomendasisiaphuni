<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Perhitungan_model');
		
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
		$kriteria = $this->Perhitungan_model->get_kriteria();
		$alternatif = $this->Perhitungan_model->get_alternatif();

		$this->Perhitungan_model->hapus_nilai_b();
		$this->Perhitungan_model->hapus_nilai_c();
		$this->Perhitungan_model->hapus_nilai_bc();

		foreach ($alternatif as $keys) {
			$t_b = 0;
			$t_c = 0;
			foreach ($kriteria as $key) {
				$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
				$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
				if ($min_max['jenis'] == 'Benefit') {
					$nilai_b = @($key->bobot * (( $data_pencocokan['nilai']-$min_max['min'] ) / $min_max['min']));
					$t_b += $nilai_b;
				}
				if ($min_max['jenis'] == 'Cost') {
					$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
					$t_c += $nilai_c;
				}
			}

			$n_b = [
				'id_alternatif' => $keys->id_alternatif,
				'nilai' => number_format($t_b, 4),
			];
			$this->Perhitungan_model->insert_nilai_b($n_b);

			$n_c = [
				'id_alternatif' => $keys->id_alternatif,
				'nilai' => number_format($t_c, 4),
			];
			$this->Perhitungan_model->insert_nilai_c($n_c);
		}

		foreach ($alternatif as $keys) {
			$t_b = 0;
			$t_c = 0;
			foreach ($kriteria as $key) {
				$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
				$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
				if ($min_max['jenis'] == 'Benefit') {
					$nilai_b = @($key->bobot * (( $data_pencocokan['nilai']-$min_max['min'] ) / $min_max['min']));
					$t_b += $nilai_b;
				}
				if ($min_max['jenis'] == 'Cost') {
					$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
					$t_c += $nilai_c;
				}
			}
			$min_b = $this->Perhitungan_model->get_min_b();
			$min_c = $this->Perhitungan_model->get_min_c();
			$nilai_c = number_format(abs($t_c - $min_c['min_c']), 4);
			$nilai_b = number_format(abs($t_b - $min_b['min_b']), 4);

			$n_bc = [
				'id_alternatif' => $keys->id_alternatif,
				'nilai' => number_format(abs($nilai_c + $nilai_b), 4),
			];
			$this->Perhitungan_model->insert_nilai_bc($n_bc);
		}

		$data = [
			'page' => "Perhitungan",
			'kriteria' => $this->Perhitungan_model->get_kriteria(),
			'alternatif' => $this->Perhitungan_model->get_alternatif()
		];

		$this->load->view('Perhitungan/perhitungan', $data);
	}

	public function hasil()
	{
		$data = [
			'page' => "Hasil",
			'kriteria' => $this->Perhitungan_model->get_kriteria(),
			'hasil' => $this->Perhitungan_model->get_hasil()
		];

		$this->load->view('Perhitungan/hasil', $data);
	}

	public function detail($id_alternatif)
	{
		$detail = $this->Perhitungan_model->get_detail($id_alternatif);
		$data = [
			'page' => "Hasil",
			'detail' => $detail,
			'hasil' => $this->Perhitungan_model->get_hasil(),
			'kriteria' => $this->Perhitungan_model->get_kriteria()
		];

		$this->load->view('Perhitungan/detail', $data);
	}
}
