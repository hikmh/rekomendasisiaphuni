<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
</div>

<div class="card shadow mb-4">

	<div class="card-body">
		<div class="alert alert-danger text-center"><b>Rekomendasi Perumahan Terbaik-1</b></div>
		<div class="text-center mb-4">
			<?php
			$rank1 = $this->Perhitungan_model->get_rank1();
			if (!empty($rank1['gambar'])) {
			?>
				<img src="<?= base_url('assets/upload/' . $rank1['gambar']) ?>" width="250px" />
			<?php
			} else {
				echo "Tidak Ada Gambar";
			}
			?>
		</div>
		<div class="text-center mb-4">
			Lokasi : <a href="<?= $rank1['lokasi'] ?>"><?= $rank1['lokasi'] ?></a>
		</div>
		<div class="row mb-4">
			<div class="col-lg-6 py-2">
				<div class="row">
					<div class="col-lg-6">
						Nama
					</div>
					<div class="col-lg-6">
						: <?= $rank1['nama'] ?>
					</div>
					<div class="col-lg-6">
						Kategori
					</div>
					<div class="col-lg-6">
						: <?= $rank1['kategori'] ?>
					</div>
					<div class="col-lg-6">
						Harga
					</div>

					<div class="col-lg-6">
						: <?= $rank1['harga'] ?>
					</div>
					<div class="col-lg-6">
						Angsuran
					</div>

					<div class="col-lg-6">
						: <?= $rank1['angsuran'] ?>
					</div>
					<div class="col-lg-6">
						Tipe Rumah
					</div>

					<div class="col-lg-6">
						: <?= $rank1['tipe'] ?>
					</div>
					<div class="col-lg-6">
						Luas Tanah
					</div>
					<div class="col-lg-6">
						: <?= $rank1['luastanah'] ?>
					</div>
					<div class="col-lg-6">
						Listrik
					</div>
					<div class="col-lg-6">
						: <?= $rank1['listrik'] ?>
					</div>
					<div class="col-lg-6">
						Sumber Air
					</div>
					<div class="col-lg-6">
						: <?= $rank1['air'] ?>
					</div>
					<div class="col-lg-6">
						Jalan
					</div>
					<div class="col-lg-6">
						: <?= $rank1['jalan'] ?>
					</div>
					<div class="col-lg-6">
						Keamanan
					</div>
					<div class="col-lg-6">
						: <?= $rank1['keamanan'] ?>
					</div>
					
				</div>
			</div>
		</div>


		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Nilai Preferensi</th>
						<th width="15%">Peringkat</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($hasil as $keys) :
						if ($no > "1") {
					?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td class="text-left"><?= $keys->nama ?></td>
								<td><?= $keys->nilai ?></td>
								<td><?= $no; ?></td>
								<td>
									<div class="btn-group" role="group">
										<a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('Perhitungan/detail/' . $keys->id_alternatif) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail Data</a>
									</div>
								</td>
							</tr>
					<?php
						}
						$no++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>