<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../service/conexao.php");



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtEmail']) && !empty($_POST['txtSenha'])) {
        try {
            $email = filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_SPECIAL_CHARS);

            // CONSULTA AO BANCO DE DADOS VERIFICAR EMAIL
            $sql = "SELECT email, senha, nome, usuario_id, is_admin FROM usuarios WHERE email = :email";
            $select = $conexao->prepare($sql);
            $select->bindParam(':email', $email);
            if ($select->execute() && $select->rowCount() > 0) {
                $login = $select->fetch(PDO::FETCH_ASSOC);

                //verifica se a senha está correta
                if ($login['email'] && password_verify($senha, $login['senha'])) {
                    $_SESSION['logado'] = TRUE;
                    $_SESSION['idUser'] = $login['usuario_id'];
                    $_SESSION['nomeUser'] = $login['nome'];

                    if ($login['is_admin'] === "admin") {
                        header("Location: " . ROOT_PATH . "admin/index.php");
                        exit;
                    } else {
                        header("Location: " . ROOT_PATH . "index.php");
                        exit;
                    }
                }
            }
            $_SESSION['mensagem'] = "Usuário/Senha Inválidos!";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/login.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro no Banco de Dados";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "screens/login.php");
            exit;
        } finally {
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "screens/login.php");
        exit;
    }
}
