<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if ($_SESSION['idTipoUsuario'] != 1) {
  header('location: dashboard.php');
}
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
  <title>Armários</title>

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
    $_SESSION['menu-n1'] = 'administrador';
    $_SESSION['menu-n2'] = 'armario';
    include('partes/sidebar.php'); 
  ?>
  <!-- Fim Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    <!-- Content Header (Page header) -->
    <div class="content-header bg-white">
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
                  
                  <div class="col-9">
                    <h3><i class="fas fa-archive mr-2"></i>Armário</h3>
                  </div>
                  
                  <div class="col-3" align="right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoArmarioModal">
                      Novo Armário
                    </button>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead class="thead-dark">
                  <tr> <!-- tabela das informações principais do armario -->
                      <th>ID</th>
                      <th>Local</th>
                      <th>Empresa</th>  
                      <th>Ativo</th>              
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo listaArmario(); ?> <!-- faz o select no banco de dados, puxando as infos do armario (funcaoArmario.php) -->
                  
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
       

      <!-- modal de adicionar novo armario -->

      <div class="modal fade" id="novoArmarioModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Novo Armário</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="php/salvarArmario.php?funcao=I" enctype="multipart/form-data"><!-- faz a inserção de um novo armario -->              
                
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="iRazao">Local</label>
                      <input type="text" class="form-control" id="iLocal" name="nLocal" maxlength="50">
                    </div>
                  </div>
                </div>

                 
                 <div class="col-12">
                    <div class="form-group">
                      <label for="iRazao">Empresa:</label>
                      <select id="iEmpresa" name="nRazao" class="form-control">
                        <option value="">Selecione...</option>
                        <?php echo optionEmpresa();?> <!--php/funcaoEmpresa-->
                      </select>
                    </div>
                  </div>
               
                  <div class="col-12">
                    <div class="form-group">
                      <input type="checkbox" id="iAtivo" name="nAtivo">
                      <label for="iAtivo">Armário Ativo</label>
                    </div>
                  </div>

                

                <div class="modal-footer">
                  <button type="submit" id="btDeFecharArmario" name="btSalvaArmario" value="modal_limpar" class="btn btn-danger" >Fechar</button>
                  <button type="submit" name="btSalvaArmario" value="modal_salvar" class="btn btn-success">Salvar</button>
                </div>
                
              </form>

            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
    $('#tabela').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
