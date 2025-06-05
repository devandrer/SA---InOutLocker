<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

//Função para listar todos as movimentaçoens
function listaMovimentacao(){

    include("conexao.php");

    $sql = "SELECT
                arm.local as descr,
                por.referencia as ref,
                mov.id_usuario as idUser,
                mov.status as status,
                mov.movimentacao as movi 
            FROM tb_movimentacao mov 
            INNER JOIN tb_porta por 
            ON mov.id_porta = por.id_porta
            INNER JOIN tb_armario arm
            ON arm.id_armario = por.id_armario
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]."
            ORDER BY mov.movimentacao DESC;";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';
    $ativo = '';
    $icone = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
       
        foreach ($result as $coluna) {        
            //***Verificar os dados da consulta SQL
            $lista .= 
            '<tr>'            
                .'<td align="center">'.$coluna["descr"].'</td>'                
                .'<td align="center">'.$coluna["ref"].'</td>'                
                .'<td align="center">'.descrUsuario($coluna["idUser"]).'</td>'
                .'<td align="center">'.date("d/m/Y H:i:s",strtotime($coluna["movi"])).'</td>'
                .'<td align="center">'.$coluna["status"].'</td>'
            .'</tr>';            
        }            
    }   
    return $lista;
}

function getEntradas(){
    
    include("conexao.php");
    $dataAtual = date("Y-m-d");

    $sql = "SELECT count(status) as sta FROM tb_movimentacao mov
            INNER JOIN tb_usuario usu ON mov.id_usuario = usu.id_usuario
            WHERE usu.id_empresa=".$_SESSION["idEmpresa"]."
            AND mov.status = 'Entrada'
            AND mov.movimentacao >= '$dataAtual';";
     
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
       
        foreach ($result as $coluna) {        
            //***Verificar os dados da consulta SQL
            $lista = $coluna['sta'];         
        }            
    }   
    return $lista;
}

function getSaidas(){
    
    include("conexao.php");
    $dataAtual = date("Y-m-d");

    $sql = "SELECT count(status) as sta FROM tb_movimentacao mov
            INNER JOIN tb_usuario usu ON mov.id_usuario = usu.id_usuario
            WHERE usu.id_empresa=".$_SESSION["idEmpresa"]."
            AND mov.status = 'Saída'
            AND mov.movimentacao >= '$dataAtual';";
     
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
       
        foreach ($result as $coluna) {        
            //***Verificar os dados da consulta SQL
            $lista = $coluna['sta'];         
        }            
    }   
    return $lista;
}

function optionMovimentacao(){

    $lista = "";

    include("conexao.php");
    $sql = "SELECT movi.id_movimentacao, 
                   movi.status 
                   FROM tb_porta AS por 
                   INNER JOIN 
                   tb_movimentacao AS movi 
                   ON movi.id_porta = por.id_porta ORDER BY status DESC";        
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL
            $lista .= '<option value="'.$coluna['id_movimentacao'].'">'.$coluna['status'].'</option>';
        }        
    } 

    return $lista;

}


function getTempoMedio(){

    include("conexao.php");
    $dataAtual = date("Y-m-d");
    $sql = 'SELECT 
                TIME_TO_SEC(movimentacao) as entradaSum
            FROM tb_movimentacao
            WHERE movimentacao BETWEEN "'.$dataAtual.' 00:00:00" AND "'.$dataAtual.' 23:59:59"
            AND status = "Entrada" ORDER BY id_movimentacao';
    
    $resultEntradas = mysqli_query($conn,$sql);
    
    $sql = 'SELECT 
                TIME_TO_SEC(movimentacao) as saidaSum
            FROM tb_movimentacao
            WHERE movimentacao BETWEEN "'.$dataAtual.' 00:00:00" AND "'.$dataAtual.' 23:59:59"
            AND status = "Saída" ORDER BY id_movimentacao';
            
    $resultSaidas = mysqli_query($conn,$sql);
   
    mysqli_close($conn);

    if($resultEntradas->num_rows == 0 || $resultSaidas->num_rows == 0){
        return 0 . " h";
    }

    $valoresEntrada = [];
    $valoresSaida = [];
    $somaEntrada = 0;
    $somaSaida = 0;

    foreach($resultEntradas as $colunaEntrada) {
        array_push($valoresEntrada,intval($colunaEntrada["entradaSum"]) );
    }
    foreach($resultSaidas as $colunaSaida) {
        array_push($valoresSaida,intval($colunaSaida["saidaSum"]) );
    }

    if(count($valoresEntrada) > count($valoresSaida)) {
        for ($i=0; $i < count($valoresEntrada) - 1; $i++) { 
            $somaEntrada =  $somaEntrada + $valoresEntrada[$i];
            $somaSaida = $somaSaida + $valoresSaida[$i];
        }
    } else {
        for ($i=0; $i < count($valoresSaida); $i++) { 
            $somaEntrada =  $somaEntrada + $valoresEntrada[$i];
            $somaSaida = $somaSaida + $valoresSaida[$i];
        }
    }

    $mediaUso = round(($somaSaida - $somaEntrada) / $resultSaidas->num_rows,2);

    return gmdate("H:i:s", $mediaUso);
}

?>



