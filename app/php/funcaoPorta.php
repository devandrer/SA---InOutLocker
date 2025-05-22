<?php

// Retorna um lista com as portas do armario indicado
function listaPortaReserva($armario = 1)
{
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
                    <div class="card border border-dark porta-armario" style="background-color: beige;">
                        <button class="border border-dark porta-armario-botao" style="' . $status . '" data-toggle="modal" data-target="' . $modal . '" '.$btnDisabled.'>
                            '.$coluna["referencia"].'                            
                        </button>
                        <div class="border-bottom border-dark" style="width: 5rem;">
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input id="iSwitch'.$coluna["id_porta"].'" '.$check.' class="custom-control-input" type="checkbox" data-toggle="modal" data-target="#modalAtivo'.$coluna["id_porta"].'">
                                <label class="custom-control-label" for="iSwitch'.$coluna["id_porta"].'"></label>
                            </label>
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
                                                    pattern="[1-9]{7}" 
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
            $lista .= '
                document.getElementById("iCancelar'.$coluna["id_porta"].'").onclick = () => {
                let checkbox = document.getElementById("iSwitch'.$coluna["id_porta"].'")
                checkbox.checked = (checkbox.checked == true) ? false : true
                }
            ';
        }
    }

    return $lista;
}
