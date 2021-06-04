<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url('assets/adminlte/dist/img/AdminLTELogo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Pustaka App</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <?php if($this->session->userdata('type') == 'anggota'):?>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo site_url('peminjaman_saya/read');?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Peminjaman Saya</span>
          </a>
        </li>
        <?php endif;?>

        <?php if($this->session->userdata('type') == 'admin'):?>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo site_url('dashboard/index');?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('api_client/rajaongkir');?>">
            <i class="fas fa-fw fa-truck"></i>
            <span>API RajaOngkir</span></a>
        </li>
        <?php endif;?>

        <?php if($this->session->userdata('type') == 'petugas'):?>
        <li class="nav-item ">
          <a class="nav-link active" href="<?php echo site_url('peminjaman/read');?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Peminjaman</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('pengembalian/read');?>">
            <i class="fas fa-fw fa-download"></i>
            <span>Pengembalian</span>
          </a>
        </li>
        <?php endif;?>

        <!-- Laporan -->
        <?php if($this->session->userdata('type') == 'petugas'):?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <p>Grafik <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('grafik/rekap_peminjaman');?>">
                <i class="far fa-circle nav-icon"></i>
                Rekap Peminjaman
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-fw fa-file"></i>
            <p>Laporan <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('laporan/rekap_peminjaman');?>">
                <i class="far fa-circle nav-icon"></i>
                Rekap Peminjaman
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('laporan/detail_peminjaman');?>"> 
                <i class="far fa-circle nav-icon"></i>
                Detail Peminjaman
              </a>
            </li>
          </ul>
        </li>
        <?php endif;?>

        <!-- Input -->
        <?php if($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'petugas'):?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-fw fa-cog"></i>
            <p>Setting <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">

            <?php if($this->session->userdata('type') == 'admin'):?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('user/read');?>">
                <i class="far fa-circle nav-icon"></i>
                User
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('petugas/read');?>">
                <i class="far fa-circle nav-icon"></i>
                Petugas
              </a>
            </li>
            <?php endif;?>

            <?php if($this->session->userdata('type') == 'petugas'):?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('anggota/read');?>">
                <i class="far fa-circle nav-icon"></i>
                Anggota
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('buku/read');?>">
                <i class="far fa-circle nav-icon"></i>
                Buku
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('kategori_buku/read');?>">
                <i class="far fa-circle nav-icon"></i>
                Kategori Buku
              </a>
            </li>
            <?php endif;?>
          </ul>
        </li>
        <?php endif;?>
        
      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>