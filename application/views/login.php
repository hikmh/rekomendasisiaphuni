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

<body class="bg-gradient-info">
<!--     <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
        <div class="container">
            <a class="navbar-brand text-info" style="font-weight: 900;" href="<?= base_url('') ?>"> <i class="fa fa-database mr-2 rotate-n-15"></i> Sistem Pendukung Keputusan Pemilihan Perumahan Terbaik Menggunakan ROC OCRA</a>
        </div>
    </nav>
 -->
    <div class="container">
        <!-- Outer Row -->
         <div class="row d-plex justify-content-between" >
            <!--<div class="col-xl-6 col-lg-6 col-md-6 mt-5">
                <div class="card bg-none o-hidden border-0 my-5 text-white" style="background: none;">
                    <div class="text-justify card-body p-0">
                        
                        <center>
                            <img src="<?= base_url('assets/') ?>img/perumahan.jpg" width="100%">
                        </center>
                    </div>
                </div>
            </div> -->

            <div class="mx-auto mt-4" >
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="height: 80vh; ">
                            <div class="col-xl-6 my-auto" style="border-radius: 859px !important;">
                                <center>
                                    <img src="<?= base_url('assets/') ?>img/perumahan2.jpg" height="100%">
                                </center>
                            </div>
                            <div class="col-xl-6 my-auto">
                                <div class="p-5">
                                    <div class="text-center pb-3">
                                        <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                                        <p style="margin-top: -12px">lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                                    </div>
                                    <?php $error = $this->session->flashdata('message');
                                    if ($error) { ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?php echo $error; ?>
                                        </div>
                                    <?php } ?>

                                    <form class="user" action="<?php echo site_url('Login/login_proses'); ?>" method="post">
                                        <div class="form-group">
                                            <input required autocomplete="off" style="border-radius: 8px;"  type="text" class="form-control form-control-user" id="exampleInputUser" placeholder="Username" name="username" />
                                        </div>
                                        <div class="form-group" style="padding-bottom : 5px;">
                                            <input required autocomplete="off" style="border-radius: 8px" type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" />
                                        </div>
                                        <button name="submit" type="submit" class="btn mx-auto col-6 btn-info btn-user btn-block" style="border-radius: 8px;"><!-- <i class="fas fa-fw fa-sign-in-alt mr-1"></i> -->  Masuk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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