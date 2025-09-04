<?php
include_once("../../constante.php");
include_once("../../includes/header.php");
include_once("../../service/conexao.php");
// include_once("../service/auth.php");


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


    unset($conexao);
}


?>
<!-- Page content-->
<div class="container mt-5 d-flex ">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <img class="img-fluid rounded" style="height: 480px; object-fit: scale-down" src="<?= ROOT_PATH ?>\img-posts\<?= htmlspecialchars($postagem['imagem_url']) ? htmlspecialchars($postagem['imagem_url']) : 'imgPadrao.png' ?>" alt="..." />
        </div>
        <div class="col-lg-6">
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
                <!-- Post content-->
                <section class="mt-3">
                    <p class="fs-5 mb-4"><?= htmlspecialchars($postagem['conteudo']) ?></p>
                </section>
            </article>
            <hr>
            <a class="btn btn-success mb-4" role="button" href="<?= ROOT_PATH ?>admin/screens/posts.php">Voltar</a>
        </div>
    </div>
</div>
<?php
include_once("../../includes/footer.php");
?>