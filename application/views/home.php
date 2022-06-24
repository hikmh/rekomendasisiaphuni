<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<title>Sistem Pendukung Keputusan Metode ROC dan OCRA</title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="<?= base_url('assets/') ?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= base_url('assets/') ?>img/favicon.ico" type="image/x-icon">
</head>

<body>
<!-- <body class="bg-gradient-warning bg-opacity-75"> -->
	<!-- <nav class="navbar navbar-expand-lg navbar-dark py-1 font-weight-bold alert-warning shadow-lg"> -->
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container d-flex bd-highlight">
			<!-- <a class="p-2 flex-grow-1 bd-highlight navbar-brand text-dark" href="<?= base_url('/'); ?>"> <i class="fas fa-fw fa-database rotate-n-15 mr-1"></i>SPK Pemilihan Perumahan Terbaik Metode ROC & OCRA </a> -->
			<a class="p-2 flex-grow-1 bd-highlight navbar-brand text-dark" href="<?= base_url('/'); ?>"> <i class="fas fa-fw fa-database rotate-n-15 mr-1"></i>SIPEKA</a>

			<button class="bg-info navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="p-2 bd-highlight collapse navbar-collapse" style="flex-grow: 0;" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="<?= base_url('Login/login'); ?>" class="btn btn-primary btn-md" role="button" aria-disabled="true">Primary link</a>

						<!-- <a class="text-dark nav-link active" href="<?= base_url('Login/login'); ?>">Login </a> -->
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container py-5">
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body  p-5">
						<div class="row">
							<?php if ($nilai) {

								$this->Pesan_model->tambah_responden($nama, $email);
								$newResponden = $this->Pesan_model->get_spesific_responden($nama, $email);

								$min_b = $this->Perhitungan_model->get_min_b();
								$min_c = $this->Perhitungan_model->get_min_c();
								$min_bc = $this->Perhitungan_model->get_min_bc();

								foreach ($nilai as $element) :
									$this->Pesan_model->tambah_pesan($newResponden['id_responden'], $element);
									$data_spesific = $this->Sub_Kriteria_model->get_spesific_sub_kriteria($element);
									$data_lain = $this->Sub_Kriteria_model->get_other_sub_kriteria($data_spesific['id_kriteria'], $element);
									$jumlah_data_lain = $this->Sub_Kriteria_model->count_other_sub_kriteria($data_spesific['id_kriteria'], $element);
									if ($data_spesific['jenis'] == 'Benefit') {
										$jumlah_data_lain = $this->Sub_Kriteria_model->count_other_sub_kriteria($data_spesific['id_kriteria'], $element);
										$i = $jumlah_data_lain['jumlah'];
										$this->Sub_Kriteria_model->update_rekomendasi_sub_kriteria($element, $i + 1);
										foreach ($data_lain as $element1) :
											$this->Sub_Kriteria_model->update_rekomendasi_sub_kriteria($element1['id_sub_kriteria'], $i);
											$i--;
										endforeach;
									}
									if ($data_spesific['jenis'] == 'Cost') {
										$i = 2;
										$this->Sub_Kriteria_model->update_rekomendasi_sub_kriteria($element, $i - 1);
										foreach ($data_lain as $element1) :
											$this->Sub_Kriteria_model->update_rekomendasi_sub_kriteria($element1['id_sub_kriteria'], $i);
											$i++;
										endforeach;
									}
								endforeach;
								foreach ($alternatif as $keys) :
									$t_c = 0;
									$t_b = 0;
									foreach ($kriteria as $key) :
										$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
										$min_max = $this->Perhitungan_model->get_max_min_rekomendasi($key->id_kriteria);
										if ($min_max['jenis'] == 'Cost') {
											$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['rekomendasi']) / $min_max['min']));
											$t_c += $nilai_c;
										}
										if ($min_max['jenis'] == 'Benefit') {
											$nilai_b = @($key->bobot * (($data_pencocokan['rekomendasi'] - $min_max['min']) / $min_max['min']));
											$t_b += $nilai_b;
										}
									endforeach;
									$n_c = number_format(abs($t_c - $min_c['min_c']), 4);
									$n_b = number_format(abs($t_b - $min_b['min_b']), 4);
									$n_p = number_format(abs($n_c + $n_b), 4) - number_format($min_bc['min_bc'], 4);

									$this->Perhitungan_model->update_rekomendasi_hasil($keys->id_alternatif, $n_p);
								endforeach; ?>
								<div class="col-12 mt-3">
									<div class="alert alert-warning text-center"><b>Rekomendasi Perumahan Terbaik-1</b></div>
									<div class="text-center mb-4">
										<?php
										$rank1 = $this->Perhitungan_model->get_hasil_rekomendasi_tertinggi();
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
											<thead class="bg-warning text-white">
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
												$no = 2;
												$hasil_rekomendasi = $this->Perhitungan_model->get_hasil_rekomendasi_2_3();
												foreach ($hasil_rekomendasi as $keys) :
												?>
													<tr align="center">
														<td><?= $no; ?></td>
														<td class="text-left"><?= $keys['nama'] ?></td>
														<td><?= $keys['nilai'] ?></td>
														<td><?= $no; ?></td>
														<td>
															<div class="btn-group" role="group">
																<a data-toggle="tooltip" data-placement="bottom" title="Detail Data" href="<?= base_url('Login/detail/' . $keys['id_alternatif']) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail Data</a>
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
							<?php } else { ?>
						</div>
						<div class="text-center">
							<a data-toggle="modal" class="btn btn-warning btn-block text-dark bd-highlight " href="#rekomendasi"><i class="fas fa-fw fa-search"></i><b> PILIH UNTUK MELAKUKAN REKOMENDASI PERUMAHAN</a>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade bg-warning" id="rekomendasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 align="center" class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Silahkan Mengisi Form Rekomendasi Perumahan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<?= form_open('Login') ?>
				<div class="modal-body">
					<label class="font-weight-bold" for="nama">Nama</label>
					<input class="form-control" type="text" name="nama" required>
					<label class="font-weight-bold mt-3" for="email">Email</label>
					<input class="form-control mb-3" type="email" name="email" required>
					<?php foreach ($kriteria as $key) : ?>
						<?php
						$sub_kriteria = $this->Penilaian_model->data_sub_kriteria($key->id_kriteria);
						?>
						<?php if ($sub_kriteria != NULL) : ?>
							<div class="form-group">
								<label class="font-weight-bold" for="<?= $key->id_kriteria ?>"><?= $key->keterangan ?></label>
								<select name="nilai[]" class="form-control" id="<?= $key->id_kriteria ?>" required>
									<option value="">--Pilih--</option>
									<?php foreach ($sub_kriteria as $subs_kriteria) : ?>
										<option value="<?= $subs_kriteria['id_sub_kriteria'] ?>"><?= $subs_kriteria['deskripsi'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						<?php endif ?>
					<?php endforeach ?>
					<!-- <p><b>Masukkan Tingkat Kepentingan Dari Setiap Kriteria (nilai 1 = sangat penting).</b></p>
						<?php foreach ($kriteria as $key) : ?>
							<div class="col-lg-10 py-2">
								<div class="row">
									<div class="col-lg-5">
										<?= $key->keterangan ?>
									</div>
									<div class="col">
										:
									</div>
									<div class="col-lg-6">
										<select name="nilai[]" class="form-control" id="<?= $key->id_kriteria ?>" required>
											<option value="">Pilih</option>
											<option value="">1</option>
											<option value="">2</option>
											<option value="">3</option>
											<option value="">4</option>
											<option value="">5</option>
											<option value="">6</option>
											<option value="">7</option>

										</select>
									</div>
								</div>
							</div>
						<?php endforeach ?>
						<p><b>Apakah Investasi ini akan menguntungkan jika nilainya semakin besar (lengkap)?</b></p>
						<?php foreach ($kriteria as $key) : ?>
							<div class="col-lg-10 py-2">
								<div class="row">
									<div class="col-lg-5">
										<?= $key->keterangan ?>
									</div>
									<div class="col">
										:
									</div>
									<div class="col-lg-6">
										<select name="nilai[]" class="form-control" id="<?= $key->id_kriteria ?>" required>
											<option value="">Pilih</option>
											<option value="">Ya</option>
											<option value="0">Tidak</option>
										</select>
									</div>
								</div>
							</div>
						<?php endforeach ?> -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Hitung</button>
				</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
</body>

</html>