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
                    <div class="col-5">
                      <div class="form-group">
                        <label for="iDescricao">Descrição:</label>
                        <input type="text" class="form-control" id="iDescricao" name="nDescricao" maxlength="80" value="<?php echo $_SESSION['relatProdutosDescr'];?>">
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label for="iCategoria">Categoria:</label>
                        <select name="nCategoria" id="iCategoria" class="form-control">
                          <?php if($_SESSION['relatProdutosIdCat'] != '0' && $_SESSION['relatProdutosIdCat'] != ''){ ?>
                            <option value="<?php echo $_SESSION['relatProdutosIdCat']; ?>"><?php echo descrCategoria($_SESSION['relatProdutosIdCat']); ?></option>
                          <?php } ?>
                          <option value="0">Todas</option>
                          <?php echo optionCategoria();?>
                        </select>
                      </div>
                    </div>

                    <div class="col-2">
                      <div class="form-group">
                        <label for="iQtdMin">Qtd. Mínima:</label>
                        <input type="number" class="form-control" id="iQtdMin" name="nQtdMin" min="0" value="<?php echo $_SESSION['relatProdutosMin'];?>">
                      </div>
                    </div>

                    <div class="col-2">
                      <div class="form-group">
                        <label for="iQtdMax">Qtd. Máxima:</label>
                        <input type="number" class="form-control" id="iQtdMax" name="nQtdMax" min="0" value="<?php echo $_SESSION['relatProdutosMax'];?>">
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
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Produto</th>
                      <th>Categoria</th>
                      <th>Quantidade</th>    
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo $_SESSION['relatProdutos']; ?>
                  
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
