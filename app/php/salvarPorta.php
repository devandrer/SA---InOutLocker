<?php
  //Ação que seleciona o submit entre Salvar e Fechar a Modal na tela Perfil.php
$acao = $_POST['btSalvaPorta'];  
    include('funcoes.php');

    // Declara  as variáveis de acordo com o "name"
    $idPorta    = $_GET["id"];
    $NrPorta    = $_POST["nNrPorta"];
    $armario    = $_POST["nArmario"];
    $status     = $_POST["nStatus"];
    $funcao     = $_GET["funcao"];

    //Verifica se está ativo
    if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";

    include("conexao.php"); //Arquivo de conexão com o banco

    //Validar se é Inclusão ou Alteração
    if($funcao == "I"){
        //INSERIR
        
        switch($acao){
            //Salva todos os dados escritos ao clicar no botão Salvar
            case "modal_salvar":
                    //Busca o próximo ID na tabela
                $idPorta = proximoID("tb_porta","id_porta");
                //INSERT
                //Insere as informações
                $sql = "INSERT INTO tb_porta(id_porta, referencia, status, flg_ativo, id_armario)
                    VALUES ($idPorta, '$NrPorta','$status', '$ativo', '$armario');";

            case "modal_limpar":
                header('location: ../porta.php');
                break;

            default:
        }     

    }elseif($funcao == "A"){
        //UPDATE 

        switch($acao){
            //Salva todos os dados escritos ao clicar no botão Salvar
            case "modal_salvar":
                // Atualiza no banco
                $sql = "UPDATE tb_porta
                SET referencia = '$NrPorta',
                    -- status    = '$status',
                    flg_ativo = '$ativo',
                    id_armario = '$armario'
                WHERE id_porta = $idPorta;";
                break;

            case "modal_limpar":
                header('location: ../porta.php');
                break;

            default:
        }     
        

      
    }elseif($funcao == "D"){
        //DELETE 
        // Deleta o Porta
        $sql = "DELETE FROM tb_porta
                WHERE id_porta = $idPorta;";
    }
    
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    header("location: ../porta.php");
?>