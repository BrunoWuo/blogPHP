<?php 
//conexao com o banco de dados

$dbHost = "localhost";
$dbNomeBanco="blog_bruno";
$dbUser="root";
$dbPassword="";
$dbPort="3306";


try {
    $conexao = new PDO("mysql:host=$dbHost; dbname=$dbNomeBanco; charset=utf8", $dbUser, $dbPassword);
} catch (PDOException $erro) {
    echo "Erro ao conectar ao banco de dados " . $erro->getMessage() ;  // lembrar de apagar o getMessage em PROD.
}

?>