<?php
session_start();
include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">

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
        $_SESSION['menu-n1'] = 'reservas';
        $_SESSION['menu-n2'] = '';
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

                    <!-- Small boxes (Stat box) -->

                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <div class="row">
                            <div class="col-2">
                                <div class="card border border-dark" style="width: 8rem; height: 8rem; display:flex;align-items: center;justify-content: center; background-color: beige;">
                                    <button id="imodal" class="border border-dark" style="width: 5rem; height: 2rem; margin-bottom: 2rem; background-color: red;" data-toggle="modal" data-target="#novoUsuarioModal">
                                        <!-- <div class="border border-dark" style="width: 5rem; height: 2rem; margin-bottom: 2rem; background-color: red;">

                                        </div> -->
                                    </button>
                                    <div class="border-bottom border-dark" style="width: 5rem;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
                <div class="modal fade" id="novoUsuarioModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title">Reservar porta</h4>
                                <button type="button" id="novousuario" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="php/salvarMovimento.php?funcao=I" enctype="multipart/form-data">

                                    <div class="row d-flex justify-content-center">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="iNome">Nome:</label>
                                                <input type="text" class="form-control" id="iNome" name="nNome" maxlength="50">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="iCpf">Matrícula:</label>
                                                <input type="text" class="form-control" id="iCpf" name="nCpf" maxlength="6">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
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
    //document.querySelector("#imodal").click();

</script>


</body>

</html>