<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

  <div class="slimscroll-menu">

    <!--- Sidemenu -->
    <div id="sidebar-menu">

      <ul class="metismenu" id="side-menu">

        <li class="menu-title">Navigation</li>

        <li>
          <a href="<?php echo base_url('Dashboard') ?>">
            <i class="fe-pocket"></i>
            <span> Dashboard </span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('Dashboard/template') ?>">
            <i class="fe-clipboard"></i>
            <span> Template </span>
          </a>
        </li>
        <?php
        $role_id = $this->session->userdata('role_id'); 
        $queryMenu = "SELECT um.id, menu, icon FROM user_menu AS um JOIN user_access_menu AS uam ON um.id = uam.menu_id WHERE uam.role_id = $role_id AND active = 1 ORDER BY uam.menu_id ASC";
        $menu = $this->db->query($queryMenu)->result_array();
         ?>
        <?php foreach ($menu as $m): ?>
        <li>
          <a href="javascript: void(0);">
            <i class="<?= $m['icon'] ?>"></i>
            <span><?= $m['menu'] ?></span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="nav-second-level" aria-expanded="false">
            <?php      
            $queryMenu = "SELECT *, usm.icon AS usm_icon FROM user_sub_menu AS usm JOIN user_menu AS um ON usm.menu_id = um.id WHERE usm.menu_id = $m[id] AND usm.is_active = 1";
            $subMenu = $this->db->query($queryMenu)->result_array();
             ?>
             <?php foreach ($subMenu as $sm): ?>
              <?php if ($sm['title']==$title): ?>
                <li class="nav-item active">
              <?php else: ?>
                <li class="nav-item">
              <?php endif ?>
                <a href="<?= base_url($sm['url']) ?>">
                  <i class="<?= $sm['usm_icon'] ?>"></i>
                  <span><?= $sm['title'] ?></span>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
        <?php endforeach ?>
        <li>
          <a href="javascript: void(0);">
            <i class="fe-users"></i>
            <span> Data </span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="nav-second-level" aria-expanded="false">
            <li>
              <a href="<?php echo base_url('Dashboard/data_warga') ?>">
                <span> Data Warga </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url('Dashboard/data_kendaraan') ?>">
                <span> Data Kendaraan </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url('Dashboard/riwayat_verifikasi') ?>">
                <span> Riwayat Verifikasi </span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('Dashboard/fasilitas') ?>">
                <span> Data Fasilitas </span>
              </a>
            </li>
          </ul>
        </li>
      </ul>



    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

  </div>
  <!-- Sidebar -left -->

</div>
