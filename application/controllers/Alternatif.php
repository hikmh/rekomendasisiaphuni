<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Alternatif_model');

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
			'page' => "Alternatif",
			'list' => $this->Alternatif_model->tampil(),

		];
		$this->load->view('alternatif/index', $data);
	}

	//menampilkan view create
	public function create()
	{
		$data['page'] = "Alternatif";
		$this->load->view('alternatif/create', $data);
	}

	//menambahkan data ke database
	public function store()
	{
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			if (!$this->upload->do_upload('filefoto')) {
				$this->upload->display_errors();
			} else {
				$data = [
					'nama' => $this->input->post('nama'),
					'lokasi' => $this->input->post('lokasi'),
					'kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'angsuran' => $this->input->post('angsuran'),
					'tipe' => $this->input->post('tipe'),
					'luastanah' => $this->input->post('luastanah'),
					'listrik' => $this->input->post('listrik'),
					'air' => $this->input->post('air'),
					'jalan' => $this->input->post('jalan'),
					'keamanan' => $this->input->post('keamanan'),
					'gambar' => $this->upload->data('file_name')
				];

				$this->form_validation->set_rules('nama', 'Nama', 'required');
				if ($this->form_validation->run() != false) {
					$result = $this->Alternatif_model->insert($data);
					if ($result) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
						redirect('alternatif');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
					redirect('alternatif/create');
				}
			}
		}
	}

	public function edit($id_alternatif)
	{
		$alternatif = $this->Alternatif_model->show($id_alternatif);
		$data = [
			'page' => "Alternatif",
			'alternatif' => $alternatif
		];
		$this->load->view('alternatif/edit', $data);
	}

	public function update($id_alternatif)
	{
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!empty($_FILES['filefoto']['name'])) {
			if (!$this->upload->do_upload('filefoto')) {
				$this->upload->display_errors();
			} else {
				$id_alternatif = $this->input->post('id_alternatif');
				$image = $this->input->post('img');
				unlink("assets/upload/" . $image);
				$data = [
					'nama' => $this->input->post('nama'),
					'lokasi' => $this->input->post('lokasi'),
					'kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'angsuran' => $this->input->post('angsuran'),
					'tipe' => $this->input->post('tipe'),
					'luastanah' => $this->input->post('luastanah'),
					'listrik' => $this->input->post('listrik'),
					'air' => $this->input->post('air'),
					'jalan' => $this->input->post('jalan'),
					'keamanan' => $this->input->post('keamanan'),
					'gambar' => $this->upload->data('file_name')
				];
				$this->Alternatif_model->update_yes($id_alternatif, $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
				redirect('alternatif');
			}
		} else {
			$id_alternatif = $this->input->post('id_alternatif');
			$data = [
				'nama' => $this->input->post('nama'),
				'lokasi' => $this->input->post('lokasi'),
				'kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'angsuran' => $this->input->post('angsuran'),
				'tipe' => $this->input->post('tipe'),
				'luastanah' => $this->input->post('luastanah'),
				'listrik' => $this->input->post('listrik'),
				'air' => $this->input->post('air'),
				'jalan' => $this->input->post('jalan'),
				'keamanan' => $this->input->post('keamanan')
			];
			$this->Alternatif_model->update_no($id_alternatif, $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('alternatif');
		}
	}

	public function destroy($id_alternatif)
	{
		$alternatif = $this->Alternatif_model->show($id_alternatif);
		unlink("assets/upload/" . $alternatif->gambar);
		$this->Alternatif_model->delete($id_alternatif);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
		redirect('alternatif');
	}
}
