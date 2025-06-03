<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

$erro = $_SESSION["erroLogin"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Tela de Login</title>
	<meta http-equiv="x-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Ícone da aba do navegador -->
	<link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

	<!-- Estilos CSS embutidos -->
	<style>
		/* Estilização do corpo da página */
		.containerLogin {
			font-family: Arial, Helvetica, sans-serif;
			background-image: url('dist/img/armario.jpg');
			/* Imagem de fundo */
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			margin: 0;
			height: 100vh;
		}

		/* Estilo da caixa de login */
		.boxLogin {
			background-color: rgba(0, 0, 0, 0.8);
			/* Fundo preto translúcido */
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 80px;
			border-radius: 80px;
			color: #fff;
			width: 400px;
			height: 400px;
		}

		/* Estilo dos inputs (email e senha) */
		.inputLogin {
			padding: 10px;
			border: none;
			outline: none;
			font-size: 15px;
			width: 93%;
		}

		/* Estilo da mensagem de erro */
		.msgErro {
			color: red;
			font-size: 12px;
			line-height: 32px;
			padding: 2px 0;
			margin: 0;
		}

		/* Estilo do botão */
		.btnSubmit {
			background-color: dodgerblue;
			border: none;
			padding: 15px;
			width: 100%;
			border-radius: 10px;
			color: white;
			font-size: 15px;
		}

		/* Efeito ao passar o mouse no botão */
		.btnSubmit:hover {
			background-color: deepskyblue;
			cursor: pointer;
		}
	</style>

	<!-- CSS -->
	<?php //include('partes/css.php'); 
	?>
	<!-- Fim CSS -->
</head>

<body class="containerLogin">
	<!-- Caixa central de login -->
	<div class="boxLogin">
		<!-- Formulário que envia os dados para validação -->
		<form action="php/validaLogin.php" method="POST">
			<!-- Logotipo do sistema -->
			<img src="dist/img/door-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 30%; padding:8px">
			<img src="dist/img/nick-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 60%;">

			<!-- Campo de email -->
			<input class="inputLogin" type="email" id="iEmailInput" placeholder="E-mail" name="nNome">
			<br><br>
			<!-- Campo de senha -->
			<input class="inputLogin" type="password" id="iSenhaInput" placeholder="Senha" name="nSenha">
			<i class="fas fa-eye-slash" id="iSenhaIcon" style="position: absolute; right: 95px; top: 375px;cursor: pointer; color:black;"></i>
			<p class="msgErro" id="iMsgErro">
				&nbsp;
				<!-- Mensagem de erro, se o login falhar -->
				<?php 
				if ($erro) {
					echo 'E-mail ou senha estão incorretos, tente novamente!!!';
				} else {
					echo '&nbsp;';
				}
				?>
			</p>
			<button class="btnSubmit" id="iBtnSubmit" type="submit">ACESSO</button>
		</form>
	</div>
</body>

<script>
	let senhaIcon = document.getElementById("iSenhaIcon");
	let senhaInput = document.getElementById("iSenhaInput");
	senhaIcon.onclick = () => {
		if (senhaInput.type == "password") {
			senhaIcon.className = "fas fa-eye";
			senhaInput.type = "text"
		} else {
			senhaIcon.className = "fas fa-eye-slash";
			senhaInput.type = "password"
		}

	}

</script>

</html>