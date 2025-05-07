<?php 
  session_start();
  include('php/funcoes.php');

  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil Usuário</title>

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
    $_SESSION['menu-n1'] = '';
    $_SESSION['menu-n2'] = 'perfil';
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
                    <h3 class="card-title">Meu Perfil</h3>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">

                <form method="POST" action="php/salvaPerfil.php?Perfil=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
                  <div class="card-body">
                      <div class="row">	
                          
                          <div class="col-12">
                              <div class="row">	
                          
                                <div class="col-12">
                                  <div class="row">
                                    <div class="col-3 text-center">
                                      <div class="foto-perfil mx-auto">
                                        <img alt="<?php echo $_SESSION['NomeLogin']; ?>" src="<?php echo $_SESSION['FotoLogin']; ?>"  class="foto">
                                        <div class="trocar-imagem">
                                          <i class="fas fa-camera upload-button"></i>
                                          <p>Alterar Foto</p>
                                          <input class="arquivo" name="Foto" type="file" title="" accept="image/*"/>
                                        </div>
                                      </div>
                                    </div>	
                                    <div class="col-9">
                                      <div class="row">											
                                        <div class="col-7">
                                          <div class="form-group">
                                            <label for="iNome">Nome</label>
                                            <input readonly name="nNome" id="iNome" type="text" maxlength="80" class="form-control" value="<?php echo $_SESSION['NomeLogin']; ?>" required>
                                          </div>
                                        </div>											
                                        <div class="col-5">
                                          <div class="form-group">
                                            <label>Matrícula</label>
                                            <input readonly name="nMatricula" type="text" maxlength="50" class="form-control" value="">
                                          </div>
                                        </div>	
                                        <div class="col-10">
                                          <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control form-control-sm" name="nEmail" id="iEmail" value="">
                                          </div>
                                        </div>		
                                        <div class="col-5">
                                          <div class="form-group">
                                          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalRedefinirSenha">
                                            Redefinir Senha
                                            </button>

                                            <!-- Modal -->
                                          <div class="modal fade" id="modalRedefinirSenha" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="TituloModalCentralizado">Redefinir Senha</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  
                                                <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Senha Atual" required> <br>
                                                <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Nova senha" required> <br>
                                                <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Repetir senha" required>
                                                </div> 
                                                
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                  <button type="button" class="btn btn-primary">Salvar mudanças</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                            <!-- <div style="border: 1px solid #8b8e91  ; border-radius: 10px; padding: 20px;">
                                            <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Senha Atual" required> <br>
                                           <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Nova senha" required> <br>
                                           <input type="text" class="form-control form-control-sm" name="nSenha" id="iSenha" value="" placeholder="Repetir senha" required>
                                           </div> -->
                                         </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </div>
                          </div>
                          
                      </div>
                  </div>	

                  <div class="card-action" align="right">
                    <a href="perfil.php" class="btn btn-danger" data-toggle="tooltip" title="Cancelar a operação">
                      <span>Cancelar</span>
                    </a>
                    <input type="submit" class="btn btn-success" value="Salvar" data-toggle="tooltip" title="Salvar as alterações no perfil">
                  </div>
                </form>
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
