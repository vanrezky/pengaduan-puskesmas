  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard/') ?>">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Backend</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Interface
        </div>
        <?php
        $menu = getMenu();

        if (!empty($menu)) :
          foreach ($menu as $key => $value) :

            echo "<li class='nav-item'>";

            if (empty($value['child'])) {
              echo "<a class='nav-link collapsed' href='" . base_url($value["role"] . "/" . $value['url_menu']) . "'>";
              echo "<i class='$value[icon_menu]'></i> ";
              echo "<span>$value[nama_menu]</span> ";
              echo "</a>";
            } else {

              echo "<a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#menu-" . $value['id_menu'] . "' aria-expanded='true' aria-controls='menu-" . $value['id_menu'] . "'>";
              echo "<i class='$value[icon_menu]'></i> ";
              echo "<span>$value[nama_menu]</span> ";
              echo "</a>";

              echo "<div id='menu-" . $value['id_menu'] . "' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>";
              echo "<div class='bg-white py-2 collapse-inner rounded'>";
              echo "<h6 class='collapse-header'>Sub Menu:</h6>";

              foreach ($value['child'] as $k => $v) {
                echo "<a class='collapse-item' href='" . base_url($v["role"] . "/" . $v['url_menu']) . "'>$v[nama_menu]</a>";
              }

              echo "</div> ";
              echo "</div> ";
            }
            echo "</li> ";


          endforeach;
        endif;
        ?>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-power-off"></i>
            <span>Log Out</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->