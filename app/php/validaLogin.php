<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    include("funcoes.php");

    $_SESSION['logado'] = 0;

    $nome = stripslashes($_POST["nNome"]);
    $senha = stripslashes($_POST["nSenha"]);

    //$_POST - Valor enviado pelo FORM através da propriedade NAME do elemento HTML 
    //$_GET - Valor enviado pelo FORM através da URL
    //$_SESSION - Variável criada pelo usuário no PHP

    include("conexao.php");
    $sql = "SELECT * FROM tb_usuario "
            ." WHERE login = '$nome' "
            ." AND senha = md5('$senha');";
    $resultLogin = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //Validar se tem retorno do BD
    if (mysqli_num_rows($resultLogin) > 0) {  
        
        // enviarEmail('destino@email.com.br','Mensagem de e-mail para SA','Teste SA','Eu mesmo');

        foreach ($resultLogin as $coluna) {
                        
            //***Verificar os dados da consulta SQL
            $_SESSION['idTipoUsuario'] = $coluna['id_tipo_usuario'];
            $_SESSION['logado']        = 1;
            $_SESSION['idLogin']       = $coluna['id_usuario'];
            $_SESSION['NomeLogin']     = $coluna['nome'];
            $_SESSION['FotoLogin']     = $coluna['foto'];
            $_SESSION['AtivoLogin']    = $coluna['flg_ativo'];
            $_SESSION['EmailLogin']    = $coluna['login'];
            $_SESSION['SenhaLogin']    = $coluna['senha'];
            $_SESSION['Matricula']    = $coluna['matricula'];
            $_SESSION["erroPerfil"] = ""; 
            //Acessar a tela inicial
            header('location: ../dashboard.php');
            
        }        
    }else{
        //Acessar a tela inicial
        header('location: ../');
    } 

    

?>