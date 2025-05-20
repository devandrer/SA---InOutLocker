<?php
//Função para buscar a descrição do usuário
function descrUsuario($id){

    $nome = "";

    include("conexao.php");  

    $sql = "SELECT nome FROM tb_usuario WHERE id_usuario = $id;";        
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
                
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL
            $nome = $coluna["nome"];
        }        
    } 

    return $nome;
}

//Função para buscar a descrição da porta
function descrPorta($id){

    $referencia = "";

    include("conexao.php");
    $sql = "SELECT referencia FROM tb_porta WHERE id_porta = $id;";        
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
                
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL
            $referencia = $coluna["referencia"];
        }        
    } 

    return $referencia;
}

