<?php 
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
// include_once("../service/auth.php");


?>

 <main class="container mt-5">

        <h2>Tela Administração</h2>
        <div class="col-2" >
            <?php if (isset($mensagem)) { ?>
                <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>         
        <hr>
        <div class="row">
            <div class="col"><a class="btn btn-success p-5" href="<?= ROOT_PATH ?>admin/screens/posts.php">Administrar Posts</a></div>
            <div class="col"><a class="btn btn-success p-5" href="">Administrar Usuários</a></div>
        </div>
        

    </main>

<?php
include_once("../includes/footer.php");
?>

