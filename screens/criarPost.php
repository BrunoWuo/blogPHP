<?php 
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");

?>

<main class="container mt-5">
    

        <form action="<?= ROOT_PATH ?>src/adicionarPost.php" method="POST" enctype="multipart/form-data">
            <h3>Criar Post</h3>
            <div class="row offset-md-2">
                <div class="mb-3">
                    <label for="txtTituloPost" class="form-label">Título Post</label>
                    <input type="text" id="txtTituloPost" class="form-control" name="txtTituloPost" autofocus="true" required>
                </div>
                <div class="mb-3">
                    <label for="txtResumoPost" class="form-label">Resumo Post</label>
                    <input type="text" id="txtResumoPost" class="form-control" name="txtResumoPost" autofocus="true" required>
                </div>

                <div class="mb-3">
                    <label for="txtConteudoPost" class="form-label">Conteúdo Post</label>
                    <textarea type="text" id="txtConteudoPost" class="form-control" rows="10" name="txtConteudoPost" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="poster_path" class="col-sm-8 col-form-label">Carregar Imagem</label>
                    <input type="file" name="imgPost" class="form-control" accept="image/png, image/jpeg">
                </div>

                <div class="mb-3">
                    <a type="button" class="btn btn-primary mb-3" href="<?= ROOT_PATH ?>screens/postar.php">Voltar</a>
                    <button type="submit" class="btn btn-success mb-3" >Criar Post</button>
                </div>
            </div>

        </form>
        <div>
             <?php if (isset($mensagem)) { ?>
                <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>
    </main>





<?php
include_once("../includes/footer.php");
?>