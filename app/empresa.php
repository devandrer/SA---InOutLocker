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
  <title>Empresas</title>

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
    $_SESSION['menu-n2'] = 'empresa';
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
                    <h3><i class="fas fa-building mr-2"></i>Empresas</h3>
                  </div>
                  
                  <div class="col-3" align="right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novaEmpresaModal">
                      Nova Empresa
                    </button>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead class="thead-dark">
                  <tr> <!-- tabela das informações principais da empresa -->
                      <th>ID</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                      <th>Cidade</th>
                      <th>UF</th>
                      <th>Ativo</th>                
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo listaEmpresa(); ?> <!-- faz o select no banco de dados, puxando as infos da empresa -->
                  
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
       

      <!-- modal de adicionar nova empresa -->

      <div class="modal fade" id="novaEmpresaModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Nova Empresa</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="php/salvarEmpresa.php?funcao=I" enctype="multipart/form-data"><!-- faz a inserção de uma nova empresa -->              
                
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="iRazao">Razão Social:</label>
                      <input type="text" class="form-control" id="iRazao" name="nRazao" maxlength="50">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="iCnpj">CNPJ:</label>
                      <input type="text" class="form-control" id="iCnpj" name="nCnpj" maxlength="50">
                    </div>
                  </div>

                  <div class="col-8">
                    <div class="form-group">
                      <label>Endereço</label>
                      <input required name="Endereco" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label>Cidade</label>
                      <input required name="Cidade" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-1">
                    <div class="form-group">
                      <label>UF</label>
                      <input required name="UF" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>CEP</label>
                      <input required name="CEP" type="text" class="form-control cep">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>Número</label>
                      <input required name="Numero" type="text" maxlength="8" class="form-control">
                    </div>
                  </div>

                  <div class="col-5">
                    <div class="form-group">
                      <label>Bairro</label>
                      <input required name="Bairro" type="text" class="form-control">
                    </div>
                  </div>
               
                  <div class="col-12">
                    <div class="form-group">
                      <input type="checkbox" id="iAtivo" name="nAtivo">
                      <label for="iAtivo">Empresa Ativa</label>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success">Salvar</button>
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
