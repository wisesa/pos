<html lang="en" class="h-100">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>asset/css/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url() ?>">
      <img class="icon-logo" src="<?php echo base_url().'asset/img/logo.png'; ?>" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if(isset($_SESSION['user_type'])){ ?>
            <?php if($_SESSION['user_type']=='administrator'){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'kategori'; ?>">Kategori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'produkc'; ?>">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'user/index/petugas'; ?>">Petugas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'user/index/supplier'; ?>">Supplier</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'user/index/pelanggan'; ?>">Pelanggan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'pembelian'; ?>">Pembelian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'pembelian/list_per_produk'; ?>">Pembelian Per Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'penjualan'; ?>">Penjualan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'penjualan/list_per_produk'; ?>">Penjualan Per Produk</a>
            </li>
            <?php } ?>
        <?php } ?>

        <?php if(isset($_SESSION['user_type'])){ ?>
            <?php if($_SESSION['user_type']=='petugas'){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'kategori'; ?>">Kategori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'produkc'; ?>">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'pembelian'; ?>">Pembelian</a>
            </li>
            <?php } ?>
        <?php } ?>

        <?php if(isset($_SESSION['user_type'])){ ?>
            <?php if($_SESSION['user_type']=='pelanggan'){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'penjualan/add'; ?>">Belanja</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url().'penjualan'; ?>">Riwayat Transaksi</a>
            </li>
            <?php } ?>
        <?php } ?>

      </ul>
      <div>
        <?php if( (!isset($_SESSION['user_type'])) ){ ?>
        <a href="<?php echo base_url().'auth/logout'; ?>" class="icon-nav">
          <img src="<?php echo base_url().'asset/img/login.png'; ?>" class="icon-nav" />&nbsp;&nbsp;Login
        </a>
        <?php } else{ ?>
        <span class="nama"><?php echo ucwords($_SESSION['nama']) ?> (<?php echo ucwords($_SESSION['user_type']) ?>)</span>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo base_url().'auth/logout'; ?>" class="icon-nav">
          <img src="<?php echo base_url().'asset/img/logout.png'; ?>" class="icon-nav" />&nbsp;&nbsp;Logout
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>