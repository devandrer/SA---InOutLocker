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
    <style>
        .porta-armario {
            width: 8rem; 
            height: 8rem; 
            display:flex;
            align-items: center;
            justify-content: center; 
        }

        .porta-armario-botao {
            width: 5rem; 
            height: 2rem; 
            margin-bottom: 2rem; 
        }
    </style>
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
                        
                            <?php echo listaPortaReserva(); ?>
                       
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
                
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