 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="assets/index3.html" class="brand-link">
      <!--<img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <i class="fa fa-calculator"></i> <span class="brand-text font-weight-light">PPh21</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/nti" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PTKP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/tir" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PKP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/tc" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori TER</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Tax
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/settax" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PPh21 TER</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/setlasttax" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PPh21 Akhir Periode</p>
                </a>
              </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/incometax" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recap PPh21</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/slip" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slip Gaji</p>
                </a>
              </li>
              </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" onclick="logout(event)" class="nav-link">
              <i class="nav-icon fas fa-arrow-left"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>