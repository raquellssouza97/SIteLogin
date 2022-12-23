<?php
session_start();
include_once("conexao.php");
$SendLogin = filter_input(INPUT_POST, 'SendLogin', FILTER_SANITIZE_STRING);
if($SendLogin){
	$usuario = filter_input(INPUT_POST, 'Usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'Senha', FILTER_SANITIZE_STRING);
	//echo "$usuario - $senha";
	if((!empty($Usuario)) AND (!empty($Senha))){
		//Gerar a senha criptografa
		//echo password_hash($senha, PASSWORD_DEFAULT);
		//Pesquisar o usuário no BD
		$result_Usuario = "SELECT id, nome, Email, Senha FROM usuario WHERE Usuario='$Usuario' LIMIT 1";
		$resultado_Usuario = mysqli_query($conn, $result_Usuario);
		if($resultado_Usuario){
			$row_Usuario = mysqli_fetch_assoc($resultado_Usuario);
			if(password_verify($Senha, $row_Usuario['Senha'])){
				$_SESSION['id'] = $row_Usuario['id'];
				$_SESSION['nome'] = $row_Usuario['nome'];
				$_SESSION['Email'] = $row_Usuario['Email'];
				header("Location: administrativo.php");
			}else{
				$_SESSION['msg'] = "Login e senha incorreto!";
				header("Location: index.php");
			}
		}
	}else{
		$_SESSION['msg'] = "Login e senha incorreto!";
		header("Location: index.php");
	}
}else{
	$_SESSION['msg'] = "Página não encontrada";
	header("Location: index.php");
}
