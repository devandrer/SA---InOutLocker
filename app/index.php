<?php
	if(session_status() !== PHP_SESSION_ACTIVE){
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

	<!-- Estilos CSS embutidos -->
	<style>
		/* Estilização do corpo da página */
		body {
			font-family: Arial, Helvetica, sans-serif;
			background-image: url('dist/img/armario.jpg');/* Imagem de fundo */
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			margin: 0;
			height: 100vh;
		}

		/* Estilo da caixa de login */
		div {
			background-color: rgba(0, 0, 0, 0.8);/* Fundo preto translúcido */
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
		input {
			padding: 10px;
			border: none;
			outline: none;
			font-size: 15px;
			width: 93%;
		}

	/* Estilo da mensagem de erro */
		p {
			color:red; 
			font-size: 12px;
			line-height: 32px;
			padding: 2px 0;
			margin: 0;
		}

	/* Estilo do botão */
		button {
			background-color: dodgerblue;
			border: none;
			padding: 15px;
			width: 100%;
			border-radius: 10px;
			color: white;
			font-size: 15px;
		}

	/* Efeito ao passar o mouse no botão */
		button:hover {
			background-color: deepskyblue;
			cursor: pointer;
		}

	</style>
</head>

<body>
	<!-- Caixa central de login -->
	<div>
		<!-- Formulário que envia os dados para validação -->
		<form action="php/validaLogin.php" method="POST">
			<!-- Logotipo do sistema -->
			<img src="dist/img/door-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 30%; padding:8px">
			<img src="dist/img/nick-blue.png" alt="AdminLTE Logo" class=" " style="opacity: .8; width: 60%;">

			<!-- Campo de email -->
			<input type="email" placeholder="E-mail" name="nNome">
			<br><br>
			<!-- Campo de senha -->
			<input type="password" placeholder="Senha" name="nSenha">
			<p>
				
				<!-- Mensagem de erro, se o login falhar -->
				<?php if($erro) {
					echo 'E-mail ou senha estão incorretos, tente novamente!!!';
				} else {
					echo '&nbsp;';
				}
				?>
			</p>
			<button type="submit">ACESSO</button>
		</form>
	</div>
</body>

</html>