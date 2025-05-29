<?php
//Função para listar todos as movimentaçoes
function listaPortas(){
    include("conexao.php");

    $sql = "SELECT * FROM tb_porta ORDER BY id_porta;";
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';
    $ativo = '';
    $icone = '';
    $modais = '';
    $status = '';

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $coluna) {

            // Verifica flag ativo
            if($coluna["flg_ativo"] == 'S'){  
                $ativo = 'checked';
                $icone = '<h6><i class="fas fa-check-circle text-success"></i></h6>'; 
            }else{
                $ativo = '';
                $icone = '<h6><i class="fas fa-times-circle text-danger"></i></h6>';
            } 
            // Verifica status
            if($coluna["status"] == 'D'){  
                $status = 'Disponível'; 
            }else{
                $status = 'Indisponível';
            } 

            // Linha da tabela
            $lista .= 
            '<tr>'            
                .'<td align="center">'.$coluna["id_porta"].'</td>'
                .'<td align="center">'.htmlspecialchars($coluna["referencia"]).'</td>'           
                .'<td align="center">'.descrArmario($coluna["id_armario"]).'</td>'  
                .'<td align="center">'.$status.'</td>' 
                .'<td align="center">'.$icone.'</td>' 
                .'<td>'
                    .'<div class="row" align="center">'
                        .'<div class="col-6">'
                            .'<a href="#modalEditPorta'.$coluna["id_porta"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" title="Alterar Porta"></i></h6>'
                            .'</a>'
                        .'</div>'
                        .'<div class="col-6">' 
                            .'<a href="#modalDeletePorta'.$coluna["id_porta"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-trash text-danger" title="Excluir Porta"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'         
            .'</tr>';

            // Modal (guardado separado)
            $modais .= 
            '<div class="modal fade" id="modalEditPorta'.$coluna["id_porta"].'">'
                .'<div class="modal-dialog modal-lg">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title">Alterar Porta </h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal">&times;</button>'
                        .'</div>'
                        .'<div class="modal-body">'
                            .'<form method="POST" action="php/salvarPorta.php?funcao=A&id='.$coluna["id_porta"].'">'
                                .'<div class="row">'
                                    .'<div class="col-8">'
                                        .'<label>Nr da Porta:</label>'
                                        .'<input type="text" class="form-control" value="'.htmlspecialchars($coluna["referencia"]).'" name="nNrPorta">'
                                    .'</div>'
                                    .'<div class="col-6">'
                                        .'<label>Armário:</label>'
                                        .'<select name="nArmario" class="form-control">'
                                            .'<option value="'.$coluna["id_armario"].'">'.descrArmario($coluna["id_armario"]).'</option>'
                                            .optionPorta()
                                        .'</select>'
                                    .'</div>'
                                    .'<div class="col-6">'
                                        .'<label>Status:</label>'
                                        .'<select name="nStatus" class="form-control">'
                                            .'<option value="D" '.($coluna["status"] == 'D' ? 'selected' : '').'>Disponível</option>'
                                            .'<option value="I" '.($coluna["status"] == 'I' ? 'selected' : '').'>Indisponível</option>'
                                        .'</select>'
                                    .'</div>'
                                    .'<div class="col-12">'
                                        .'<input type="checkbox" name="nAtivo" '.$ativo.'>'
                                        .'<label>Porta Ativa</label>'
                                    .'</div>'
                                .'</div>'
                                .'<div class="modal-footer">'
                                    .'<button type="submit" name="btSalvaPorta" value="modal_limpar" class="btn btn-danger">Fechar</button>'
                                    .'<button type="submit" name="btSalvaPorta" value="modal_salvar" class="btn btn-success">Salvar</button>'
                                .'</div>'
                            .'</form>'
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'


            .'<div class="modal fade" id="modalDeletePorta'.$coluna["id_porta"].'">' //Modal de Deletar
                .'<div class="modal-dialog">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-danger">'
                            .'<h4 class="modal-title">Excluir Porta: '.$coluna["id_porta"].'</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'
                            // Pega a função de deletar no arquivo salvarPorta.php
                            .'<form method="POST" action="php/salvarPorta.php?funcao=D&id='.$coluna["id_porta"].'">' // Corrigido para usar 'id'
                                .'<div class="row">'
                                    .'<div class="col-12">'
                                        .'<h5>Deseja EXCLUIR a porta '.$coluna["referencia"].'?</h5>'
                                    .'</div>' //Confirma a exclusão
                                .'</div>'
                                
                                .'<div class="modal-footer">'
                                    .'<button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>' //NÃO
                                    .'<button type="submit" class="btn btn-success">Sim</button>' //SIM
                                .'</div>'
                                
                            .'</form>'
                            
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>';  

            
        }
    }

    return $lista . $modais;
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

// Função que retorna as opções de armários em <option>
function optionPorta() {
    include("conexao.php");

    $options = '';

    // Consulta todos os armários disponíveis
    $sql = "SELECT id_armario, local FROM tb_armario ORDER BY local;";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    // Verifica se encontrou algum resultado
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            $options .= '<option value="' . $row['id_armario'] . '">' . htmlspecialchars($row['local']) . '</option>';
        }
    }

    return $options;
}
?>
