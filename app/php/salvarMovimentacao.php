<?php
    //Importa as funções
    include('funcoes.php');
    //Define o fuso horário para o de Brasília
    date_default_timezone_set('America/Sao_Paulo');
    
    //Pega os valores do formulario que serão inseridos no banco
    $idPorta = $_GET['porta'];
    $matricula = $_POST["nMatricula"];
    $nome = $_POST["nNome"];
    //Atribui a data e hora atual do sistema no formato "Ano-Mês-Dia Hora-Minutos-Segundos"  
    $dataMov = date("Y-m-d H:i:s");
    $ativo = $_POST["nAtivo"];
    //Busca o próximo ID na tabela
    $idMov = proximoID("tb_movimentacao","id_movimentacao");

    //Variavel passada pela URL que defina a função a ser excutada
    //Podem do ser I = inserir, A = alterar, D = deletar
    $funcao      = $_GET["funcao"];

    //Abre conexão com o banco
    include("conexao.php");

    //Validar se é Entrada ou Saida de movimentação ou Ativação/Desativação de porta
    if($funcao == "Entrada"){
        //Busca o id do usuario da tabela usuarios pela matricula
        $sql = "SELECT id_usuario FROM tb_usuario WHERE matricula = $matricula";
        $result = mysqli_query($conn,$sql);
        //Atribui o valor retornado do banco para a variavel
        foreach ($result as $coluna){
            $idUsuario = $coluna["id_usuario"];
        }
        //Grava o registro da reserva no banco
        if($idUsuario == null){
            header("location: ../reservas.php");
        }
        $sql = "INSERT INTO tb_movimentacao VALUES($idMov,'$dataMov','$funcao',$idUsuario,$idPorta)";
        $result = mysqli_query($conn,$sql);
        
        //Atualiza o status da porta para ocupada
        $sql = "UPDATE tb_porta SET status = 'O' WHERE id_porta = $idPorta;";
        $result = mysqli_query($conn,$sql);
        
    }elseif($funcao == "Saída"){
        
        //Busca o id do usuario do ultimo registro pelo id da porta
        $sql = "SELECT id_usuario FROM tb_movimentacao WHERE id_porta = ".$idPorta." ORDER BY id_movimentacao DESC LIMIT 1;";
        $result = mysqli_query($conn,$sql);
        //Atribui o valor retornado do banco para a variavel
        foreach ($result as $coluna){
            $idUsuario = $coluna["id_usuario"];
        }
        if($idUsuario){
            //Grava o registro da reserva no banco
            $sql = "INSERT INTO tb_movimentacao VALUES($idMov,'$dataMov','$funcao',$idUsuario,$idPorta)";
            $result = mysqli_query($conn,$sql);
        }
        //Atualiza o status da porta para disponivel
        $sql = "UPDATE tb_porta SET status = 'D' WHERE id_porta = $idPorta;";
        $result = mysqli_query($conn,$sql);

    } else if($funcao == "Ativo"){
        //Inverte os valores da variavel ativo
        $ativo = ($ativo == "N") ? "S" : "N";
        //Busca o status do ultimo registro pelo id da porta
        $sql = "SELECT status FROM tb_movimentacao WHERE id_porta = ".$idPorta." ORDER BY id_movimentacao DESC LIMIT 1;";
        $result = mysqli_query($conn,$sql);

        foreach ($result as $coluna){
            $status = $coluna["status"];
        }
        //Valida se o status é de saída
        if($status == "Saída" || $status == null) {
            //Muda o valor da flag ativo no banco 
            $sql = "UPDATE tb_porta SET flg_ativo = '$ativo' WHERE id_porta = $idPorta AND status <> 'O';";
            $result = mysqli_query($conn,$sql);
        } else {
            //Atribui TRUE para a variavel de sessao
            $_SESSION["portaOcupada"] = TRUE;
        }
        
    }

    //Fecha conexão com banco
    mysqli_close($conn);

    
    //Volta para a tela de usuarios
    header("location: ../reservas.php");
?>