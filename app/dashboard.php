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
  <div class="content-wrapper" style="background-color:color-mix(in srgb, #60B5FF, black 30%)";>
    <!-- Cabeçalho da página -->
    <div class="content-header" style="background-color:color-mix(in srgb, #60B5FF, black 30%)";>
      <!-- Espaço -->
    </div>
    <!-- /.content-header -->

     <!-- Conteúdo principal -->
    <section class="content"  style="background-color:color-mix(in srgb, #60B5FF, black 30%)";>
      <div class="container-fluid">

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="movimentacao.php">
            <div class="small-box" style="background-color:color-mix(in srgb, #28A745, black 30%)";>
              <div class="inner">
                <h3 class="text-white"><?php echo getEntradas();?></h3>

                <p class="text-white">Entradas</p>
              </div>
              <div class="icon">
                <i class="far fa-arrow-alt-circle-up"></i>
              </div>
            </div>
            </a>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="movimentacao.php">
            <div class="small-box" style="background-color:color-mix(in srgb, #DC3545, black 30%)";>
              <div class="inner">
                <h3 class="text-white"><?php echo getSaidas();?></h3>
                
                <p class="text-white">Saídas</p>
              </div>
              <div class="icon">
                <i class="far fa-arrow-alt-circle-down"></i>
              </div>
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="reservas.php">
            <div class="small-box" style="background-color:color-mix(in srgb,#D98324, black 10%)";>
              <div class="inner">
                <h3 class="text-white"><?php echo getPortasAbertas();?></h3>

                <p class="text-white">Portas Livres</p>
              </div>
              <div class="icon">
                <i class="fas fa-door-open"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="movimentacao.php">
            <div class="small-box" style="background-color:color-mix(in srgb, #607D8B , black 30%)";>
              <div class="inner">
                <h3 class="text-white"><?php echo getTempoMedio();?></h3>

                <p class="text-white">Tempo Médio de uso</p>
              </div>
              <div class="icon">
                <i class="fas fa-hourglass-half"></i>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
        </div>

         <!-- Linha principal -->
        <div class="row">
          <!-- Coluna ocupando 100% da largura -->
          <section class="col-lg-6 connectedSortable">
              
            <!-- Cartão com o gráfico de barras -->
            <div class="card card-primary">
              <div class="card-header" style="background-color:color-mix(in srgb, #27548A, black 30%);">
                <h3 class="card-title">Portas Livres e Ocupados</h3>

                 <!-- Botões de colapsar e remover o card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
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
              <div class="card-header" style="background-color:color-mix(in srgb, #27548A, black 30%);">
                <h3 class="card-title">Portas Ativas e Inativas</h3>

                 <!-- Botões de colapsar e remover o card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- Corpo do card contendo o canvas do gráfico -->
              <div class="card-body" style="background-color: #dde9f3";>
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
          borderColor         : ' #000',
          pointRadius          : false,
          pointColor          : ' #3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#000',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo getPortasAbertas();?> ]// Quantidades de usuários ativos
        },
        
        {
          label               : 'Ocupados',
          backgroundColor     : '#ff0000',// Vermelho
          borderColor         : '#000',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#000',
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
      datasetFill             : false,
      scales: {
        xAxes: [{ // Add this for x-axis labels
          ticks: {
            fontColor: '#27548A' // White font color for x-axis labels
          },
          gridLines: {
            color: '#27548A' // White grid lines for x-axis
          }
        }],
        yAxes:[{
          ticks: {
            suggestedMax: 6,
            suggestedMin: 0,
            fontColor: '#27548A' // White font color for y-axis labels
          },
          gridLines: {
            color: '#27548A' // White grid lines for y-axis
          }
        }]
      },
      legend: { // For the legend (labels like 'Livres', 'Ocupados')
        labels: {
          fontColor: '#27548A' // White font color for legend labels
        }
      }
    }
    
    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions,

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
          backgroundColor : ['#008000', '#ff0000'],//verde e vermelho
          borderColor: ['#fff','#fff'],
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
