<?php
    
    include('funcoes.php');

    $idEmpresa   = $_GET["codigo"];
    $razao   = $_POST["nRazao"];
    $cnpj        = $_POST["nCnpj"];
    $endereco    = $_POST["nEndereco"];
    $cidade      = $_POST["nCidade"];
    $uf          = $_POST["nUF"];
    $cep         = $_POST["nCep"];
    $numero      = $_POST["nNumero"];
    $bairro      = $_POST["nBairro"];
    $funcao      = $_GET["funcao"];

    if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";

    include("conexao.php");

    //Validar se é Inclusão ou Alteração
    if($funcao == "I"){

        //Busca o próximo ID na tabela
        $idEmpresa = proximoID("tb_empresa","id_empresa");

        //INSERT
        $sql = "INSERT INTO tb_empresa(
                id_empresa,razao_social,cnpj,endereco,cidade,uf,cep,numero,
                bairro,flg_ativo)
                VALUES($idEmpresa,'$razao','$cnpj','$endereco','$cidade','$uf','$cep',
                $numero,'$bairro','$ativo');";

    }elseif($funcao == "A"){
        //UPDATE
    

        $sql = "UPDATE tb_empresa
                SET razao_social = '$razao',
                    cnpj = '$cnpj',
                    endereco = '$endereco',
                    cidade = '$cidade',
                    uf = '$uf',
                    cep = '$cep',
                    numero = $numero,
                    bairro = '$bairro',
                    flg_ativo = '$ativo'
                WHERE id_empresa = $idEmpresa";
       
    }elseif($funcao == "D"){
        //DELETE
        $sql = "DELETE FROM tb_empresa 
                WHERE id_empresa = $idEmpresa;";
    }

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    header("location: ../empresa.php");
?>