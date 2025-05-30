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
    $wherePeriodoInicio      = '';
    $wherePeriodoFinal     = '';

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
        $wherePorta = " AND por.referencia LIKE '%".$porta."%' ";
    }

    if($tipomovi != '') {
        $whereTipoMovi = " AND movi.status = ".$tipomovi;
    }

    if($periodo != '') {
        $wherePeriodoInicio = " AND movi.movimentacao >= ".$periodo;
    }


    if($periodo != '') {
        $wherePeriodoFinal = " AND movi.movimentacao <= ".$periodo;
    }


    include("conexao.php");

    $sql = "SELECT 
        arm.local,
        por.referencia, 
        movi.status, 
        movi.movimentacao 
        FROM tb_movimentacao AS movi 
        INNER JOIN tb_porta AS por ON movi.id_porta = por.id_porta 
        INNER JOIN tb_armario AS arm ON por.id_armario = arm.id_armario 
        WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]
        .$whereArmario
        .$wherePorta
        .$whereTipoMovi
        .$wherePeriodoInicio
        .$wherePeriodoFinal;
            
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
    
    $_SESSION['relatMovi']      = $lista;
    $_SESSION['relatMoviArmario'] = $armario;
    $_SESSION['relatMoviPorta'] = $porta;
    $_SESSION['relatMoviTipo']   = $tipomovi;
    $_SESSION['relatMoviPeriodo']   = $periodo;

    header("location: ../relatorio-movi.php");

?>