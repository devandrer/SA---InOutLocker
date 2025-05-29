<?php
session_start();
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
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"].";";
            
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
    $dataAtual = date("Y-m-d H:i:s");

    $sql = "SELECT count(status) as sta FROM tb_movimentacao mov
            INNER JOIN tb_usuario usu ON mov.id_usuario = usu.id_usuario
            WHERE usu.id_empresa=".$_SESSION["idEmpresa"]."
            AND mov.status = 'Entrada'
            AND mov.movimentacao = '$dataAtual';";
     
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
    $dataAtual = date("Y-m-d H:i:s");

    $sql = "SELECT count(status) as sta FROM tb_movimentacao mov
            INNER JOIN tb_usuario usu ON mov.id_usuario = usu.id_usuario
            WHERE usu.id_empresa=".$_SESSION["idEmpresa"]."
            AND mov.status = 'Saída'
            AND mov.movimentacao = '$dataAtual';";
     
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

?>



