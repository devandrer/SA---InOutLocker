<?php
session_start();
$acao = $_POST['nArmario'];
$_SESSION["carregaArmarios"] = intval($acao,10);


header('location: ../reservas.php');
?>