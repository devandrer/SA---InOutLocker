<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }   
    
    //Funções e conexão por PDO
    include('funcoes.php');
    require_once('canexaoPDO.php');
    
    //Pega o id enviado por GET na URL
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $senha = isset($_GET['senha']) ? $_GET['senha'] : '';
    
    if (! empty($senha)){
        //Monta a lista no banco
        echo checkEmaiLSenha($email,$senha);
    }

    //Função para montar a lista filtrada
    function checkEmaiLSenha($emailV,$senhaV){
        //Conexão PDO
        $pdo = Conectar();

        //Consulta SQL
        $sql = 'SELECT * FROM tb_usuario
                WHERE login = "'.$emailV.'"
                AND senha = md5("'.$senhaV.'")
                AND id_tipo_usuario <> 3;
        ';
       
        //Executar por PDO
        $stm = $pdo->prepare($sql);
        $stm->execute();

        //sleep(1);
        //Converte o resultado em JSON antes de retornar para a página
        
        echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));        
        
        //Encerra a conexão PDO
        $pdo = null;
    }

?>