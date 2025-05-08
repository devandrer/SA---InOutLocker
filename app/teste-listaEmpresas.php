<?php
    session_start();
    include("php/funcoes.php");    
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
		
		<meta charset="UTF-8">
        <title>Empresas</title>

    </head>

    <body>
        
        <?php echo montaMenu(); ?>
        
        <p>

                <a href="nova-empresa.php">Nova Empresa</a>

        </p>

        <table border='1'>
            <tr>
                <th>ID</th>
                <th>ID</th>
                      <th>Razão Social</th>
                      <th>CNPJ</th>
                      <th>Cidade</th>
                      <th>UF</th>
                      <th>Ativo</th>                
                      <th>Ações</th>
            </tr>
        
            <?php echo listaEmpresa(); ?>

        </table>

    </body>

</html>