<?php
    //Importa as funções
    include('funcoes.php');
    
    //Pega os valores do formulario que serão inseridos no banco
    $idUsuario   = $_GET["codigo"];
    $matricula   = $_POST["nMatricula"];
    $nome        = $_POST["nNome"];
    $cpf         = $_POST["nCpf"];
    $cidade      = $_POST["Cidade"];
    $endereco    = $_POST["Endereco"];
    $numero      = $_POST["Numero"];
    $bairro      = $_POST["Bairro"];
    $cep         = $_POST["CEP"];
    $uf          = $_POST["UF"];
    $login       = $_POST["nLogin"];
    $senha       = $_POST["nSenha"];
    $empresa     = $_POST["nEmpresa"];
    $tipoUsuario = $_POST["nTipoUsuario"];

    //Variavel passada pela URL que defina a função a ser excutada
    //Podem do ser I = inserir, A = alterar, D = deletar
    $funcao      = $_GET["funcao"];

    //Transforma o retorno da check-box do form em S ou N para ativo e desativo
    if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";
    
    //Abre conexão com o banco
    include("conexao.php");

    //Validar se é Inclusão ou Alteração ou Exclusão
    if($funcao == "I"){

        //Busca o próximo ID e matricula na tabela usuario 
        $idUsuario = proximoID("tb_usuario","id_usuario");
        $matricula   = proximoID("tb_usuario","matricula");
        
        //INSERT
        $sql = "INSERT INTO tb_usuario(
                id_usuario,matricula,nome,cpf,cidade,endereco,numero,
                bairro,cep,uf,login,senha,flg_ativo,id_empresa,id_tipo_usuario)
                VALUES($idUsuario,$matricula,'$nome','$cpf','$cidade','$endereco',$numero,
                '$bairro','$cep','$uf','$login',md5('$senha'),'$ativo','$empresa',$tipoUsuario);";
        
    }elseif($funcao == "A"){
        //Verifica se a valor na variavel senha
        //Caso haja, faz um SET na senha
        //Caso esteja vazio não faz o SET 
        if($senha == ''){ 
            $setSenha = ''; 
        }else{ 
            $setSenha = " senha = md5('$senha'), ";
        }
        
        //UPDATE
        $sql = "UPDATE tb_usuario
                SET matricula = $matricula,
                    nome = '$nome',
                    cpf = '$cpf',
                    cidade = '$cidade',
                    endereco = '$endereco',
                    numero = '$numero',
                    bairro = '$bairro',
                    cep = '$cep',
                    uf = '$uf',
                    login = '$login',
                    $setSenha
                    flg_ativo = '$ativo',
                    id_empresa = '$empresa',
                    id_tipo_usuario = $tipoUsuario
                WHERE id_usuario = $idUsuario";
        
    }elseif($funcao == "D"){
        //DELETE
        $sql = "DELETE FROM tb_usuario 
                WHERE id_usuario = $idUsuario;";
    }

    //Executa o comando SQL e armazena o resultado
    $result = mysqli_query($conn,$sql);
    //Fecha conexão com banco
    mysqli_close($conn);

    //VERIFICA SE TEM IMAGEM NO INPUT
    if($_FILES['Foto']['tmp_name'] != ""){

        //Pega a extensão do arquivo e cria um novo nome pra ele (MD5 do nome original)
        $extensao = pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
        $novoNome = md5($_FILES['Foto']['name']).'.'.$extensao;        
        
        //Verificar se o diretório existe, ou criar a pasta
        if(is_dir('../dist/img/usuarios/')){
            //Existe
            $diretorio = '../dist/img/usuarios/';
        }else{
            //Criar pq não existe
            $diretorio = mkdir('../dist/img/usuarios/');
        }

        //Cria uma cópia do arquivo local na pasta do projeto
        move_uploaded_file($_FILES['Foto']['tmp_name'], $diretorio.$novoNome);

        //Caminho que será salvo no banco de dados
        $dirImagem = 'dist/img/usuarios/'.$novoNome;

        //Abre conexão com o banco
        include("conexao.php");
        //UPDATE
        $sql = "UPDATE tb_usuario "
                ." SET foto = '".$dirImagem."' "
                ." WHERE id_usuario = ".$idUsuario.";";

        //Executa o comando SQL e armazena o resultado
        $result = mysqli_query($conn,$sql);
        //Fecha conexão com banco
        mysqli_close($conn);
        
        //Atualiza a variavel de sessão caso o usuario logado altere a propria imagem de perfil
        if($_SESSION['idLogin'] ==  $_GET["codigo"]) {
            $_SESSION['FotoLogin'] = $dirImagem;
        }
    }
    //Volta para a tela de usuarios
    header("location: ../usuarios.php");
?>