<?php
session_start();
//Função para listar todos os usuários
function listaUsuario(){
    //Abre conexão com o banco
    include("conexao.php");
    //SELECT
    $sql = "SELECT * FROM tb_usuario WHERE id_empresa = ".$_SESSION["idEmpresa"]." ORDER BY id_usuario;";

    //Executa o comando SQL e armazena o resultado            
    $result = mysqli_query($conn,$sql);
    //Fecha conexão com banco
    mysqli_close($conn);
    
    //Define variaveis
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
            

            //Monta os itens da tabela com os dados do BD
            $lista .= 
            '<tr>'
                .'<td align="center">'.$coluna["id_usuario"].'</td>'
                .'<td align="center">'.$coluna["nome"].'</td>'
                .'<td align="center">'.descrTipoUsuario($coluna["id_tipo_usuario"]).'</td>'
                .'<td align="center">'.$coluna["matricula"].'</td>'
                .'<td align="center">'.$icone.'</td>'
                .'<td>'
                    .'<div class="row" align="center">'
                        .'<div class="col-6">'
                            .'<a href="#modalEditUsuario'.$coluna["id_usuario"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar usuário"></i></h6>'
                            .'</a>'
                        .'</div>'
                        
                        .'<div class="col-6">'
                            .'<a href="#modalDeleteUsuario'.$coluna["id_usuario"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-trash text-danger" data-toggle="tooltip" title="Excluir usuário"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'
            
            .'<div class="modal fade" id="modalEditUsuario'.$coluna["id_usuario"].'">'
                .'<div class="modal-dialog modal-lg">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title">Alterar Usuário</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'

                            .'<form method="POST" action="php/salvarUsuario.php?funcao=A&codigo='.$coluna["id_usuario"].'" enctype="multipart/form-data">'              
                
                                    .'<div class="row">'
                                    // .'<div class="col-5">'
                                    //     .'<div class="form-group">'
                                    //         .'<label for="iTipoUsuario">Tipo de Usuário:</label>'
                                    //         .'<select name="nTipoUsuario" class="form-control" required>'
                                    //             .'<option value="'.$coluna["id_tipo_usuario"].'">'.descrTipoUsuario($coluna["id_tipo_usuario"]).'</option>'
                                    //             .optionTipoUsuario()
                                    //         .'</select>'
                                    //     .'</div>'
                                    // .'</div>'
                    
                                    .'<div class="col-6">'
                                        .'<div class="form-group">'
                                            .'<label for="iNome">Nome:</label>'
                                            .'<input type="text" value="'.$coluna["nome"].'" class="form-control" id="iNome" name="nNome" maxlength="50">'
                                        .'</div>'
                                    .'</div>'
                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iCpf">CPF:</label>'
                                            .'<input type="text" value="'.$coluna["cpf"].'" class="form-control" id="iCpf" name="nCpf" maxlength="14">'
                                        .'</div>'
                                    .'</div>'

                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iTipoUsuario">Tipo de Usuário:</label>'
                                            .'<select name="nTipoUsuario" class="form-control" required>'
                                                .'<option value="'.$coluna["id_tipo_usuario"].'">'.descrTipoUsuario($coluna["id_tipo_usuario"]).'</option>'
                                                .optionTipoUsuario()
                                            .'</select>'
                                        .'</div>'
                                    .'</div>'

                                    .'<div class="col-6">'
                                        .'<div class="form-group">'
                                            .'<label for="iEmpresa">Empresa:</label>'
                                            .'<select name="nEmpresa" class="form-control" required>'
                                                .'<option value="'.$coluna["id_empresa"].'">'.razaoempresa($coluna["id_empresa"]).'</option>'
                                                .optionEmpresa()
                                            .'</select>'
                                        .'</div>'
                                    .'</div>'

                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iLogin">Login:</label>'
                                            .'<input type="text" value="'.$coluna["login"].'" class="form-control" id="iLogin" name="nLogin" maxlength="80">'
                                        .'</div>'
                                    .'</div>'
                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iSenha">Senha:</label>'
                                            .'<input type="password" value="" class="form-control" id="iSenha'.$coluna["id_usuario"].'" name="nSenha" maxlength="32">'
                                            .'<i class="fas fa-eye-slash" id="iSenhaIcon'.$coluna["id_usuario"].'" style="position: absolute; right: 15px; top: 44px;cursor: pointer;"></i>'
                                        .'</div>'
                                    .'</div>'
                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iMatricula">Matricula:</label>'
                                            .'<input type="text" value="'.$coluna["matricula"].'" class="form-control" id="iMatricula" name="nMatricula" Readonly maxlength="6">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    .'<div class="col-9">'
                                        .'<div class="form-group">'
                                            .'<label for="iFoto">Foto:</label>'
                                            .'<input type="file" class="form-control" id="iFoto" name="Foto" accept="image/*">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    .'<div class="col-12">'
                                        .'<div class="form-group">'
                                            .'<input type="checkbox" id="iAtivo" name="nAtivo" '.$ativo.'>'
                                            .'<label for="iAtivo">Usuário Ativo</label>'
                                        .'</div>'
                                    .'</div>'
                                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iCep">CEP:</label>'
                                            .'<input type="text" value="'.$coluna["cep"].'" class="form-control" id="iCep" name="CEP" maxlength="20">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    
                                    .'<div class="col-7">'
                                        .'<div class="form-group">'
                                            .'<label for="iEndereco">Endereco:</label>'
                                            .'<input type="text" value="'.$coluna["endereco"].'" class="form-control" id="iEndereco" name="Endereco" maxlength="50">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    .'<div class="col-2">'
                                        .'<div class="form-group">'
                                            .'<label for="iNumero">Número:</label>'
                                            .'<input type="text" value="'.$coluna["numero"].'" class="form-control" id="iNumero" name="Numero" maxlength="50">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    .'<div class="col-6">'
                                        .'<div class="form-group">'
                                            .'<label for="iBairro">Bairro:</label>'
                                            .'<input type="text" value="'.$coluna["bairro"].'" class="form-control" id="iBairro" name="Bairro" maxlength="50">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iCidade">Cidade:</label>'
                                            .'<input type="text" value="'.$coluna["cidade"].'" class="form-control" id="iCidade" name="Cidade" maxlength="50">'
                                        .'</div>'
                                    .'</div>'
                                    
                                    
                                    .'<div class="col-3">'
                                        .'<div class="form-group">'
                                            .'<label for="iUf">UF:</label>'
                                            .'<input type="text" value="'.$coluna["uf"].'" class="form-control" id="iUf" name="UF" maxlength="2">'
                                        .'</div>'
                                    .'</div>'
                                    
                
                                .'</div>'
                
                                .'<div class="modal-footer">'
                                    .'<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>'
                                    .'<button type="submit" class="btn btn-success">Salvar</button>'
                                .'</div>'
                                
                            .'</form>'
                            
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            
            .'<div class="modal fade" id="modalDeleteUsuario'.$coluna["id_usuario"].'">'
                .'<div class="modal-dialog">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-danger">'
                            .'<h4 class="modal-title">Excluir Usuário: '.$coluna["id_usuario"].'</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'

                            .'<form method="POST" action="php/salvarUsuario.php?funcao=D&codigo='.$coluna["id_usuario"].'" enctype="multipart/form-data">'              

                                .'<div class="row">'
                                    .'<div class="col-12">'
                                        .'<h5>Deseja EXCLUIR o usuário '.$coluna["nome"].'?</h5>'
                                    .'</div>'
                                .'</div>'
                                
                                .'<div class="modal-footer">'
                                    .'<button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>'
                                    .'<button type="submit" class="btn btn-success">Sim</button>'
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

function visibilidadeSenha(){

    //Abre conexão com o banco
    include("conexao.php");
    //SELECT
    $sql = "SELECT * FROM tb_usuario WHERE id_empresa = ".$_SESSION["idEmpresa"]." ORDER BY id_usuario;";

    //Executa o comando SQL e armazena o resultado            
    $result = mysqli_query($conn,$sql);
    //Fecha conexão com banco
    mysqli_close($conn);
    
    //Define variaveis
    $lista = '';

    foreach($result as $coluna) {
        $lista.= '
            let senhaIcon'.$coluna["id_usuario"].' = document.getElementById("iSenhaIcon'.$coluna["id_usuario"].'");
            let senhaInput'.$coluna["id_usuario"].' = document.getElementById("iSenha'.$coluna["id_usuario"].'");
            senhaIcon'.$coluna["id_usuario"].'.onclick = () => {
            if(senhaInput'.$coluna["id_usuario"].'.type == "password"){
                senhaIcon'.$coluna["id_usuario"].'.className = "fas fa-eye-slash";
                senhaInput'.$coluna["id_usuario"].'.type = "text"
            }else{
                senhaIcon'.$coluna["id_usuario"].'.className = "fas fa-eye";
                senhaInput'.$coluna["id_usuario"].'.type = "password"
            }
        
            }';
    }

    return $lista;
}


//Função para retornar a qtd de usuários ativos
function qtdUsuariosAtivos(){
    $qtd = 0;

    include("conexao.php");
    $sql = "SELECT COUNT(*) AS Qtd FROM usuarios WHERE flg_ativo = 'S';";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL
            $qtd = $coluna['Qtd'];
        }        
    }
    
    return $qtd;
}

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

?>