<?php
    session_start();
    $host = "localhost/site/";
    $user = "root";
    $pass = "";
    $dbname = "login";
    $port = 3306;

    try{
        //conexao com a porta
    $conn=  new PDO("mysql: host=$host;port=$port;dbname=".$dbname, $user,$pass);
    //echo " conexão com banco de dados realizados com sucesso";
    //conexao sem a porta
   // $conn=  new PDO("mysql: host=$host;dbname=".$dbname, $user,$pass);
    //echo " conexão com banco de dados realizados com sucesso";
    }catch(PDOException $err){
       // echo "Erro: conexão com banco de dados não realizados com sucesso. Erro gerado". $err->getMessage();
    }

?>