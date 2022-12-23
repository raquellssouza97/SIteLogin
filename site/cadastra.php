<?php
session_start();
ob_start();
include_once 'conexao.php';

?>
<!DOCTYPE html>
<html>
    <header>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Cadastra</title>
    </header>
    <body>
        <div >
            <div >
                <h2 style='color:#fa8cd9'>Cadastrar</h2>

                <?php
        //Receber os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['Email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            if (!$empty_input) {
                $query_Usuario = "INSERT INTO Usuario (nome, Email) VALUES (:nome, :Email) ";
                $cad_Usuario = $conn->prepare($query_Usuario);
                $cad_Usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_Usuario->bindParam(':Email', $dados['Email'], PDO::PARAM_STR);
                $cad_Usuario->execute();
                if ($cad_Usuario->rowCount()) {
                    echo "<p style='color:#fa8cd9'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                } else {
                    echo "<p style='color:#fa8cd9'>Erro: Usuário não cadastrado com sucesso!</p>";
                }
            }
        }
        ?>

                <form class="cad-usuario" method="POST" action="" >
                    <div class="inputBox">
                       
                        <input type="text" name="nome" id="nome" placeholder=""  value="<?php
            if (isset($dados['nome'])) {
                echo $dados['nome'];
            }
            ?>" required> 
                        <span style='color:#fa8cd9'>Nome:</span><i></i>
                    </div>
                    <div class="inputBox">
                        
                        <input type="text" name="Usuario" id="Usuario" placeholder="" value="<?php
            if (isset($dados['Usuario'])) {
                echo $dados['Usuario'];
            }
            ?>" required>  

            
                        <span style='color:#fa8cd9'>Usuário:</span><i></i>
                    </div>
                    <div class="inputBox">
                        
                        <input type="text" name="Email" id="Email" placeholder="" value="<?php
            if (isset($dados['Email'])) {
                echo $dados['Email'];
            }
            ?>" required>  

            
                        <span style='color:#fa8cd9'>E-mail:</span><i></i>
                    </div>
                    <div class="inputBox">
                        
                        <input type="Password"  name="Senha" id="Senha" placeholder="" value="<?php
            if (isset($dados['Senha'])) {
                echo $dados['Senha'];
            }
            ?>" required> 
                        <span style='color:#fa8cd9'>Senha:</span><i></i>
                    </div>
                    <div class="inputBox">
                        
                        <input type="Password"  name="ConfirmaSenha" id="ConfirmaSenha" placeholder="" value="<?php
            if (isset($dados['Senha'])) {
                echo $dados['Senha'];
            }
            ?>" required> 
                        <span style='color:#fa8cd9'>Confirma Senha:</span><i></i>
                    </div>

                <input type="submit" value="Cadastrar" name="CadUsuario" class="c" href="http://localhost/site/index.php">
                </form>
                
            </div>
        </div>
    </body>
</html>