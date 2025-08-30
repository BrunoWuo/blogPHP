<?php
include_once("../constante.php");
include_once("../includes/header.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");


##------------------------------------
## SELECT PARA MOSTRAR O POST SELECIONADO PARA EDITAR
##------------------------------------
$postagem = null;


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $postagemId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    ##-------------------------------------
    ## SELECT Postagem por IDPostagem
    ##-------------------------------------    
    $sql = "SELECT p.*, u.nome as nomeUsuario 
        FROM posts p        
        INNER JOIN usuarios u
        ON p.usuario_id = u.usuario_id
        WHERE p.postagem_id = :postagemId
        ORDER BY postagem_id DESC";
    $select = $conexao->prepare($sql);
    $select->bindParam(':postagemId', $postagemId);


    if ($select->execute() && $select->rowCount() > 0) {
        $postagem = $select->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: " . ROOT_PATH . "index.php");
    }

    ##-------------------------------------
    ## SELECT Comentario por IDPostagem
    ##-------------------------------------

    $sqlComentario = "SELECT c.*, u.nome as nomeUsuario 
        FROM comentarios c        
        INNER JOIN usuarios u
        ON c.usuario_id = u.usuario_id
        WHERE c.postagem_id = :postagemId
        ORDER BY postagem_id DESC";
    $selectComentario = $conexao->prepare($sqlComentario);
    $selectComentario->bindParam(':postagemId', $postagemId);


    if ($selectComentario->execute() && $selectComentario->rowCount() > 0) {
        $comentarios = $selectComentario->fetchAll(PDO::FETCH_ASSOC);
    }


    unset($conexao);
}


?>
<!-- Page content-->
<div class="container mt-5 d-flex ">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= htmlspecialchars($postagem['titulo']) ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">
                        Postado em <?= htmlspecialchars(date('d/m/Y H:m', strtotime($postagem["data_criacao"]))) ?>
                        por <?= htmlspecialchars($postagem['nomeUsuario']) ?>
                    </div>
                </header>
                <!-- Preview image figure-->
                <img class="img-fluid rounded" style="height: 480px; object-fit: scale-down" src="../img-posts/<?= htmlspecialchars($postagem['imagem_url']) ? htmlspecialchars($postagem['imagem_url']) : 'imgPadrao.png' ?>" alt="..." />
                <!-- Post content-->
                <section class="mt-3">
                    <p class="fs-5 mb-4"><?= htmlspecialchars($postagem['conteudo']) ?></p>
                </section>
            </article>
            <hr>
            <!-- Adicionar Comentario-->
            <form action="<?= ROOT_PATH ?>src/adicionarComentario.php" method="POST">
                <div class="form-floating">
                    <input type="text" class="form-control" name="txtUsuarioId" value="<?= htmlspecialchars($idUser) ?>" hidden>
                    <input type="text" class="form-control" name="txtPostagemId" value="<?= htmlspecialchars($postagem['postagem_id']) ?>" hidden>
                    <label for="floatingInput">Digite o comentário</label>
                    <textarea type="text" id="txtComentario" class="form-control" rows="10" name="txtConteudoPost" required></textarea>
                </div>
                <div class="mt-2">
                    <a href="<?= ROOT_PATH ?>index.php" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
            <hr>
            <!-- Mostrar Comentarios -->
            <?php foreach ($comentarios as $comentario) { ?>
                <div class="card p-2">
                    <p class="text-muted fst-italic">
                        Comentado em <?= htmlspecialchars(date('d/m/Y H:m', strtotime($comentario["data_criacao"]))) ?>
                        por <?= htmlspecialchars($comentario['nomeUsuario']) ?>
                    </p>
                    <p class="fs-5 mb-4"><?= htmlspecialchars($comentario['conteudo']) ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
include_once("../includes/footer.php");
?>