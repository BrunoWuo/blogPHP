<?php
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");




##------------------------------------
## SELECT PARA MOSTRAR O POST SELECIONADO PARA EDITAR
##------------------------------------
 $postagem=null;

 
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $postagemId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM posts WHERE postagem_id = :postagemId";
    $select = $conexao->prepare($sql);
    $select->bindParam(':postagemId', $postagemId);


    if ($select->execute() && $select->rowCount() > 0) {
        $postagem = $select->fetch(PDO::FETCH_ASSOC);
    } else {               
        $_SESSION['mensagem'] = "Post não Existe!";
        $_SESSION['cor'] = 'alert-danger';  
        header("Location: " . ROOT_PATH . "screens/postar.php");    
    }
    unset($conexao);
}


##------------------------------------

?>

<main class="container mt-5">


    <form action="<?= ROOT_PATH ?>src/updatePost.php" method="POST" enctype="multipart/form-data">
        <h3>Editar Post</h3>
        <div class="row offset-md-2">
             <input type="text" id="postagemId" class="form-control" name="txtPostagemId" 
             value="<?= $postagem["postagem_id"]?>" hidden>
            <div class="mb-3">
                <label for="txtTituloPost" class="form-label">Título Post</label>
                <input type="text" id="txtTituloPost" class="form-control" name="txtTituloPost" autofocus="true" 
                value="<?= $postagem["titulo"]?>" required>
            </div>
            <div class="mb-3">
                <label for="txtResumoPost" class="form-label">Resumo Post</label>
                <input type="text" id="txtResumoPost" class="form-control" name="txtResumoPost" autofocus="true" 
                value="<?= $postagem["resumo"]?>" required>
            </div>

            <div class="mb-3">
                <label for="txtConteudoPost" class="form-label">Conteúdo Post</label>
                <textarea type="text" id="txtConteudoPost" class="form-control" rows="10" name="txtConteudoPost" required><?= $postagem["conteudo"]?></textarea>
            </div>

            <div class="mb-3">
                <label for="impPost" class="col-sm-8 col-form-label">Imagem</label>
                <img src="../img-posts/<?= $postagem["imagem_url"] ?? 'imgPadrao.png'?>" name="impPost" alt="" class="form-control" style="object-fit: scale-down; width: 450px; height: 250px;">
            </div>

            <div class="mb-3">
                <label for="poster_path" class="col-sm-8 col-form-label">Carregar Imagem</label>
                <input type="file" name="imgPost" class="form-control" accept="image/png, image/jpeg">
                <input type="text" name="imgName" value="<?= $postagem["imagem_url"]?>" hidden>
            </div>

            <div class="mb-3">
                <a type="button" class="btn btn-primary mb-3" href="<?= ROOT_PATH ?>screens/postar.php">Voltar</a>
                <button type="submit" class="btn btn-success mb-3">Atualizar Post</button>



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