<?php
session_start();
ob_start();
include_once 'conexao.php';
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome'])) ){
    $_SESSION['msg']="<p style='color:#fa8cd9' name=ErrAcesso>Erro: necessario realizar Login</p>";
                        
    header("Location: index.php");

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pagina de Entrada</title>
</head>
<body>
    <div class="box">
        <div class="forme">
            <h2 style='color:#fa8cd9'>Seja Bem Vindo(a), <?php echo $_SESSION['nome'];?>!</h2>
            <a href="Sair.php" style='color:#fa8cd9'>Sair</a>
            <a href="Sair.php" style='color:#fa8cd9'>Sair</a>
            
        </div>
    </div>      
</body>
</html>