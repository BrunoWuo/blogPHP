<?php 
include_once("../constante.php");

session_start();
session_destroy();
unset($conexao);
header("Location:" . ROOT_PATH . "index.php");
exit;

?>