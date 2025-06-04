<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
include('php/funcoes.php');
$erro = $_SESSION["erroPerfil"];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
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

                    <div class="col-12">
                      <h3 class="card-title">Meu Perfil</h3>
                    </div>

                  </div>
                </div>



                <!-- /.card-header -->
                <div class="card-body">

                  <form method="POST" action="php/salvarPerfil.php?id=<?php echo $_SESSION['idLogin']; ?>" enctype="multipart/form-data"> <!-- Traz a informações do perfil logado, através do idlogin -->
                    <div class="card-body">
                      <div class="row">

                        <div class="col-12">
                          <div class="row">

                            <div class="col-12">
                              <div class="row">
                                <div class="col-3 text-center">
                                  <div class="foto-perfil mx-auto">
                                     <img src="<?php echo $_SESSION['FotoLogin']; ?>" class="foto"> <!-- Campo que puxa a foto do usuário-->
                                    <div class="trocar-imagem">
                                      <i class="fas fa-camera upload-button"></i>
                                      <p>Alterar Foto</p>
                                      <input class="arquivo" name="Foto" type="file" title="" accept="image/*" />
                                    </div>
                                  </div>
                                </div>
                                <div class="col-9">
                                  <div class="row">
                                    <div class="col-7">
                                      <div class="form-group">
                                        <label for="iNome">Nome</label>
                                        <input readonly name="nNome" id="iNome" type="text" maxlength="80" class="form-control" value="<?php echo $_SESSION['NomeLogin']; ?>">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label>Matrícula</label>
                                        <input readonly name="nMatricula" type="text" maxlength="50" class="form-control" value="<?php echo $_SESSION['Matricula']; ?>">
                                      </div>
                                    </div>
                                    <div class="col-10">
                                      <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control form-control-sm" name="nEmail" id="iEmail" value="<?php echo $_SESSION['EmailLogin']; ?>">
                                      </div>
                                    </div>
                                    <div class="col-5">
                                      <div class="form-group">
                                        <button type="button" class="btn btn-secondary" id="btnSenha" data-toggle="modal" data-target="#modalRedefinirSenha">
                                          Redefinir Senha
                                        </button>
                                        <?php
                                          if($_SESSION["msgSucesso"]) {
                                            echo '<span id="msgSucesso" class="text-success">Sucesso!!</span>';
                                            $_SESSION["msgSucesso"] = false;
                                          } else {
                                            echo '';
                                          }                                         
                                        ?>
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
        <!-- Modal de redefinir a senha -->
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
                <form method="POST" id=""action="php/alterarSenha.php">
                  <div style="border: none ; padding: 7px;">
                    <label for="iSenhaA" style="color:red;">
                    <?php if ($erro == "erroSenhaA") { //Se a senha atual estiver errada, cria uma label 'Senha incorreta!' ou  'Preencha todos os campos.'
                        echo 'Senha incorreta!';
                      } elseif ($erro == "erroNone"){
                        echo 'Preencha todos os campos.' ;
                      }else{
                        echo '';
                      } ?>
                      </label><br>
                    <input type="password" class="form-control form-control-sm" name="nSenha" id="iSenhaA" value="" placeholder="Senha Atual"
                      <?php if ($erro == "erroSenhaA") { //Se a senha atual estiver errada muda a borda para vermelho
                        echo 'style="border-color: red;" ';
                      } else {
                        echo 'style="border-color: #ced4da;" ' ;
                      } ?>
                      >
                      <i class="fas fa-eye-slash" id="iSenhaIconA" style="position: absolute; right: 30px; top: 55px;cursor: pointer;"></i> 
                      <br>
                  </div>
                  <div style="border-radius: 10px ; padding: 7px;  background-color: #F4F6F9;">
                    <input type="password" class="form-control form-control-sm" name="nSenhaN" id="iSenhaN" value="" placeholder="Nova senha" > <br>
                    <i class="fas fa-eye-slash" id="iSenhaIconN" style="position: absolute; right: 30px; top: 125px;cursor: pointer;"></i>
                    <label for="iSenhaR" style="color:red;">
                    <?php if ($erro == "erroSenhaR") { //Se a senha nova estiver errada, cria uma label 'As senhas não coincidem!' 
                        echo 'As senhas não coincidem!';
                      } else {
                        echo '' ;
                      } ?>
                      </label><br>
                    <input type="password" class="form-control form-control-sm" name="nSenhaR" id="iSenhaR" value="" placeholder="Repetir senha"
                      <?php if ($erro == "erroSenhaR") { //Se a senha nova no campo "Repetir Senha" estiver errada muda a borda para vermelho
                        echo 'style="border-color: red;" ';
                      } else {
                        echo 'style="border-color: #ced4da;" ';
                      } ?>
                      >
                      <i class="fas fa-eye-slash" id="iSenhaIconR" style="position: absolute; right: 30px; top: 204px;cursor: pointer;"></i>
                  </div>
              </div>

              <div class="modal-footer">
                <button type="submit" id="btDeFechar" name="btModal" value="modal_limpar" class="btn btn-secondary">Fechar</button>
                <button type="submit" name="btModal" value="modal_salvar"  class="btn btn-primary">Salvar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
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

    let senhaIconA = document.getElementById("iSenhaIconA");
    let senhaInputA = document.getElementById("iSenhaA");
    senhaIconA.onclick = () => {
      if(senhaInputA.type == "password"){
        senhaIconA.className = "fas fa-eye";
        senhaInputA.type = "text"
      }else{
        senhaIconA.className = "fas fa-eye-slash";
        senhaInputA.type = "password"
      }

    }
    let senhaIconN = document.getElementById("iSenhaIconN");
    let senhaInputN = document.getElementById("iSenhaN");
    senhaIconN.onclick = () => {
      if(senhaInputN.type == "password"){
        senhaIconN.className = "fas fa-eye";
        senhaInputN.type = "text"
      }else{
        senhaIconN.className = "fas fa-eye-slash";
        senhaInputN.type = "password"
      }

    }
    let senhaIconR = document.getElementById("iSenhaIconR");
    let senhaInputR = document.getElementById("iSenhaR");
    senhaIconR.onclick = () => {
      if(senhaInputR.type == "password"){
        senhaIconR.className = "fas fa-eye";
        senhaInputR.type = "text"
      }else{
        senhaIconR.className = "fas fa-eye-slash";
        senhaInputR.type = "password"
      }

    }


    <?php if ($erro == "erroSenhaR" || $erro == "erroSenhaA" || $erro == "erroNone") { //Se a senha atual estiver errada muda a borda para vermelho
      echo 'document.getElementById("btnSenha").click();';
    }
    ?>
    $('#modalRedefinirSenha').on('hidden.bs.modal', function (event) {
    document.getElementById('btDeFechar').click()//limpa dados da Modal ao clickar o icone "x" da modal
    });
  </script>

</body>

</html>