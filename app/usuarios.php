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
  <title>Usuários</title>

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
    $_SESSION['menu-n2'] = 'usuarios';
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
                  
                  <div class="col-9">
                    <h3 class="card-title">Usuários</h3>
                  </div>
                  
                  <div class="col-3" align="right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#novoUsuarioModal">
                      Novo Usuário
                    </button>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Tipo de Usuário</th>
                      <th>Matricula</th>
                      <th>Ativo</th>                
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo listaUsuario(); ?>
                  
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

      <div class="modal fade" id="novoUsuarioModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Novo Usuário</h4>
              <button type="button" id="novousuario" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="php/salvarUsuario.php?funcao=I" enctype="multipart/form-data">              
                
                <div class="row">
                  <div class="col-5">
                    <div class="form-group">
                      <label for="iNome">Nome:</label>
                      <input type="text" class="form-control" id="iNome" name="nNome" maxlength="50">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="iCpf">CPF:</label>
                      <input type="text" class="form-control" id="iCpf" name="nCpf" maxlength="14">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label for="iTipoUsuario">Tipo de Usuário:</label>
                      <select name="nTipoUsuario" id="iTipoUsuario" class="form-control" required>
                        <option value="">Selecione...</option>
                        <?php echo optionTipoUsuario();?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group">
                      <label for="iNome">Empresa:</label>
                      <select name="nEmpresa" class="form-control" required>
                        <option value="">Selecione...</option>
                        <?php echo optionEmpresa();?>
                      </select>
                    </div>
                  </div>
                  
                  

                  <div class="col-8">
                    <div class="form-group">
                      <label for="iLoginN">Login:</label>
                      <input type="email" class="form-control" id="iLoginN" name="nLogin" maxlength="50">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="iSenhaN">Senha:</label>
                      <input type="text" class="form-control" id="iSenhaN" name="nSenha" maxlength="6">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label for="iMatricula">Matrícula:</label>
                      <input type="text" value="<?php echo proximoID("tb_usuario","matricula"); ?>" readonly class="form-control" id="iMatricula" name="nMatricula" maxlength="7">
                    </div>
                  </div>
                
                  <div class="col-9">
                    <div class="form-group">
                      <label for="iFoto">Foto:</label>
                      <input type="file" class="form-control" id="iFoto" name="Foto" accept="image/*">
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                      <input type="checkbox" id="iAtivo" name="nAtivo">
                      <label for="iAtivo">Usuário Ativo</label>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>CEP</label>
                      <input required name="CEP" type="text" class="form-control cep">
                    </div>
                  </div>
                  
                  <div class="col-6">
                    <div class="form-group">
                      <label>Endereço</label>
                      <input required name="Endereco" type="text" class="form-control">
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
                  
                  <div class="col-5">
                    <div class="form-group">
                      <label>Cidade</label>
                      <input required name="Cidade" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-2">
                    <div class="form-group">
                      <label>UF</label>
                      <input required name="UF" type="text" class="form-control">
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
  let select = document.getElementById("iTipoUsuario")
  select.onchange = () => {
    const optionSelecionado = select.options[select.selectedIndex].value;
    console.log(optionSelecionado);
    
    if (optionSelecionado == 3) {
        document.getElementById("iLoginN").disabled = true;
        document.getElementById("iSenhaN").disabled = true;
      } else {
      document.getElementById("iLoginN").disabled = false;
      document.getElementById("iSenhaN").disabled = false;
    }
  }



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
