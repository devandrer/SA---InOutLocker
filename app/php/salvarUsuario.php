<?php
    
    include('funcoes.php');

    $idUsuario   = $_GET["codigo"];
    $matricula   = $_POST["nMatricula"];
    $nome        = $_POST["nNome"];
    $cpf         = $_POST["nCpf"];
    $cidade      = $_POST["nCidade"];
    $endereco    = $_POST["nEndereco"];
    $numero      = $_POST["nNumero"];
    $bairro      = $_POST["nBairro"];
    $cep         = $_POST["nCep"];
    $uf          = $_POST["nUf"];
    $login       = $_POST["nLogin"];
    $senha       = $_POST["nSenha"];
    $empresa     = $_POST["nEmpresa"];
    $tipoUsuario = $_POST["nTipoUsuario"];
    $funcao      = $_GET["funcao"];

    if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";

    include("conexao.php");

    //Validar se é Inclusão ou Alteração
    if($funcao == "I"){

        //Busca o próximo ID na tabela
        $idUsuario = proximoID("tb_usuario","id_usuario");

        //INSERT
        $sql = "INSERT INTO tb_usuario(
                id_usuario,matricula,nome,cpf,cidade,endereco,numero,
                bairro,cep,uf,login,senha,flg_ativo,id_empresa,id_tipo_usuario)
                VALUES($idUsuario,'$matricula','$nome','$cpf','$cidade','$endereco',$numero,
                '$bairro','$cep','$uf',$'login',md5('$senha'),'$ativo',$empresa,$tipoUsuario);";
        var_dump($sql);
        die();

    }elseif($funcao == "A"){
        //UPDATE
        if($senha == ''){ 
            $setSenha = ''; 
        }else{ 
            $setSenha = " senha = md5('$senha'), ";
        }

        $sql = "UPDATE tb_usuario
                SET matricula = '$matricula',
                    nome = '$nome',
                    cpf = '$cpf',
                    cidade = '$cidade',
                    endereco = '$endereco',
                    numero = $numero,
                    bairro = '$bairro',
                    cep = '$cep',
                    uf = '$uf',
                    login = '$login',
                    $setSenha,
                    flg_ativo = '$ativo',
                    id_empresa = $empresa,
                    id_tipo_usuario = $tipoUsuario
                WHERE id_usuario = $idUsuario";
        var_dump($sql);
        die();

    }elseif($funcao == "D"){
        //DELETE
        $sql = "DELETE FROM tb_usuario 
                WHERE id_usuario = $idUsuario;";
    }

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    //VERIFICA SE TEM IMAGEM NO INPUT
    if($_FILES['Foto']['tmp_name'] != ""){

        //Usar o mesmo nome do arquivo original
        //$nomeArq = $_FILES['Foto']['name'];
        //...
        //OU
        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['Foto']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../dist/img/')){
            //Existe
            $diretorio = '../dist/img/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../dist/img/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['Foto']['tmp_name'], $diretorio.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'dist/img/'.$novoNome;

        include("conexao.php");
        //UPDATE
        $sql = "UPDATE tb_usuario "
                ." SET foto = '$dirImagem' "
                ." WHERE id_usuario = $idUsuario;";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
    }

    header("location: ../usuarios.php");
?>