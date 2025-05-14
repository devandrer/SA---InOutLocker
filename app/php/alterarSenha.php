<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$acao = $_POST['btModal'];

    switch($acao){
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
                    
                    $sql = "UPDATE tb_usuario "
                        . " SET senha = md5(" . $senhaN . ") "
                        . " WHERE id_usuario = " . $_SESSION['idLogin'] . ";";

                    $result = mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    $_SESSION['SenhaLogin'] = md5($senhaN);
                    $_SESSION["erroPerfil"] = "";
                } else {
                    $_SESSION["erroPerfil"] = "erroSenhaR";
                }
            } else {
                $_SESSION["erroPerfil"] = "erroSenhaA"; 
            }
            header('location: ../perfil.php');
            break;
        
        case "modal_limpar":
            $_SESSION["erroPerfil"] = "";
            header('location: ../perfil.php');
            break;
        default:

    }
    
