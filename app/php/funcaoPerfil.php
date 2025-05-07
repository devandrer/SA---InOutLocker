<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$nomePerfil = '';
$matriculaPerfil = '';
$emailPerfil = '';
$senhaPerfil = '';

function atualizarSenha($id){

    $resp = "";

    include("conexao.php");
    $sql = "SELECT Login FROM usuarios WHERE idUsuario = $id;";        
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
                
        $array = array();
        
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($array,$linha);
        }
        
        foreach ($array as $coluna) {            
            //***Verificar os dados da consulta SQL
            $resp = $coluna["Login"];
        }        
    } 

    return $resp;
}




?>