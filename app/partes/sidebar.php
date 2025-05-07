<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/Logo_InOutLocker.png" alt="AdminLTE Logo" class=" img-fluid elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">In Out Locker</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/Logo_InOutLocker.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="./teste-perfil.php" class="d-block">User</a>
        </div>
      </div>

      <!-- Sidebar Menu -->      
      <?php echo montaMenu($_SESSION['menu-n1'],$_SESSION['menu-n2']);?>      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>