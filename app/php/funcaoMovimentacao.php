<?php
//Função para listar todos as movimentaçoens
function listaMovimentacao(){

    include("conexao.php");

    $sql = "SELECT * FROM tb_movimentacao ORDER BY id_porta;";
            
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
                .'<td align="center">'.$coluna["id_movimentacao"].'</td>'                
                .'<td>'.date("d/m/Y H:i:s",strtotime($coluna["movimentacao"])).'</td>'
                .'<td>'.$coluna["status"].'</td>'
                .'<td align="center">'.descrUsuario($coluna["id_usuario"]).'</td>'
                .'<td align="center">'.descrPorta($coluna["id_porta"]).'</td>'                
            .'</tr>';            
        }            
    }   
    return $lista;
}
?>



