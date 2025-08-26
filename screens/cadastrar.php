<?php

include_once("../constante.php");
include_once("../includes/header.php");


?>
<div class="d-flex justify-content-center mt-5">
    <main class="w-25 form-signin">
        <form action="<?= ROOT_PATH ?>src/cadastrarUsuario.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Cadastrar Senac - Blog</h1>

            <div class="form-floating">
                <input type="text" class="form-control"
                    placeholder="Nome"
                    name="txtNome"
                    id="floatingInputNome">
                <label for="floatingInputNome">Nome</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control"
                    placeholder="name@email.com"
                    name="txtEmail"
                    id="floatingInputEmail">
                <label for="floatingInputEmail">Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control"
                    placeholder="****"
                    name="txtSenha"
                    id="floatingPassword">
                <label for="floatingPassword">Senha</label>
                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                    style="cursor: pointer;" id="togglePassword">
                    <i class="bi bi-eye" id="iconEye"></i>
                </span>
            </div>

            <button type="submit" class="w-100 btn btn-lg btn-primary mb-2">Cadastrar</button>
        </form>
        <div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>

        <a class="link m-6" aria-current="page" href="<?= ROOT_PATH ?>screens/login.php">Já tenho cadastro</a>

    </main>
</div>


<?php
include_once("../includes/footer.php");
?>