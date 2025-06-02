<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include('funcoes.php');

    //Filtros de tela
    $armario= $_POST["nArmario"];
    $porta = $_POST["nPorta"];
    $tipomovi      = $_POST["nTipoMovi"];
    $periodoinicio      = $_POST["nPeriodoInicio"];
    $periodofim      = $_POST["nPeriodoFim"];

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
    $_SESSION['relatMoviPeriodoInicio']   = '';
    $_SESSION['relatMoviPeriodoFim']   = '';

    //Validar filtros
    if($armario != '') {
        $whereArmario = " AND arm.local LIKE '%".$armario."%' ";
    }

    if($porta != '') {
        $wherePorta = " AND por.referencia LIKE '%".$porta."%' ";
    }

    if($tipomovi != '0') {
        $whereTipoMovi = " AND movi.status = '".$tipomovi."' ";
    }

    if($periodoinicio != '') {
        $wherePeriodoInicio = " AND movi.movimentacao >= '".$periodoinicio."' ";
    }


    if($periodofim != '') {
        $wherePeriodoFinal = " AND movi.movimentacao <= '".$periodofim."' ";
    }


    include("conexao.php");
    // script sql para puxar as infos do banco
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
    
    // variaveis de retorno são passadas para as variaveis com os "names", para poder aparer na tela
    $_SESSION['relatMovi']      = $lista;
    $_SESSION['relatMoviArmario'] = $armario;
    $_SESSION['relatMoviPorta'] = $porta;
    $_SESSION['relatMoviTipo']   = $tipomovi;
    $_SESSION['relatMoviPeriodo']   = $periodo;

    header("location: ../relatorio-movi.php");

?>