<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../service/conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtNome']) && !empty($_POST['txtEmail']) && !empty($_POST['txtSenha'])) {

        $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);

        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // CODIGO PARA INSERT

        try {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":nome", $nome);
            $insert->bindParam(":email", $email);
            $insert->bindParam(":senha", $senhaCriptografada);

            if ($insert->execute() && $insert->rowCount() > 0){
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "screens/login.php");
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }
            
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao cadastrar / Usuário já cadastrado!";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/cadastrar.php");
            exit;
           
        } finally {
            unset($conexao);
        }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "screens/cadastrar.php");
        exit;
    }
}
