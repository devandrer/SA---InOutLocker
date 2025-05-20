<?php
    //Importa as funções
    include('funcoes.php');
    date_default_timezone_set('America/Sao_Paulo');
    
    //Pega os valores do formulario que serão inseridos no banco
    $idPorta = $_GET['porta'];
    $matricula = $_POST["nMatricula"];
    $nome = $_POST["nNome"];
    $dataMov = date("Y-m-d H:i:s");
    $ativo = $_POST["nAtivo"];
    //Busca o próximo ID na tabela
    $idMov = proximoID("tb_movimentacao","id_movimentacao");

    //Variavel passada pela URL que defina a função a ser excutada
    //Podem do ser I = inserir, A = alterar, D = deletar
    $funcao      = $_GET["funcao"];

    //Abre conexão com o banco
    include("conexao.php");
    //Validar se é Inclusão ou Alteração ou Exclusão
    if($funcao == "Entrada"){
        //INSERT
        $sql = "SELECT id_usuario FROM tb_usuario WHERE matricula = $matricula";
        $result = mysqli_query($conn,$sql);
        foreach ($result as $coluna){
            $idUsuario = $coluna["id_usuario"];
        }
        $sql = "INSERT INTO tb_movimentacao VALUES($idMov,'$dataMov','$funcao',$idUsuario,$idPorta)";
        $result = mysqli_query($conn,$sql);
        
        $sql = "UPDATE tb_porta SET status = 'O' WHERE id_porta = $idPorta;";
        $result = mysqli_query($conn,$sql);
        
    }elseif($funcao == "Saída"){
        
        $sql = "SELECT id_usuario FROM tb_movimentacao WHERE id_porta = ".$idPorta." ORDER BY id_movimentacao DESC LIMIT 1;";
        $result = mysqli_query($conn,$sql);
        
        foreach ($result as $coluna){
            $idUsuario = $coluna["id_usuario"];
        }
        
        $sql = "INSERT INTO tb_movimentacao VALUES($idMov,'$dataMov','$funcao',$idUsuario,$idPorta)";
        $result = mysqli_query($conn,$sql);
        
        $sql = "UPDATE tb_porta SET status = 'D' WHERE id_porta = $idPorta;";
        $result = mysqli_query($conn,$sql);
    } else if($funcao == "Ativo"){
        $ativo = ($ativo == "N") ? "S" : "N";
        $sql = "UPDATE tb_porta SET flg_ativo = '$ativo' WHERE id_porta = $idPorta;";
        
        $result = mysqli_query($conn,$sql);
    }

    //Fecha conexão com banco
    mysqli_close($conn);

    
    //Volta para a tela de usuarios
    header("location: ../reservas.php");
?>