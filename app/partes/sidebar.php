<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary  elevation-4" style="background-color:#181515 ">
    <!-- Brand Logo -->
    <a href="../app/dashboard.php" class="brand-link d-flex justify-content-around" style="border-bottom:1px solid #007bff">
      <img src="dist/img/door-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 30%; padding:8px">
      <img src="dist/img/nick-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 60%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex bd-highlight" style="border-bottom:1px solid #007bff">
        <div class="image">
          <img src="<?php echo $_SESSION['FotoLogin']; ?>" class="rounded-circle" alt="User Image" style="width: 35px; height: 35px; object-fit: cover;">
        </div>
        <div class="info">
          <a href="./perfil.php" class="d-block text-white"><?php echo $_SESSION['NomeLogin']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->      
      <?php echo montaMenu($_SESSION['menu-n1'],$_SESSION['menu-n2']);?>      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>