<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Pustaka <sup>App</sup></div>
  </a>

  <!--get akses pid = 0-->
  <?php $user_akses = user_akses(0);?>
  <?php foreach($user_akses as $akses):?>

    <!--display akses pid = 0-->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url($akses['link']);?>">
        <?php if($akses['icon'] != ''):?>
          <i class="fas fa-fw <?php echo $akses['icon'];?>"></i>
        <?php endif;?>
        <span><?php echo $akses['nama'];?></span>
      </a>
    </li>

    <!--get subakses-->
    <?php $user_subakses = user_akses($akses['id']);?>
    <?php foreach($user_subakses as $subakses):?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url($subakses['link']);?>">
        <?php if($subakses['icon'] != ''):?>
          <i class="fas fa-fw <?php echo $subakses['icon'];?>"></i>
        <?php endif;?>
        <span><?php echo $subakses['nama'];?></span>
      </a>
    </li>
    <?php endforeach?>
    <!--end get subakses-->

  <?php endforeach?>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>