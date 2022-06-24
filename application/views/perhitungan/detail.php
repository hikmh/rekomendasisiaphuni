<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
	
	<a href="<?= base_url('Perhitungan/hasil'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fa fa-eye"></i> Detail Hasil</h6>
    </div>
	
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-info text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Alternatif</th>
						<th>Lokasi</th>
						<th>Kategori</th>
						<th>Harga</th>
						<th>Angsuran</th>
						<th>Tipe Rumah</th>
						<th>Luas Tanah</th>
						<th>Listrik</th>
						<th>Air</th>
						<th>Jalan</th>
						<th>Keamanan</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php
						$no=1;
						foreach ($hasil as $keys): 
						if($no > "1") {
							if($detail['id_alternatif'] == $keys->id_alternatif){
						?>
						<td><?= $no ?></td>
						<?php
						}
						}
						$no++;
						endforeach ?>
						<td><?= $detail['nama'] ?></td>
						<td><a href="<?= $detail['lokasi'] ?>"><?= $detail['lokasi'] ?></a></td>
						<td><a <?= $detail['kategori'] ?>"><?= $detail['kategori'] ?></a></td>
						<td><a <?= $detail['harga'] ?>"><?= $detail['harga'] ?></a></td>
						<td><a <?= $detail['angsuran'] ?>"><?= $detail['angsuran'] ?></a></td>
						<td><a <?= $detail['tipe'] ?>"><?= $detail['tipe'] ?></a></td>
						<td><a <?= $detail['luastanah'] ?>"><?= $detail['luastanah'] ?></a></td>
						<td><a <?= $detail['listrik'] ?>"><?= $detail['listrik'] ?></a></td>
						<td><a <?= $detail['air'] ?>"><?= $detail['air'] ?></a></td>
						<td><a <?= $detail['jalan'] ?>"><?= $detail['jalan'] ?></a></td>
						<td><a <?= $detail['keamanan'] ?>"><?= $detail['keamanan'] ?></a></td>
						
						
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>