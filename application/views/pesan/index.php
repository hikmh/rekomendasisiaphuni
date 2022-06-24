<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Pesan Dari User</h1>

	
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Daftar Pesan</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama </th>
						<th>Email</th>
						<?php
						foreach ($kriteria as $key) : ?>
							<th>
								<?= $key['keterangan'] ?>
							</th>
						<?php
						endforeach ?>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($responden as $respon) : ?>
						<tr align="center">
							<td><?= $no ?>.</td>
							<td><a><?= $respon['nama'] ?></a></td>
							<td><a><?= $respon['email'] ?></a></td>
							<?php
							$massages = $this->Pesan_model->get_spesific_pesan($respon['id_responden']);
							foreach ($massages as $massage) :
								$sub_kriteria = $this->Pesan_model->get_spesific_sub_kriteria($massage['id_sub_kriteria']);
							?>
								<td><a><?= $sub_kriteria['deskripsi'] ?></a></td>
							<?php
							endforeach ?>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?= base_url('Alternatif/edit/' . $respon['id_responden']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?= base_url('pesan/destroy/' . $respon['id_responden']) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
					<?php
						$no++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>