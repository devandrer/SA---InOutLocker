<?php 
  session_start();
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movimentação</title>

  <!-- CSS -->
  <?php include('partes/css.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partes/navbar.php'); ?>

  <!-- Sidebar -->
  <?php 
    $_SESSION['menu-n1'] = 'movimentacao'; // Você pode alterar isso para algo como 'movimentacoes'
    include('partes/sidebar.php'); 
  ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <!-- Cabeçalho vazio -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Movimentação</h3>
              </div>

              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Data</th>
                      <th>Status</th>
                      <th>Usuário</th>
                      <th>Porta</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo listaMovimentacao(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- JS -->
<?php include('partes/js.php'); ?>

<script>
  $(function () {
    $('#tabela').DataTable({
      paging: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true
    });
  });
</script>

</body>
</html>
