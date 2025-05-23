<?php
    //Caso não haja uma sessão ativa inicia ela
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    //Importa as funções
    include("funcoes.php");

    //Variavel de controle
    $_SESSION['logado'] = 0;

    //Pega o email e senha do form do login
    $email = stripslashes($_POST["nNome"]);
    $senha = stripslashes($_POST["nSenha"]);

    //Abre conexão com o banco
    include("conexao.php");
    //SELECT
    $sql = "SELECT * FROM tb_usuario "
            ." WHERE login = '$email' "
            ." AND senha = md5('$senha') "
            ." AND id_tipo_usuario <> 3";
    //Executa o comando SQL e armazena o resultado
    $resultLogin = mysqli_query($conn,$sql);
    //Fecha conexão com banco
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($resultLogin) > 0) {         

        foreach ($resultLogin as $coluna) {
                        
            //Passa os dados do usuario do banco para a sessão
            $_SESSION['idTipoUsuario'] = $coluna['id_tipo_usuario'];
            $_SESSION['logado']        = 1;
            $_SESSION['idLogin']       = $coluna['id_usuario'];
            $_SESSION['NomeLogin']     = $coluna['nome'];
            $_SESSION['FotoLogin']     = $coluna['foto'];
            $_SESSION['AtivoLogin']    = $coluna['flg_ativo'];
            $_SESSION['EmailLogin']    = $coluna['login'];
            $_SESSION['SenhaLogin']    = $coluna['senha'];
            $_SESSION['Matricula']    = $coluna['matricula'];
            $_SESSION['idEmpresa']    = $coluna['id_empresa'];
            $_SESSION["erroPerfil"] = ""; 
            $_SESSION["erroLogin"] = False; 
            $_SESSION["carregaArmarios"] = 1; 
            //Acessar a tela inicial
            header('location: ../dashboard.php');
            
        }        
    }else{
        //Volta para tela de login e exibe um erro
        $_SESSION["erroLogin"] = True; 
        header('location: ../');
    } 

    

?>