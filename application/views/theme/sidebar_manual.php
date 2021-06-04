<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Pustaka <sup>App</sup></div>
  </a>

  <?php if($this->session->userdata('type') == 'anggota'):?>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('peminjaman_saya/read');?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Peminjaman Saya</span>
    </a>
  </li>
  <?php endif;?>


  <?php if($this->session->userdata('type') == 'petugas'):?>
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo site_url('dashboard/index');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('peminjaman/read');?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Input Peminjaman</span>
    </a>
  </li>

  <div class="sidebar-heading">
    Laporan
  </div>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('grafik/rekap_peminjaman');?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Grafik Peminjaman</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('laporan/rekap_peminjaman');?>">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Laporan Peminjaman</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('laporan/detail_peminjaman');?>">
      <i class="fas fa-fw fa-list"></i>
      <span>Detail Peminjaman</span>
    </a>
  </li>

  <div class="sidebar-heading">
    Setting
  </div>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('buku/read');?>">
      <i class="fas fa-fw fa-book"></i>
      <span>Buku</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('anggota/read');?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Anggota</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('petugas/read');?>">
      <i class="fas fa-fw fa-user-circle"></i>
      <span>Petugas</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('api_client/rajaongkir');?>">
      <i class="fas fa-fw fa-truck"></i>
      <span>API RajaOngkir</span></a>
  </li>
  <?php endif;?>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>