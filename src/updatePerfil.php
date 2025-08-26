<?php

include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUserUpdate = filter_input(INPUT_POST, "txtIdUser", FILTER_SANITIZE_SPECIAL_CHARS);
    $nomeUpdate = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
    $emailUpdate = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);

    try {
        $sql = "UPDATE usuarios SET nome=:nomeUpdate, email=:emailUpdate WHERE usuario_id = :idUserUpdate";
        $updatePerfil = $conexao->prepare($sql);
        $updatePerfil->bindParam(":idUserUpdate", $idUserUpdate);
        $updatePerfil->bindParam(":nomeUpdate", $nomeUpdate);
        $updatePerfil->bindParam(":emailUpdate", $emailUpdate);

        if ($updatePerfil->execute()) {
            $_SESSION['mensagem'] = "Atualizado com sucesso!";
            $_SESSION['cor'] = 'alert-success';
            header("Location: " . ROOT_PATH . "screens/perfil.php");
            exit;
        } else {
            throw new Exception("Ocorreu um erro ao atualizar");
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao atualizar!";
        $_SESSION['cor'] = 'alert-warning';
        header("Location: " . ROOT_PATH . "screens/perfil.php");
        exit;
    } finally {
        unset($conexao);
    }
}
