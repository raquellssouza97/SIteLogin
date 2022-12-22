<?php
session_start();
ob_start();
include_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pagina de Login</title>
</head>
<body>
    <div class="box">
        <div class="forme">
            <?php
            //exemplo criptografar senha
           // echo password_hash(123456, PASSWORD_DEFAULT);
            ?>
            <h2>Entrar</h2>

                    <?php
                        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        
                            if(!empty($dados['SendLogin'])){
                        //var_dump($dados);
                        $query_Usuario= "SELECT id, nome, Usuario, Senha 
                            FROM usuario 
                            WHERE Usuario= :Usuario
                            LIMIT 1 ";
                           $result_Usuario= $conn->prepare($query_Usuario);
                           $result_Usuario->bindParam(':Usuario', $dados['Usuario'], PDO::PARAM_STR);
                           $result_Usuario->execute();

                           if(($result_Usuario) AND ($result_Usuario->rowCount() !=0 )){
                            $row_Usuario=$result_Usuario->fetch(PDO::FETCH_ASSOC);
                            //var_dump($row_Usuario);
                            if(password_verify($dados['Senha'] , $row_Usuario['Senha'])){
                               // echo "<p style='color:#fa8cd9' name=Logado>Usuario Logado</p>";
                               $_SESSION['id']= $row_Usuario['id'];
                               $_SESSION['nome']= $row_Usuario['nome'];
                               header("Location: dashboard.php");
                            }else{
                                $_SESSION['msg']="<p style='color:#fa8cd9' name=SInvalida>Erro: Senha inválida!</p>";
                            }
                           }else{
                            $_SESSION['msg']="<p style='color:#fa8cd9' name=UInvalida>Erro: Usuário inválida!</p>";
                           }

                          
                           //'".$dados['Usuario']."'
                            }

                            if(isset( $_SESSION['msg'])){
                                echo  $_SESSION['msg'];
                                unset  ($_SESSION['msg']);
                            }
                    ?>

                <form method="POST" action="">
                    <div class="inputBox">  
                        <input type="text" name="Usuario"value="<?php if(isset($dados['Usuario'])){ echo $dados['Usuario']; }?>" required >
                        <span>Usuário</span> <i></i>
                    </div>

                    <div class="inputBox"><input type="Password" name="Senha" value="<?php if(isset($dados['Senha'])){ echo $dados['Senha']; }?>"required>
                        <span>Senha</span> <i></i>
                    </div>

                    <div class="links">
                        <br><br>  <a href="http://localhost/site/esqueceuSenha.php">Esqueceu a senha?</a>

                        <a href="http://localhost/site/cadastra.php">Inscreva-se</a>
                    </div>
                

                    <input type="submit" value="Acessar" name="SendLogin" class="c">
                </form>
        </div>
    </div>
</body>
</html>