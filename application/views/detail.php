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
        <link href="<?= base_url('assets/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        <!-- Custom styles for this template-->
        <link href="<?= base_url('assets/')?>css/sb-admin-2.min.css" rel="stylesheet" />
		<link rel="shortcut icon" href="<?= base_url('assets/')?>img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?= base_url('assets/')?>img/favicon.ico" type="image/x-icon">
    </head>

    <body class="bg-gradient-info">
        <nav class="navbar navbar-expand-lg navbar-dark py-2 font-weight-bold bg-white shadow-lg">
			<div class="container d-flex bd-highlight">
				<a class="p-2 flex-grow-1 bd-highlight navbar-brand text-dark" href="<?= base_url('/');?>"> <i class="fas fa-fw fa-database rotate-n-15 mr-1"></i>SPK Pemilihan Perumahan Terbaik Menggunakan ROC & OCRA </a>
				<button class="bg-info navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="p-2 bd-highlight collapse navbar-collapse" style="flex-grow: 0;" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="text-dark nav-link active" href="<?= base_url('Login/login');?>"> <i class="fas fa-fw fa-sign-in-alt mr-1"></i>Login </a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-5">
							<b>Detail Data</b><hr/>
							<div class="table-responsive">
								<table class="table table-bordered" width="100%" cellspacing="0">
									<thead class="bg-info text-white">
										<tr align="center">
											<th>No</th>
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
											<td><?= $detail['kategori'] ?></td>
											<td><?= $detail['harga'] ?></td>
											<td><?= $detail['angsuran'] ?></td>
											<td><?= $detail['tipe'] ?></td>
											<td><?= $detail['luastanah'] ?></td>
											<td><?= $detail['listrik'] ?></td>
											<td><?= $detail['air'] ?></td>
											<td><?= $detail['jalan'] ?></td>
											<td><?= $detail['keamanan'] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/')?>js/sb-admin-2.min.js"></script>
    </body>
</html>