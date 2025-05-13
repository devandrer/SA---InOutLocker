<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include('conexao.php');
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
    } else {
    
    }
} else {

}
header('location: ../perfil.php');
