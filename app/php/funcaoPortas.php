<?php
//Função para listar todos as movimentaçoens
function listaPortas(){

    include("conexao.php");

    $sql = "SELECT * FROM tb_porta ORDER BY id_porta;";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';
    $ativo = '';
    $icone = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {
            
            //Adiciona icone para usuarios ativos ou desativos
            if($coluna["flg_ativo"] == 'S'){  
                $ativo = 'checked';
                $icone = '<h6><i class="fas fa-check-circle text-success"></i></h6>'; 
            }else{
                $ativo = '';
                $icone = '<h6><i class="fas fa-times-circle text-danger"></i></h6>';
            } 

            if($coluna["status"] == 'D'){  
                $ativo = 'checked';
                $status = 'Disponivel'; 
            }else{
                $ativo = '';
                $status = 'Oculpado';
            } 


            //Monta os itens da tabela com os dados do BD
            $lista .= 
            '<tr>'            
                .'<td align="center">'.$coluna["id_porta"].'</td>'
                .'<td>'.$coluna["referencia"].'</td>'           
                .'<td align="center">'.descrArmario($coluna["id_armario"]).'</td>'  
                .'<td>'.$status.'</td>' 
                .'<td>'.$icone.'</td>' 
                .'<td>'
                    .'<div class="row" align="center">'
                        .'<div class="col-6">'
                            .'<a href="#modalEditPorta'.$coluna["id_porta"].'" data-toggle="modal">' // Modal para editar
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar empresa"></i></h6>'
                            .'</a>'
                        .'</div>'
                        
                        .'<div class="col-6">' 
                            .'<a href="#modalDeletePorta'.$coluna["id_porta"].'" data-toggle="modal">' // Modal para excluir
                                .'<h6><i class="fas fa-trash text-danger" data-toggle="tooltip" title="Excluir empresa"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'         
            .'</tr>';            
        }            
    }   
    return $lista;
}

//Função para buscar a descrição do armário
function descrArmario($id){
    $local = "";

    include("conexao.php");  

    $sql = "SELECT local FROM tb_armario WHERE id_armario = $id;";        
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $coluna) {            
            $local = $coluna["local"];
        }        
    } 

    return $local;
}



?>



