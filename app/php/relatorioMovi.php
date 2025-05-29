<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include('funcoes.php');

    //Filtros de tela
    $armario= $_POST["nArmario"];
    $porta = $_POST["nPorta"];
    $tipomovi      = $_POST["nTipoMovi"];
    $periodo      = $_POST["nPeriodo"];

    //Campos para WHERE
    $whereArmario   = '';
    $wherePorta = '';
    $whereTipoMovi     = '';
    $wherePeriodo      = '';

    //Sessões para retorno
    $_SESSION['relatMovi']      = '';
    $_SESSION['relatMoviArmario'] = '';
    $_SESSION['relatMoviPorta'] = '';
    $_SESSION['relatMoviTipo']   = '';
    $_SESSION['relatMoviPeriodo']   = '';

    //Validar filtros
    if($armario != '') {
        $whereArmario = " AND arm.local LIKE '%".$armario."%' ";
    }

    if($porta != '') {
        $wherePorta = " AND por.referencia = ".$porta;
    }

    if($tipomovi != '') {
        $whereTipoMovi = " AND movi.status >= ".$tipomovi;
    }

    if($periodo != '') {
        $wherePeriodo = " AND movi.movimentacao <= ".$periodo;
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
                .'<td>'.$coluna["local"].'</td>'
                .'<td>'.$coluna["referencia"].'</td>'
                .'<td>'.$coluna["status"].'</td>'
                .'<td>'.$coluna["movimentacao"].'</td>'
            .'</tr>';             
                      
        }    
    }
    
    $_SESSION['relatProdutos']      = $lista;
    $_SESSION['relatMoviArmario'] = $armario;
    $_SESSION['relatMoviPorta'] = $porta;
    $_SESSION['relatMoviTipo']   = $tipomovi;
    $_SESSION['relatMoviPeriodo']   = $periodo;

    header("location: ../relatorio-movi.php");

?>