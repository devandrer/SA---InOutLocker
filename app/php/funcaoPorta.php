<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
// Retorna um lista com as portas do armario indicado
function listaPortaReserva($armario = 1){

    //Abre conexão com o banco
    include("conexao.php");
    //Busca todas as portas do determinado armario
    $sql = "SELECT * FROM tb_porta WHERE id_armario = $armario ORDER BY id_porta;";

    //Executa o comando SQL e armazena o resultado            
    $result = mysqli_query($conn, $sql);
    //Fecha conexão com banco
    mysqli_close($conn);

    //Define variaveis
    $lista = '';
    $ativo = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {

        foreach ($result as $coluna) {

            //Muda a cor do centro da porta e define a modal
            if ($coluna["status"] == 'D') {
                $status = "background-color: green;";
                $modal = "#novoRegistroModal".$coluna["id_porta"];
            } else {
                $status = "background-color: red;";
                $modal = "#fecharRegistroModal".$coluna["id_porta"];
            }
            // PREENCHER QUANTO ESTIVER PRONTO
            if ($coluna["flg_ativo"] == 'S') {
                $ativo = 'Desativar';
                $check = 'checked';
                $btnDisabled = '';
            } else {
                $ativo = 'Ativar';
                $check = '';
                $status = "background-color: grey;";
                $btnDisabled = 'disabled';
            }


            //Monta os itens da tabela com os dados do BD
            $lista .= '
                <div class="col-2">
                    <div class="card border border-dark porta-armario" style="background-color: beige; box-shadow: 3px 3px 3px 3px #999;">
                        <button class="border border-dark porta-armario-botao" style="' . $status . '" data-toggle="modal" data-target="' . $modal . '" '.$btnDisabled.'>
                            '.$coluna["referencia"].'                            
                        </button>
                        <div class="border-bottom border-dark" style="width: 5rem;">
                        </div>
                        <div class="form-group m-0" style="position: absolute; bottom: -15px; right: -10px; padding: 5px;">';
            if($_SESSION["idTipoUsuario"] == 1) {
                $lista .= '
                        <label class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input id="iSwitch'.$coluna["id_porta"].'" '.$check.' class="custom-control-input" type="checkbox" data-toggle="modal" data-target="#modalAtivo'.$coluna["id_porta"].'">
                            <label class="custom-control-label" for="iSwitch'.$coluna["id_porta"].'"></label>
                        </label>';
            }            
             $lista .= '
                </div>
                    <!--
                    <button data-toggle="modal" data-target="#modalAtivo'.$coluna["id_porta"].'">'.$ativo.'</button>
                    -->
                </div>

                    
                </div>
                <div class="modal fade" id="modalAtivo'.$coluna["id_porta"].'">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">'.$ativo.' porta</h4>
                                    <button type="button" id="ativo" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="php/salvarMovimentacao.php?funcao=Ativo&porta='.$coluna["id_porta"].'" enctype="multipart/form-data">

                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" id="iCancelar'.$coluna["id_porta"].'" class="btn btn-danger" data-dismiss="modal">Não</button>
                                            <button type="submit" name="nAtivo" value="'.$coluna["flg_ativo"].'" class="btn btn-success">Sim</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>       
                ';
            //Adiciona a modal de nova reserva para portas com o status de disponivel
            //ou
            //Adiciona a modal de fechar reserva para portas com o status de ocupado
            if ($coluna["status"] == 'D') {
                $lista .= '
                <div class="modal fade" id="novoRegistroModal'.$coluna["id_porta"].'"">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title">Reservar porta</h4>
                                <button type="button" id="novousuario" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="php/salvarMovimentacao.php?funcao=Entrada&porta='.$coluna["id_porta"].'" enctype="multipart/form-data">

                                    <div class="row d-flex justify-content-center">
                                      
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="iMatricula">Matrícula:</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="iMatricula" 
                                                    name="nMatricula" 
                                                    maxlength="7" 
                                                    pattern="[0-9]{7}" 
                                                    required
                                                    title="Matricula deve ter 7 digitos"
                                                >
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            ';
            } else {
                
                $lista .= '
                        <div class="modal fade" id="fecharRegistroModal'.$coluna["id_porta"].'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="modal-title">Liberar porta</h4>
                                        <button type="button" id="novousuario" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="php/salvarMovimentacao.php?funcao=Saída&porta='.$coluna["id_porta"].'" enctype="multipart/form-data">

                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                                <button type="submit" class="btn btn-success">Sim</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    ';
            }
        }
    }

    return $lista;
}


