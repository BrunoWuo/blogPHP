<?php
include_once("./constante.php");
include_once("./includes/header.php");
include_once("./service/conexao.php");



// Mostrar dados do post

$sql = "SELECT p.*, u.nome as nomeUsuario FROM posts p
        INNER JOIN usuarios u
        ON p.usuario_id = u.usuario_id
        ORDER BY postagem_id DESC";
$select = $conexao->prepare($sql);

if ($select->execute()) {
    $postagens = $select->fetchAll(PDO::FETCH_ASSOC);
}


// var_dump($postagens);
// die;

unset($conexao);


?>

<main>
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-3">
                <h1 class="fw-bolder">Bem Vindo ao Senac Blog!</h1>
            </div>
        </div>
    </header>

    <div class="container">

        <div class="row">
            <?php
            foreach ($postagens as $post) {
            ?>
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <img class="card-img-to img-fluid rounded shadow" style="height: 250px; object-fit: cover" src="./img-posts/<?= htmlspecialchars($post['imagem_url']) ? htmlspecialchars($post['imagem_url']) : 'imgPadrao.png' ?>" alt="..." />
                        <div class="card-body">
                            <div class="small text-muted"><?= htmlspecialchars(date('d/m/Y H:m', strtotime($post["data_criacao"]))) ?> por <?= htmlspecialchars($post['nomeUsuario']) ?></div>
                            <h2 class="card-title h4"><?= htmlspecialchars($post['titulo']) ?></h2>
                            <p class="card-text"><?= htmlspecialchars($post['resumo']) ?></p>
                            <a class="" href="<?= ROOT_PATH ?>screens/detalhesPost.php?id=<?= htmlspecialchars($post["postagem_id"]) ?>">Veja mais →</a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>

        </div>




</main>

<?php
include_once("./includes/footer.php");
?>