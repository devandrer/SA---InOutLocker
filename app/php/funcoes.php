<?PHP

include("funcaoMenu.php");


function proximoID($tabela,$campo){
    $id = 0;
    

    include("conexao.php");
    
    $sql = "SELECT MAX($campo) AS ID FROM $tabela";

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if(mysqli_num_rows($result) >0){
        foreach($result as $campo){
            $id = $campo['ID'];
        }
    }
    return $id +1;

}
?>