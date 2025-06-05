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
        <div class="content-wrapper bg-white">
            <!-- Content Header (Page header) -->
            <div class="content-header bg-white">
                <!-- Espaço -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->

                    <!-- /.row -->
                    <!-- Main row -->

                    <div class="row mb-5">
                        <form action="php/carregaArmarios.php" method="POST">
                            <div class="btn-group" role="group">
                                <?php echo listaArmarioReserva(); ?>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <!-- Função que retorna as portas -->
                        <?php
                        if ($_SESSION["carregaArmarios"] <> 0) {
                            echo listaPortaReserva($_SESSION["carregaArmarios"]);
                        }
                        ?>

                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
                <div class="modal fade" id="alertModalReservas">
                    <div class="modal-dialog modal-lg">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Cuidado!</strong> Você está tentando desativar uma porta que está sendo ocupada!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <input type="button" id="btnModalAlertReservas" data-toggle="modal" data-target="#alertModalReservas" hidden>
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
        <?php
        //Valida se a variavel é verdadeira
        if ($_SESSION["portaOcupada"]) {
            echo 'document.getElementById("btnModalAlertReservas").click()';
            $_SESSION["portaOcupada"] = false;
        }

        echo listaJSPorta();



        ?>
    </script>


</body>

</html>