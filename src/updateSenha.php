<?php

include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = filter_input(INPUT_POST, "txtIdUser", FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, "txtNovaSenha", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmaSenha = filter_input(INPUT_POST, "txtConfirmarSenha", FILTER_SANITIZE_SPECIAL_CHARS);


    if ($senha !== $confirmaSenha) {
        $_SESSION['mensagem'] = "Senhas devem ser iguais!";
        $_SESSION['cor'] = 'alert-warning';
        header("Location: " . ROOT_PATH . "screens/perfil.php");
        exit;
    }

    // Criptografar a senha antes de inseri-la no banco de dados
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


    #Codigo para realizar realizar o UPDATE na tabela usuarios

    try {
        $sql = "UPDATE usuarios SET senha=:senha WHERE usuario_id = :userId";
        $update = $conexao->prepare($sql);
        $update->bindParam(':userId', $userId);
        $update->bindParam(':senha', $senhaCriptografada);


        if ($update->execute()) {
            $_SESSION['mensagem'] = "Atualizado com sucesso!";
            $_SESSION['cor'] = 'alert-success';
            header("Location: " . ROOT_PATH . "screens/perfil.php");
            exit;
        } else {
            throw new Exception("Ocorreu um erro ao cadastrar!");
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao Atualizar!";
        $_SESSION['cor'] = 'alert-warning';
        header("Location: " . ROOT_PATH . "screens/perfil.php");
        exit;
    } finally {
        //Fecha a conexao com o BD
        unset($conexao);
    }
}
