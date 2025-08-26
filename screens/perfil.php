<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");

// consulta BD para verificar se o usuario existe
$sql = "SELECT usuario_id, nome, email FROM usuarios WHERE usuario_id = :idUser";
$select = $conexao->prepare($sql);
$select->bindParam(":idUser", $idUser);

if ($select->execute() && $select->rowCount() > 0) {
    $login = $select->fetch(PDO::FETCH_ASSOC);
}

unset($conexao);
?>

<main class="container mt-5">
    <form action="<?= ROOT_PATH ?>src/updatePerfil.php" method="post">
        <input type="text" id="idUser" name="txtIdUser" value="<?= $login['usuario_id'] ?>" class="form-control" hidden>

        <div class="mb-3">
            <label for="inputNome">Nome</label>
            <input type="text"
                class="form-control"
                name="txtNome"
                id="inputNome"
                value="<?= $login['nome'] ?>">
        </div>

        <div class="mb-3">
            <label for="inputEmail">Email</label>
            <input type="email"
                class="form-control"
                name="txtEmail"
                id="inputEmail"
                value="<?= $login['email'] ?>">
        </div>

        <div>
            <button class="btn btn-sm btn-primary mb-2 w-10" type="submit">Salvar Alteração</button>
        </div>
    </form>

    <form class="row g-3 mt-5" action="<?= ROOT_PATH ?>src/updateSenha.php" method="post">
        <input type="text" id="idUserSenha" name="txtIdUser" value="<?= $login['usuario_id'] ?>" class="form-control" hidden>

        <div class="col-md-4">
            <label for="inputSenha1" class="form-label">Nova Senha</label>
            <input type="password"
                class="form-control"
                name="txtNovaSenha"
                id="inputSenha1"
                required>
        </div>
        <div class="col-md-4">
            <label for="inputSenha2" class="form-label">Confirmar Senha</label>
            <input type="password"
                class="form-control"
                name="txtConfirmarSenha"
                id="inputSenha2"
                required>
        </div>

        <div>
            <button class="btn btn-sm btn-primary mb-2 w-10" type="submit">Alterar Senha</button>
        </div>
    </form>
    <div class="mt-5 col-md-4">
        <?php if (isset($mensagem)) { ?>
            <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
        <?php } ?>
    </div>


</main>

<?php
include_once("../includes/footer.php");
?>