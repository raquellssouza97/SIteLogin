<?php 
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);
$_SESSION['msg']="<p style='color:#fa8cd9' name=SInvalida>Deslogado com Sucesso!</p>";
                            
header("Location: index.php");