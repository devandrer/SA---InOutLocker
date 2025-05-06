<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Tela de Login</title>
		<meta http-equiv="x-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style> 
			body{
				font-family: Arial, Helvetica, sans-serif; 
				background-image: url('dist/img/armario.jpg'); 
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				margin: 0;
				height: 100vh;
			}
			div{
				background-color: rgba(0, 0, 0, 0.8); 
				position: absolute; 
				top: 50%;
				left: 50%; 
				transform: translate(-50%, -50%); 
				padding: 80px;
				border-radius: 80px;
				color: #fff;
			}
			input{
				padding: 10px;
				border: none;
				outline: none;
				font-size: 15px; 
				width: 93%;
			}		
			button{ 
				background-color: dodgerblue; 
				border: none; 
				padding: 15px; 
				width: 100%; 
				border-radius: 10px; 
				color: white; 
				font-size: 15px; 
			}				
			button:hover{
				background-color: deepskyblue; 
				cursor: pointer;
			}
			img{
				width: 80%;
				display: block; 
				margin: 0 auto;
			}
		</style> 
	</head> 
	<body> 
		<div> 
			<img id="logo" src="dist/img/Logosemfundo.png" alt="Logoazul"> 
			<input type="text" placeholder="Nome">
			<br><br>
			<input type="password" placeholder="senha">
			<br><br>
            <button>ACESSO</button> 
		</div>
	</body>
</html>