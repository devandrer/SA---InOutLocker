<?php 
  session_start();
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
  <title>InOutLocker - Relatório de Movimentações</title>

  <!-- CSS -->
  <?php include('partes/css.php'); ?>
  <!-- Fim CSS -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partes/navbar.php'); ?>
  <!-- Fim Navbar -->

  <!-- Sidebar -->
  <?php 
    $_SESSION['menu-n1'] = 'relatorio';
    $_SESSION['menu-n2'] = 'relatorio-movi';
    include('partes/sidebar.php'); 
  ?>
  <!-- Fim Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- Espaço -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  
                  <div class="col-12">
                    <h3 class="card-title">Relatório de Movimentações</h3>
                  </div>

                </div>
              </div>

              <!-- /.card-header -->
              <div class="modal-body">
                <form method="POST" action="php/relatorioMovi.php" enctype="multipart/form-data">              
                  
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="iArmario">Armário:</label>
                        <input type="text" class="form-control" id="iArmario" name="nArmario" maxlength="80" value="<?php echo $_SESSION['relatMoviArmario'];?>">
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label for="iPorta">Porta:</label>
                        <input type="text" class="form-control" id="iPorta" name="nPorta" value="<?php echo $_SESSION['relatMoviPorta'];?>">
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label for="iTipoMovi">Tipo de Movimentação:</label>
                        <select name="nTipoMovi" id="iTipoMovi" class="form-control">
                        <?php if($_SESSION['relatMoviTipo'] != '0' && $_SESSION['relatMoviTipo'] != ''){ ?>
                          <option value="<?php echo $_SESSION['relatMoviTipo']; ?>"></option>
                          <?php } ?>
                          <option value="0">Todas</option>
                          <?php echo optionMovimentacao();?>
                        </select>
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label for="iDataInicio">Data Início:</label>
                        <input type="datetime-local" class="form-control" id="iDataInicio" name="nPeriodo" value="<?php echo $_SESSION['relatMoviPeriodo'];?>">
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group">
                        <label for="iDataFinal">Data Fim:</label>
                        <input type="datetime-local" class="form-control" id="iDataFinal" name="nPeriodo" value="<?php echo $_SESSION['relatMoviPeriodo'];?>">
                      </div>
                    </div>



                  </div>

                  <div align="right">
                    <button type="submit" class="btn btn-primary">Processar</button>
                  </div>
                  
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->

          <div class="col-12">
            <div class="card">             

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead-dark">
                  <tr>
                      <th>Armario</th>
                      <th>Porta</th>
                      <th>Tipo de Movimentação</th>
                      <th>Período</th>    
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo $_SESSION['relatMovi']; ?>
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JS -->
<?php include('partes/js.php'); ?>
<!-- Fim JS -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');    
  });

</script>

</body>
</html>
