<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtComentario'])) {

        $usuarioId = filter_input(INPUT_POST, "txtUsuarioId", FILTER_SANITIZE_SPECIAL_CHARS);
        $postagemId = filter_input(INPUT_POST, "txtPostagemId", FILTER_SANITIZE_SPECIAL_CHARS);
        $comentario = filter_input(INPUT_POST, "txtComentario", FILTER_SANITIZE_SPECIAL_CHARS);


        // CODIGO PARA INSERT
        try {
            $sql = "INSERT INTO comentarios (postagem_id, usuario_id, conteudo) VALUES (:postagem_id, :usuario_id, :conteudo)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":postagem_id", $postagemId);
            $insert->bindParam(":usuario_id", $usuarioId);            
            $insert->bindParam(":conteudo", $comentario);
         

            if ($insert->execute() && $insert->rowCount() > 0) {
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "screens/detalhesPost.php?id=" . $postagemId);
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro" . $e;
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/detalhesPost.php");
            exit;
        } finally {
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "screens/detalhesPost.php");
        exit;
    }
}