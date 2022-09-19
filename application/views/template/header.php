<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/bs5-beta/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link type="text/css" href="<?= base_url(); ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/chartist/dist/chartist.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/niceselect/css/nice-select2.css">
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/logo.png" />
    <title class="text-uppercase">Dashboard - <?= $this->uri->segment(1); ?></title>
</head>

<body>
    <div class="container-fluid h100vh poppins-light bg-container">
        <div class="row ">
            <!-- Sidebar -->
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5 d-none d-sm-block d-md-block d-lg-block"></div>
            <div class="responsive-sidebar position-fixed col-xl-2 col-lg-3 col-md-3 col-sm-4 d-sm-block d-md-block d-lg-block bg-danger h100vh border-end border-0 z-1">
                <div class="p-1 mt-2 text-center">
                    <div class="place-center">
                        <div class="row pb-5 text-end text-white d-block d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none"><i class="fa fa-times fs-1" aria-hidden="true" onclick="closeSidebar()"></i></div>
                        <h3 class="dashboard-title poppins-md text-uppercase mb-5">Rekomendasi Outlet</h3>
                        <!-- Sidebar pilih kategori -->
                        <div class="row px-2">
                            <label for="" class="text-white text-start mb-1">Pilih Kategori : </label>
                            <select id="seachable-select" class="w-100 changeFunc" onchange="changeFunc(this);">
                                <option data-display="Select" disabled>Choose one</option>
                                <option value="kabupaten">Kabupaten</option>
                                <option value="kecamatan">Kecamatan</option>
                                <option value="kelurahan">Kelurahan</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <!-- Sidebar pilihan setelah kategori -->
                        <div class="row px-2 mt-3 selectboxChange d-none">
                            <label for="" class="text-white text-start mb-1">Pilih : </label>
                            <select id="seachable-select-two" class="w-100 selectbox-details">
                                <option data-display="Select" disabled>Type category first</option>
                            </select>
                        </div>
                        <div class="row px-2 mt-3 selectEfektivitas d-none">
                            <label for="" class="text-white text-start mb-1">Rekomendasi : </label>
                            <select id="seachable-select-three" class="w-100 selectbox-efektivitas" onchange="changeEfektivitas(this)">
                                <option data-display="Select" disabled>Type area first</option>
                                <option value="Ditambah">Ditambah</option>
                                <option value="Tetap">Tetap</option>
                                <option value="Dikurang">Dikurang</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Sidebar -->

            <!-- Navbar on Phone only-->
            <div class="px-0 d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none d-block">
                <nav class="navbar navbar-expand-lg bg-danger ps-3">
                    <a class="navbar-brand text-light poppins-md text-uppercase" href="#">Rekomendasi Outlet</a>
                    <!-- Button trigger modal -->
                    <a class="btn btn-transparent text-light" onclick="addSidebar()">
                        <span class="fas fa-bars fs-3"></span>
                    </a>
                </nav>
            </div>
            <!-- Enf of Navbar -->
            <!-- Content -->
            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-7 bg-container">
                <!-- Navbar Content -->
                <div class="position-fixed bg-container z-2 w-navbar msw-0 d-none d-sm-block d-md-block d-lg-block d-xl-block d-xxl-block">
                    <div class="position-relative">
                        <div id="navbar-change" class="">
                            <div class="row">
                                <div class="col-12">
                                    <span class="navbar-nav pe-5 float-end flex-row">
                                        
                                        <li class="nav-item dropdown me-0">
                                            <a class="bg-transparent nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?= base_url(); ?>/assets/kesehatan-icon.png" alt="profile-picture" class="rounded-circle img-profile-thumbnail">
                                                <span class="fs-7 text-grey d-lg-inline d-md-inline d-sm-none"><?= $this->session->userdata('nama_depan') . ' ' . $this->session->userdata('nama_belakang') ?></span>
                                            </a>
                                            <div class="dropdown-menu shadow rounded w-100 border-0" aria-labelledby="navbarDropdown">
                                                
                                                <a class="dropdown-item fs-7 text-grey" href="<?= site_url('auth/logout'); ?>"><span class="fas fa-sign-out-alt text-danger">&nbsp;</span> Logout</a>
                                            </div>
                                        </li>
                                    </span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>