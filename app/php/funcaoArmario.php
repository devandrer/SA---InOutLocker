<?php
//Função para listar todas as empresas
function listaArmario(){

    include("conexao.php");
    $sql = "SELECT arm.id_armario,arm.local,empr.razao_social,arm.flg_ativo 
    FROM tb_armario as arm 
    INNER JOIN tb_empresa as empr 
    ON arm.id_empresa = empr.id_empresa;";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';
    $ativo = '';
    $icone = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        
        foreach ($result as $coluna) {
            
            //Ativo: S ou N
            //if($coluna["FlgAtivo"] == 'S')  $ativo = 'checked'; else $ativo = '';
            if($coluna["flg_ativo"] == 'S'){  
                $ativo = 'checked';
                $icone = '<h6><i class="fas fa-check-circle text-success"></i></h6>'; 
            }else{
                $ativo = '';
                $icone = '<h6><i class="fas fa-times-circle text-danger"></i></h6>';
            } 
            

            //***Verificar os dados da consulta SQL
            $lista .=   
            '<tr>'   // Monta a tabela de armarios com as informações do banco
                .'<td align="center">'.$coluna["id_armario"].'</td>'
                .'<td>'.$coluna["local"].'</td>'
                .'<td>'.$coluna["razao_social"].'</td>'
                .'<td align="center">'.$icone.'</td>'
                .'<td>'
                    .'<div class="row" align="center">'
                        .'<div class="col-6">'
                            .'<a href="#modalEditArmario'.$coluna["id_armario"].'" data-toggle="modal">' // Modal para editar
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar armario"></i></h6>'
                            .'</a>'
                        .'</div>'
                        
                        .'<div class="col-6">' 
                            .'<a href="#modalDeleteArmario'.$coluna["id_armario"].'" data-toggle="modal">' // Modal para excluir
                                .'<h6><i class="fas fa-trash text-danger" data-toggle="tooltip" title="Excluir armario"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'
            
            .'<div class="modal fade" id="modalEditArmario'.$coluna["id_armario"].'">' // Modal para editar
                .'<div class="modal-dialog modal-lg">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title">Alterar Empresa</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'
                                // Pega a função de alterar no arquivo salvarEmpresa.php
                            .'<form method="POST" action="php/salvarArmario.php?funcao=A&codigo='.$coluna["id_armario"].'" enctype="multipart/form-data">'              
                
                                .'<div class="row">'
                                .' <div class="col-8">'
                                     .'<div class="form-group">'
                                        .' <label for="iLocal">Local:</label>'
                                         .'<input type="text" class="form-control"  value="'.$coluna["local"].'" id="iLocal" name="nLocal" maxlength="50">'
                                     .'</div>' //Coluna local
                                  .'</div>'

                                 .'<div class="col-8">'
                                     .'<div class="form-group">'
                                        .' <label for="iRazao">Empresa:</label>'
                                         .'<input type="text" class="form-control" value="'.$coluna["razao_social"].'" id="iRazao" name="nRazao" maxlength="50">'
                                     .'</div>' //Coluna razão social
                                 .'</div>'
                            
                                .'<div class="col-12">'
                                        .'<div class="form-group">'
                                            .'<input type="checkbox" id="iAtivo" name="nAtivo" '.$ativo.'>'
                                            .'<label for="iAtivo">Empresa Ativa</label>'
                                        .'</div>' //Coluna flg_ativo(verifica se a empresa está ativa)
                                    .'</div>'
                                 .'</div>'

                                 .'<div class="modal-footer">'
                                .' <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>' // Botão de fechar
                                 .'<button type="submit" class="btn btn-success">Salvar</button>' // Botão de Salvar
                                 .'</div>'
                                
                            .'</form>'
                            
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            
            .'<div class="modal fade" id="modalDeleteArmario'.$coluna["id_armario"].'">' //Modal de Deletar
                .'<div class="modal-dialog">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-danger">'
                            .'<h4 class="modal-title">Excluir Armário: '.$coluna["id_armario"].'</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'
                            // Pega a função de deletar no arquivo salvarEmpresa.php
                            .'<form method="POST" action="php/salvarArmario.php?funcao=D&codigo='.$coluna["id_armario"].'" enctype="multipart/form-data">'              

                                .'<div class="row">'
                                    .'<div class="col-12">'
                                        .'<h5>Deseja EXCLUIR o armario '.$coluna["local"].'?</h5>'
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
    
    return $lista;
}