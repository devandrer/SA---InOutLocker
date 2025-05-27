<?php
//Função para listar todos os armarios
function listaArmarioReserva(){

    include("conexao.php");
    $sql = "SELECT * FROM tb_armario";
                
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        
        foreach ($result as $coluna) {
                      
            //***Verificar os dados da consulta SQL
            $lista .= '<button class="btn btn-outline-primary" name="nArmario" value='.$coluna["id_armario"].'>'.$coluna["local"].'</button>';            
                       
        }    
    }
    
    return $lista;
}