function listaJSPorta(){

    //Abre conexão com o banco
    include("conexao.php");
    //Busca todas as portas do determinado armario
    $sql = "SELECT * FROM tb_porta";

    //Executa o comando SQL e armazena o resultado            
    $result = mysqli_query($conn, $sql);
    //Fecha conexão com banco
    mysqli_close($conn);

    //Define variaveis
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {

        foreach ($result as $coluna) {

            //Monta os itens da tabela com os dados do BD
            // $lista .= '
            //     document.getElementById("iCancelar'.$coluna["id_porta"].'").onclick = () => {
            //     let checkbox = document.getElementById("iSwitch'.$coluna["id_porta"].'")
            //     checkbox.checked = (checkbox.checked == true) ? false : true
            //     }
            // ';
            $lista .= '
                $("#modalAtivo'.$coluna["id_porta"].'").on("hidden.bs.modal", function (event) {
                    let checkbox = document.getElementById("iSwitch'.$coluna["id_porta"].'")
                    checkbox.checked = (checkbox.checked == true) ? false : true
                })
            ';
        }
    }

    return $lista;
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

//Função para listar todos as movimentaçoes
function listaPortas(){
    include("conexao.php");

    $sql = "SELECT
                tb_porta.id_porta,
                tb_porta.referencia,
                tb_porta.status,
                tb_porta.flg_ativo,
                tb_armario.local,
                tb_armario.id_armario,
                tb_armario.id_empresa
            FROM
                tb_porta
            INNER JOIN
                tb_armario
            ON
                tb_porta.id_armario = tb_armario.id_armario
            WHERE
                tb_armario.id_empresa = ".$_SESSION["idEmpresa"]." ;";
    
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
                .'<td align="center">'.descrArmarioPorta($coluna["id_armario"]).'</td>'  
                .'<td align="center">'.$status.'</td>' 
                .'<td align="center">'.$icone.'</td>' 
                .'<td align="center">'
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
                                            .'<option value="'.$coluna["id_armario"].'">'.descrArmarioPorta($coluna["id_armario"]).'</option>'
                                            .optionPorta()
                                        .'</select>'
                                    .'</div>'
                                    // .'<div class="col-6">'
                                    //     .'<label>Status:</label>'
                                    //     .'<select name="nStatus" class="form-control">'
                                    //         .'<option value="D" '.($coluna["status"] == 'D' ? 'selected' : '').'>Disponível</option>'
                                    //         .'<option value="I" '.($coluna["status"] == 'I' ? 'selected' : '').'>Indisponível</option>'
                                    //     .'</select>'
                                    // .'</div>'
                                    .'<div class="col-12">'
                                        .'<input type="checkbox" name="nAtivo" '.$ativo.'>'
                                        .'<label>Porta Ativa</label>'
                                    .'</div>'
                                .'</div>'
                                .'<div class="modal-footer">'
                                    .'<button type="submit" id="btDeFecharPorta" name="btSalvaPorta" value="modal_limpar" class="btn btn-danger">Fechar</button>'
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
function descrArmarioPorta($id){
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

function getPortasAbertas(){
    
    include("conexao.php");


    $sql = "SELECT count(por.referencia) as ref 
            FROM tb_armario arm
            INNER JOIN tb_porta por ON por.id_armario = arm.id_armario
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]."
            AND por.status = 'D'
            AND por.flg_ativo= 'S'";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
       
        foreach ($result as $coluna) {        
            //***Verificar os dados da consulta SQL
            $lista = $coluna['ref'];         
        }            
    }   
    return $lista;
}

function getPortasFechadas(){
    
    include("conexao.php");


    $sql = "SELECT count(por.referencia) as ref 
            FROM tb_armario arm
            INNER JOIN tb_porta por ON por.id_armario = arm.id_armario
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]."
            AND por.status = 'O'";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    
    $lista = '';

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {        
       
        foreach ($result as $coluna) {        
            //***Verificar os dados da consulta SQL
            $lista = $coluna['ref'];         
        }            
    }   
    return $lista;
}

function portaAtivasInativas(){

    $somaAtivo  = 0;
    $somaInativo = 0;

    include("conexao.php");
    $sql = "SELECT * 
            FROM tb_armario arm
            INNER JOIN tb_porta por ON por.id_armario = arm.id_armario
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]."";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL

            if($coluna['flg_ativo'] == 'S'){
                $somaAtivo++;
            }else{
                $somaInativo++;
            }

        }   

    } 
    $retorno = $somaAtivo.",".$somaInativo;

    return $retorno;

}

function portaLivreOcupado(){

    $somaDisponivel  = 0;
    $somaOcupado = 0;

    include("conexao.php");
    $sql = "SELECT * 
            FROM tb_armario arm
            INNER JOIN tb_porta por ON por.id_armario = arm.id_armario
            WHERE arm.id_empresa = ".$_SESSION["idEmpresa"]."";
            
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($result) > 0) {
        
        foreach ($result as $coluna) {            
            //***Verificar os dados da consulta SQL

            if($coluna['flg_ativo'] == 'D'){
                $somaDisponivel++;
            }else{
                $somaOcupado++;
            }

        }   

    } 
    $retorno = $somaDisponivel.",".$somaOcupado;

    return $retorno;

}


?>