<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//Ação que seleciona o submit entre Salvar e Fechar a Modal na tela Perfil.php
$acao = $_POST['btModal'];

    switch($acao){
        //Salva todos os dados escritos ao clicar no botão Salvar
        case "modal_salvar":
            include('conexao.php');
            if($_POST["nSenha"] == "" || $_POST["nSenhaN"] == "" || $_POST["nSenhaR"] == ""){
                $_SESSION["erroPerfil"] = "erroNone";
                header('location: ../perfil.php');
            }
            $senhaA = stripslashes($_POST["nSenha"]);
            $senhaN = stripslashes($_POST["nSenhaN"]);
            $senhaR = stripslashes($_POST["nSenhaR"]);
            if (md5($senhaA) == $_SESSION['SenhaLogin']) {
                if ($senhaN == $senhaR) {
                    //Atualiza os dados no banco
                    $sql = "UPDATE tb_usuario "
                        . " SET senha = md5(" . $senhaN . ") "
                        . " WHERE id_usuario = " . $_SESSION['idLogin'] . ";";

                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    $_SESSION['SenhaLogin'] = md5($senhaN);
                    $_SESSION["erroPerfil"] = "";
                    $_SESSION['msgSucesso'] = true;
                } else {
                    //colocar uma label de erro acima do campo "Repetir Senha"
                    $_SESSION["erroPerfil"] = "erroSenhaR";
                }
            } else {
                //colocar uma label de erro acima do campo "Senha Atual"
                $_SESSION["erroPerfil"] = "erroSenhaA"; 
            }
            header('location: ../perfil.php');
            break;
        //limpa todos os dados e modificações ao clicar no botão Fechar
        case "modal_limpar":
            $_SESSION["erroPerfil"] = "";
            header('location: ../perfil.php');
            break;
        default:

    }
    
