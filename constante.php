<?php
define('DIR_PATH', realpath(dirname(__FILE__)));
define('ROOT_PATH', 'http://172.17.34.253:1200/projetos/202400005/instrutores/Bruno-202400005/PHP/11aula-Blog/');

// garante que o a sessao esteja iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// inicializar as variaveis de sessao
$mensagem = $_SESSION['mensagem'] ?? null;
$cor = $_SESSION['cor'] ?? null;
unset($_SESSION['mensagem']);
unset($_SESSION['cor']);

// variaveis logado
$logado = $_SESSION['logado'] ?? FALSE;
$idUser = $_SESSION['idUser'] ?? "";
$nomeUser = $_SESSION['nomeUser'] ?? "";
