<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../app/dashboard.php" class="brand-link d-flex justify-content-around">
      <img src="dist/img/door-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 30%; padding:8px">
      <img src="dist/img/nick-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 60%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/Logo_InOutLocker.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="./perfil.php" class="d-block">User</a>
        </div>
      </div>

      <!-- Sidebar Menu -->      
      <?php echo montaMenu($_SESSION['menu-n1'],$_SESSION['menu-n2']);?>      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>