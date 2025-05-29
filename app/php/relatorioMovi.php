<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include('funcoes.php');

    //Filtros de tela
    $descricao   = $_POST["nDescricao"];
    $idCategoria = $_POST["nCategoria"];
    $qtdMin      = $_POST["nQtdMin"];
    $qtdMax      = $_POST["nQtdMax"];

    //Campos para WHERE
    $whereDescricao   = '';
    $whereIdCategoria = '';
    $whereQtdMin      = '';
    $whereQtdMax      = '';

    //Sessões para retorno
    $_SESSION['relatProdutos']      = '';
    $_SESSION['relatProdutosDescr'] = '';
    $_SESSION['relatProdutosIdCat'] = '';
    $_SESSION['relatProdutosMin']   = '';
    $_SESSION['relatProdutosMax']   = '';

    //Validar filtros
    if($descricao != '') {
        $whereDescricao = " AND pro.Descricao LIKE '%".$descricao."%' ";
    }

    if($idCategoria != '0') {
        $whereIdCategoria = " AND pro.idCategoria = ".$idCategoria;
    }

    if($qtdMin != '') {
        $whereQtdMin = " AND pro.Quantidade >= ".$qtdMin;
    }

    if($qtdMax != '') {
        $whereQtdMax = " AND pro.Quantidade <= ".$qtdMax;
    }


    include("conexao.php");

    $sql = "SELECT pro.idProduto, "
            ." pro.Descricao AS Produto, "
            ." pro.idCategoria, "
            ." cat.Descricao AS Categoria, "
            ." pro.Quantidade "
        ." FROM produto pro "
        ." INNER JOIN categoria cat "
        ." ON cat.idCategoria = pro.idCategoria" 
        ." WHERE 1 = 1 "
        .$whereDescricao
        .$whereIdCategoria
        .$whereQtdMin
        .$whereQtdMax.";";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
        
        foreach ($result as $coluna) {

            //***Verificar os dados da consulta SQL
            $lista .= 
            '<tr>'
                .'<td>'.$coluna["idProduto"].'</td>'
                .'<td>'.$coluna["Produto"].'</td>'
                .'<td>'.$coluna["Categoria"].'</td>'
                .'<td>'.$coluna["Quantidade"].'</td>'
            .'</tr>';             
                      
        }    
    }
    
    $_SESSION['relatProdutos']      = $lista;
    $_SESSION['relatProdutosDescr'] = $descricao;
    $_SESSION['relatProdutosIdCat'] = $idCategoria;
    $_SESSION['relatProdutosMin']   = $qtdMin;
    $_SESSION['relatProdutosMax']   = $qtdMax;

    header("location: ../relatorio-movi.php");

?>