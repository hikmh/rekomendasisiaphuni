<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriteria as $key) : ?>
							<th><?= $key->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php foreach ($kriteria as $key) : ?>
								<td>
									<?php
									$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
									echo $data_pencocokan['nilai'];
									?>
								</td>
							<?php endforeach ?>
						</tr>
					<?php
						$no++;
					endforeach
					?>
					<tr align="center">
						<th colspan="2" class="bg-light">MAX</th>
						<?php foreach ($kriteria as $key) : ?>
							<th class="bg-light">
								<?php
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								echo $min_max['max'];
								?>
							</th>
						<?php endforeach ?>
					</tr>
					<tr align="center">
						<th colspan="2" class="bg-light">MIN</th>
						<?php foreach ($kriteria as $key) : ?>
							<th class="bg-light">
								<?php
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								echo $min_max['min'];
								?>
							</th>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Bobot Preferensi (W)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<?php foreach ($kriteria as $key) : ?>
							<th><?= $key->kode_kriteria ?> (<?= $key->jenis ?>)</th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriteria as $key) : ?>
							<td>
								<?php
								echo $key->bobot;
								?>
							</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Menghitung Peringkat Preferensi (Cost)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>
							<?php
							foreach ($kriteria as $key) :
								if ($key->jenis == "Cost") {
									echo "(" . $key->kode_kriteria . ") ";
								}
							endforeach;
							?>
						</th>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<td>SUM
								<?php
								$t_c = 0;
								foreach ($kriteria as $key) :
									$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
									$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
									if ($min_max['jenis'] == 'Cost') {
										$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
										echo "(" . number_format($nilai_c, 4) . ") ";
										$t_c += $nilai_c;
									}
								endforeach;
								?>
							</td>
							<td><?= number_format($t_c, 4); ?></td>
						</tr>
					<?php
						$no++;
					endforeach ?>
					<tr align="center">
						<th colspan="3" class="bg-light">
							Nilai MIN
						</th>
						<th class="bg-light">
							<?php
							$min_c = $this->Perhitungan_model->get_min_c();
							echo number_format($min_c['min_c'], 4);
							?>
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Menghitung Peringkat Preferensi Linear Setiap Alternatif (Cost)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Total Nilai - Nilai MIN</th>
						<th>Nilai I</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php
							$t_c = 0;
							foreach ($kriteria as $key) :
								$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								if ($min_max['jenis'] == 'Cost') {
									$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
									$t_c += $nilai_c;
								}
							endforeach;
							?>
							<td>(<?= number_format($t_c, 4); ?>) - (<?= number_format($min_c['min_c'], 4) ?>)</td>
							<td><?= number_format(abs($t_c - $min_c['min_c']), 4); ?></td>
						</tr>
					<?php
						$no++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Menghitung Peringkat Preferensi (Benefit)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>
							<?php
							foreach ($kriteria as $key) :
								if ($key->jenis == "Benefit") {
									echo "(" . $key->kode_kriteria . ") ";
								}
							endforeach;
							?>
						</th>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<td>SUM
								<?php
								$t_b = 0;
								foreach ($kriteria as $key) :
									$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
									$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
									if ($min_max['jenis'] == 'Benefit') {
										$nilai_b = @($key->bobot * ((  $data_pencocokan['nilai']-$min_max['min']) / $min_max['min']));
										echo "(" . number_format($nilai_b, 4) . ") ";
										$t_b += $nilai_b;
									}
								endforeach;
								?>
							</td>
							<td><?= number_format($t_b, 4); ?></td>
						</tr>
					<?php
						$no++;
					endforeach ?>
					<tr align="center">
						<th colspan="3" class="bg-light">
							Nilai MIN
						</th>
						<th class="bg-light">
							<?php
							$min_b = $this->Perhitungan_model->get_min_b();
							echo number_format($min_b['min_b'], 4);
							?>
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Menghitung Peringkat Preferensi Linear Setiap Alternatif (Benefit)</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Total Nilai - Nilai MIN</th>
						<th>Nilai Q</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php
							$t_b = 0;
							foreach ($kriteria as $key) :
								$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								if ($min_max['jenis'] == 'Benefit') {
									$nilai_b = @($key->bobot * ((  $data_pencocokan['nilai']-$min_max['min']) / $min_max['min']));
									$t_b += $nilai_b;
								}
							endforeach;
							?>
							<td>(<?= number_format($t_b, 4); ?>) - (<?= number_format($min_b['min_b'], 4) ?>)</td>
							<td><?= number_format(abs($t_b - $min_b['min_b']), 4); ?></td>
						</tr>
					<?php
						$no++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Melakukan Penjumlahan Nilai I dengan Nilai Q</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Nilai I + Nilai Q</th>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php
							$t_c = 0;
							$t_b = 0;
							foreach ($kriteria as $key) :
								$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								if ($min_max['jenis'] == 'Cost') {
									$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
									$t_c += $nilai_c;
								}
								if ($min_max['jenis'] == 'Benefit') {
									$nilai_b = @($key->bobot * ((  $data_pencocokan['nilai']-$min_max['min']) / $min_max['min']));
									$t_b += $nilai_b;
								}
							endforeach;
							$n_c = number_format(abs($t_c - $min_c['min_c']), 4);
							$n_b = number_format(abs($t_b - $min_b['min_b']), 4);
							?>
							<td>(<?= number_format($n_c, 4); ?>) + (<?= number_format($n_b, 4) ?>)</td>
							<td><?= number_format(abs($n_c + $n_b), 4); ?></td>
						</tr>
					<?php
						$no++;
					endforeach ?>
					<tr align="center">
						<th colspan="3" class="bg-light">
							Nilai MIN
						</th>
						<th class="bg-light">
							<?php
							$min_bc = $this->Perhitungan_model->get_min_bc();
							echo number_format($min_bc['min_bc'], 4);
							?>
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-info"><i class="fa fa-table"></i> Menghitung Nilai Preferensi Total Setiap Alternatif</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Total Nilai - Nilai MIN</th>
						<th>Nilai Preferensi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$this->Perhitungan_model->hapus_hasil();
					$no = 1;
					foreach ($alternatif as $keys) : ?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td align="left"><?= $keys->nama ?></td>
							<?php
							$t_c = 0;
							$t_b = 0;
							foreach ($kriteria as $key) :
								$data_pencocokan = $this->Perhitungan_model->data_nilai($keys->id_alternatif, $key->id_kriteria);
								$min_max = $this->Perhitungan_model->get_max_min($key->id_kriteria);
								if ($min_max['jenis'] == 'Cost') {
									$nilai_c = @($key->bobot * (($min_max['max'] - $data_pencocokan['nilai']) / $min_max['min']));
									$t_c += $nilai_c;
								}
								if ($min_max['jenis'] == 'Benefit') {
									$nilai_b = @($key->bobot * (( $data_pencocokan['nilai']-$min_max['min'] ) / $min_max['min']));
									$t_b += $nilai_b;
								}
							endforeach;
							$n_c = number_format(abs($t_c - $min_c['min_c']), 4);
							$n_b = number_format(abs($t_b - $min_b['min_b']), 4);
							?>
							<td>(<?= number_format(abs($n_c + $n_b), 4); ?>) - (<?= number_format($min_bc['min_bc'], 4); ?>)</td>
							<td><?= $n_p = number_format(abs($n_c + $n_b), 4) - number_format($min_bc['min_bc'], 4); ?></td>
						</tr>
					<?php
						$hasil_akhir = [
							'id_alternatif' => $keys->id_alternatif,
							'nilai' => $n_p
						];
						$this->Perhitungan_model->insert_nilai_hasil($hasil_akhir);
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