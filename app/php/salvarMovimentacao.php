<?php
    //Importa as funções
    include('funcoes.php');
    date_default_timezone_set('America/Sao_Paulo');
    
    //Pega os valores do formulario que serão inseridos no banco
    $idPorta = $_GET['porta'];
    $matricula = $_POST["nMatricula"];
    $nome = $_POST["nNome"];
    $dataMov = date("Y-m-d H:i:s");
    //Busca o próximo ID na tabela
    $idMov = proximoID("tb_movimentacao","id_movimentacao");

    //Variavel passada pela URL que defina a função a ser excutada
    //Podem do ser I = inserir, A = alterar, D = deletar
    $funcao      = $_GET["funcao"];

    //Transforma o retorno da check-box do form em S ou N para ativo e desativo
    // if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";
    
    //Abre conexão com o banco
    include("conexao.php");

    $sql = "SELECT id_usuario FROM tb_usuario WHERE matricula = $matricula";
    $result = mysqli_query($conn,$sql);
    foreach ($result as $coluna){
        $idUsuario = $coluna["id_usuario"];
    }

    //Validar se é Inclusão ou Alteração ou Exclusão
    if($funcao == "Entrada"){
        //INSERT
        $sql = "INSERT INTO tb_movimentacao VALUES($idMov,'$dataMov','$funcao',$idUsuario,$idPorta)";
        
    }elseif($funcao == "Saída"){
        //DELETE
        $sql = "";
    }

    //Executa o comando SQL e armazena o resultado
    $result = mysqli_query($conn,$sql);
    //Fecha conexão com banco
    mysqli_close($conn);

    
    //Volta para a tela de usuarios
    header("location: ../reservas.php");
?>