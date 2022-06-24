<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

	<a href="<?= base_url('Alternatif'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-plus"></i> Tambah Data Alternatif</h6>
    </div>
	
	<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Alternatif/store">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Nama Alternatif</label>
					<input autocomplete="off" type="text" name="nama" required class="form-control"/>
				</div>
				
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Lokasi</label>
					<input autocomplete="off" type="text" name="lokasi" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Kategori</label>
					<input autocomplete="off" type="text" name="kategori" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Harga</label>
					<input autocomplete="off" type="text" name="harga" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Angsuran</label>
					<input autocomplete="off" type="text" name="angsuran" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Tipe Rumah</label>
					<input autocomplete="off" type="text" name="tipe" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Luas Tanah</label>
					<input autocomplete="off" type="text" name="luastanah"  required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Listrik</label>
					<input autocomplete="off" type="text" name="listrik"  required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Air</label>
					<input autocomplete="off" type="text" name="air"required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Jalan</label>
					<input autocomplete="off" type="text" name="jalan" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label class="font-weight-bold">Keamanan</label>
					<input autocomplete="off" type="text" name="keamanan" required class="form-control"/>
				</div>
				<div class="form-group col-md-4">
					<label for="image" class="font-weight-bold">Gambar <small class="text-danger">(.png/.jpg/.gif)</small></label>
					<input required type="file" class="form-control" accept="application/pdf, image/png, image/jpg, image/jpeg, image/gif" name="filefoto"> 
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
        </div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>