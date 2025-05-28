<?php 
// Inicia a sessão PHP para acessar variáveis globais de sessão
  session_start();
// Importa o arquivo com funções auxiliares, onde deve estar definida a função listaMovimentacao()
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ícone da aba do navegador -->
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
    <!-- Título da página exibido na aba do navegador -->
  <title>Movimentação</title>

  <!-- CSS -->
  <?php include('partes/css.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Wrapper principal que engloba toda a interface do sistema -->
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partes/navbar.php'); ?>

  <!-- Sidebar -->
     <!-- Define qual item está ativo no menu lateral -->
  <?php 
    $_SESSION['menu-n1'] = 'movimentacao'; 
    include('partes/sidebar.php'); 
  ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <!-- Cabeçalho vazio -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3><i class="fas fa-sync-alt mr-2"></i>Movimentação</h3>
              </div>

                <!-- Corpo do card com a tabela -->
              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th style='text-align:center'>Armario</th>
                      <th style='text-align:center'>Porta</th>
                      <th style='text-align:center'>Usuário</th>
                      <th style='text-align:center'>Data</th>
                      <th style='text-align:center'>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo listaMovimentacao(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- JS -->
<?php include('partes/js.php'); ?>

<script>
  $(function () {
    $('#tabela').DataTable({
      paging: true,         // Ativa a paginação
      lengthChange: true,   // Permite mudar o número de linhas exibidas por página
      searching: true,      // Habilita o campo de busca (filtro)
      ordering: true,       // Permite ordenar colunas
      info: true,           // Mostra informações como "Mostrando 1 a 10 de 50 registros"
      autoWidth: false,     // Desativa o cálculo automático da largura das colunas
      responsive: true      // Faz a tabela se adaptar bem em telas menores
    });
  });
</script>

</body>
</html>
