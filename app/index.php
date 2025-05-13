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
	<link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			background-image: url('dist/img/armario.jpg');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			margin: 0;
			height: 100vh;
		}

		div {
			background-color: rgba(0, 0, 0, 0.8);
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 80px;
			border-radius: 80px;
			color: #fff;
		}

		input {
			padding: 10px;
			border: none;
			outline: none;
			font-size: 15px;
			width: 93%;
		}

		p {
			color:red; 
			font-size: 12px;
			line-height: 32px;
			padding: 2px 0;
			margin: 0;
		}

		button {
			background-color: dodgerblue;
			border: none;
			padding: 15px;
			width: 100%;
			border-radius: 10px;
			color: white;
			font-size: 15px;
		}

		button:hover {
			background-color: deepskyblue;
			cursor: pointer;
		}

		img {
			width: 80%;
			display: block;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<div>
		<form action="php/validaLogin.php" method="POST">
			<img id="logo" src="dist/img/Logosemfundo.png" alt="Logoazul">
			<input type="email" placeholder="E-mail" name="nNome">
			<br><br>
			<input type="password" placeholder="Senha" name="nSenha">
			<p>
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