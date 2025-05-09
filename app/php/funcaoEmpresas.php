<?php
//Função para listar todas as empresas
function listaEmpresa(){

    include("conexao.php");
    $sql = "SELECT * FROM tb_empresa ORDER BY id_empresa;";
            
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
            '<tr>'
                    .'<div class="row" align="center">'
                        .'<div class="col-6">'
                            .'<a href="#modalEditEmpresa'.$coluna["id_empresa"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-edit text-info" data-toggle="tooltip" title="Alterar empresa"></i></h6>'
                            .'</a>'
                        .'</div>'
                        
                        .'<div class="col-6">'
                            .'<a href="#modalDeleteEmpresa'.$coluna["id_empresa"].'" data-toggle="modal">'
                                .'<h6><i class="fas fa-trash text-danger" data-toggle="tooltip" title="Excluir empresa"></i></h6>'
                            .'</a>'
                        .'</div>'
                    .'</div>'
                .'</td>'
            .'</tr>'
            
            .'<div class="modal fade" id="modalEditEmpresa'.$coluna["id_empresa"].'">'
                .'<div class="modal-dialog modal-lg">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-info">'
                            .'<h4 class="modal-title">Alterar Empresa</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'

                            .'<form method="POST" action="php/salvarEmpresa.php?funcao=A&codigo='.$coluna["id_empresa"].'" enctype="multipart/form-data">'              
                
                                .'<div class="row">'
                                .' <div class="col-8">'
                                     .'<div class="form-group">'
                                        .' <label for="iRazao">Razão Social:</label>'
                                         .'<input type="text" class="form-control"  value="'.$coluna["razao_social"].'" id="iRazao" name="nRazao" maxlength="50">'
                                     .'</div>'
                                  .'</div>'

                                 .'<div class="col-8">'
                                     .'<div class="form-group">'
                                        .' <label for="iCnpj">CNPJ:</label>'
                                         .'<input type="text" class="form-control" value="'.$coluna["cnpj"].'" id="iCnpj" name="nCnpj" maxlength="50">'
                                     .'</div>'
                                 .'</div>'

                                 .'<div class="col-9">'
                                     .'<div class="form-group">'
                                         .'<label>Endereço</label>'
                                         .'<input required name="Endereco" type="text"  value="'.$coluna["endereco"].'" class="form-control">'
                                     .'</div>'
                                 .'</div>'

                                 .'<div class="col-5">'
                                     .'<div class="form-group">'
                                         .'<label>Cidade</label>'
                                         .'<input required name="Cidade" type="text"  value="'.$coluna["cidade"].'" class="form-control">'
                                      .'</div>'
                                 .'</div>'

                                 .'<div class="col-2">'
                                     .'<div class="form-group">'
                                         .'<label>UF</label>'
                                         .'<input required name="UF" type="text"  value="'.$coluna["uf"].'" class="form-control">'
                                     .'</div>'
                                 .'</div>'

                                 .'<div class="col-3">'
                                     .'<div class="form-group">'
                                         .'<label>CEP</label>'
                                         .'<input required name="CEP" type="text"  value="'.$coluna["cep"].'" class="form-control cep">'
                                     .'</div>'
                                  .'</div>'

                                 .'<div class="col-3">'
                                     .'<div class="form-group">'
                                         .'<label>Número</label>'
                                         .'<input required name="Numero" type="text"  value="'.$coluna["numero"].'" maxlength="8" class="form-control">'
                                     .'</div>'
                                 .'</div>'

                                 .'<div class="col-5">'
                                    .'<div class="form-group">'
                                         .'<label>Bairro</label>'
                                         .'<input required name="Bairro" type="text"  value="'.$coluna["bairro"].'" class="form-control">'
                                     .'</div>'
                                 .'</div>'
                            
                                .'<div class="col-12">'
                                        .'<div class="form-group">'
                                            .'<input type="checkbox" id="iAtivo" name="nAtivo" '.$ativo.'>'
                                            .'<label for="iAtivo">Empresa Ativa</label>'
                                        .'</div>'
                                    .'</div>'
                                 .'</div>'

                                 .'<div class="modal-footer">'
                                .' <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>'
                                 .'<button type="submit" class="btn btn-success">Salvar</button>'
                                 .'</div>'
                                
                            .'</form>'
                            
                        .'</div>'
                    .'</div>'
                .'</div>'
            .'</div>'
            
            .'<div class="modal fade" id="modalDeleteEmpresa'.$coluna["id_empresa"].'">'
                .'<div class="modal-dialog">'
                    .'<div class="modal-content">'
                        .'<div class="modal-header bg-danger">'
                            .'<h4 class="modal-title">Excluir Empresa: '.$coluna["id_empresa"].'</h4>'
                            .'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">'
                                .'<span aria-hidden="true">&times;</span>'
                            .'</button>'
                        .'</div>'
                        .'<div class="modal-body">'

                            .'<form method="POST" action="php/salvarEmpresa.php?funcao=D&codigo='.$coluna["id_empresa"].'" enctype="multipart/form-data">'              

                                .'<div class="row">'
                                    .'<div class="col-12">'
                                        .'<h5>Deseja EXCLUIR a empresa '.$coluna["razao_social"].'?</h5>'
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

//Próximo ID da empresa
function proxIdEmpresa(){

    $id = "";

    include("conexao.php");
    $sql = "SELECT MAX(id_empresa) AS Maior FROM tb_empresa;";        
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
            $id = $coluna["Maior"] + 1;
        }        
    } 

    return $id;
}



//Função para buscar o nome da empresa
function razaoempresa($id){

    $resp = "";

    include("conexao.php");
    $sql = "SELECT razao_social FROM tb_empresa WHERE id_empresa = $id;";        
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
            $resp = $coluna["razao"];
        }        
    } 

    return $resp;
}



//Função para buscar a flag FlgAtivo da empresa
function ativoEmpresa($id){

    $resp = "";

    include("conexao.php");
    $sql = "SELECT flg_ativo FROM tb_empresa WHERE id_empresa = $id;";        
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL
            if($coluna["flg_ativo"] == 'S') $resp = 'checked'; else $resp = '';
        }        
    } 

    return $resp;
}

//Função para retornar a qtd de empresa ativas
function qtdEmpresasAtivas(){
    $qtd = 0;

    include("conexao.php");
    $sql = "SELECT COUNT(*) AS Qtd FROM tb_empresa WHERE flg_ativo = 'S';";

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

?>