<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $idUsuario = $_GET['id'];
    $email      = $_POST['nEmail'];

    include('funcoes.php');

    //Foto do perfil
    $diretorioImg = '';
    
    if($_FILES['Foto']['tmp_name'] != ''){
        
        //Pega extensão e monta o novo nome do arquivo
        $ext       = pathinfo($_FILES['Foto']["name"], PATHINFO_EXTENSION);
        $novo_nome = md5($_FILES['Foto']['name']).'.'.$ext;
    
        //Verifica se existe o diretório (ou cria)
        if(is_dir('../dist/img/usuarios/')){ 
            $diretorio = '../dist/img/usuarios/';
        }else{
            $diretorio = mkdir('../dist/img/usuarios/');
        }
      
        //Grava o arquivo no diretório
        move_uploaded_file($_FILES['Foto']['tmp_name'], $diretorio.$novo_nome);
    
        //Salva o diretório para colocar na tabela do BD
        $diretorioImg = 'dist/img/usuarios/'.$novo_nome;

        //Gravação no BD
        include('conexao.php');
        $sql = "UPDATE tb_usuario "
                ." SET foto = '".$diretorioImg."' "
                ." WHERE id_usuario = ".$idUsuario.";";                                 
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
        $_SESSION['FotoLogin'] = $diretorioImg;
    }
    //Gravação no BD
    include('conexao.php');
    $sql = "UPDATE tb_usuario "
            ." SET login = '".$email."' "
            ." WHERE id_usuario = ".$idUsuario.";";                                 
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    $_SESSION['EmailLogin'] = $email;

    header('location: '.$_SERVER['HTTP_REFERER']);

?>