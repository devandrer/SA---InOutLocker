<?php 
// Inicia a sessão para verificar e usar dados do login
  session_start();
  // Inclui arquivo de funções auxiliares, se necessário
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Ícone da aba do navegador -->
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
  <title>InOutLocker - Dashboard</title>

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
    $_SESSION['menu-n1'] = 'dashboard';
    $_SESSION['menu-n2'] = '';
     // Inclui o menu lateral
    include('partes/sidebar.php'); 
  ?>
  <!-- Fim Sidebar -->

  <!-- Área que contém o conteúdo da página -->
  <div class="content-wrapper">
    <!-- Cabeçalho da página -->
    <div class="content-header">
      <!-- Espaço -->
    </div>
    <!-- /.content-header -->

     <!-- Conteúdo principal -->
    <section class="content">
      <div class="container-fluid">

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo getEntradas();?></h3>

                <p>Entradas</p>
              </div>
              <div class="icon">
                <i class="far fa-arrow-alt-circle-up"></i>
              </div>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo getSaidas();?></h3>

                <p>Saídas</p>
              </div>
              <div class="icon">
                <i class="far fa-arrow-alt-circle-down"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo getPortasAbertas();?></h3>

                <p>Portas Livres</p>
              </div>
              <div class="icon">
                <i class="fas fa-door-open"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>65</h3>

                <p>Tempo Médio de uso</p>
              </div>
              <div class="icon">
                <i class="fas fa-hourglass-half"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

         <!-- Linha principal -->
        <div class="row">
          <!-- Coluna ocupando 100% da largura -->
          <section class="col-lg-6 connectedSortable">
              
            <!-- Cartão com o gráfico de barras -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Portas</h3>

                 <!-- Botões de colapsar e remover o card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool text-dark" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool text-dark" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- Corpo do card contendo o canvas do gráfico -->
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
        <!-- </div> -->

         <!-- Linha principal -->
         <!-- <div class="row"> -->
          <!-- Coluna ocupando 100% da largura -->
          <section class="col-lg-6 connectedSortable">
              
            <!-- Cartão com o gráfico de barras -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Portas Livre e Ocupadas</h3>

                 <!-- Botões de colapsar e remover o card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool text-dark" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool text-dark" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- Corpo do card contendo o canvas do gráfico -->
              <div class="card-body">
                <div class="chart">
                  <canvas id="donutChart" style="min-height: 250px; height: 200px; width: 1000px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
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
  // Dados do gráfico: categorias e valores
    var areaChartData = {
      labels  : ['Biblioteca'],// Categorias de usuários
      datasets: [
        
        {
          label               : 'Livres',
          backgroundColor     : '#008000',// verde
          borderColor         : '#3cbc8b',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo getPortasAbertas();?> ]// Quantidades de usuários ativos
        },
        
        {
          label               : 'Saídas',
          backgroundColor     : '#ff0000',// Vermelho
          borderColor         : '#d2d6de',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo getPortasFechadas();?> ]// Quantidades de usuários inativos
        },
        
      ]
    }
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp0
    barChartData.datasets[1] = temp1

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }
    
    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
    
    //- DONUT ou PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Ativos','Inativos'],
      datasets: [
        {
          data: [<?php echo portaAtivasInativas();?>],
          backgroundColor : ['#00a65a', '#f56954'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
</script>

</body>
</html>
