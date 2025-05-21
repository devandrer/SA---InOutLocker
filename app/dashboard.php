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

         <!-- Linha principal -->
        <div class="row">
          <!-- Coluna ocupando 100% da largura -->
          <section class="col-lg-12 connectedSortable">
              
            <!-- Cartão com o gráfico de barras -->
            <div class="card card-warning">
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
      labels  : ['Entrada','Saída'],// Categorias de usuários
      labels  : ['Entrada','Saída'],
      datasets: [
        
        {
          label               : 'Disponíveis',
          backgroundColor     : '#007bff',// Azul
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48]// Quantidades de usuários ativos
        },
        
        {
          label               : 'Ocupados',
          backgroundColor     : '#212529',// Cinza
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59]// Quantidades de usuários inativos
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
</script>

</body>
</html>
