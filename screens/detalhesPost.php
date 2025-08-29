<?php
include_once("../constante.php");
include_once("../includes/header.php");
include_once("../service/conexao.php");


##------------------------------------
## SELECT PARA MOSTRAR O POST SELECIONADO PARA EDITAR
##------------------------------------
$postagem = null;


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
                    <div class="text-muted fst-italic mb-2">Postado em <?= htmlspecialchars(date('d/m/Y H:m', strtotime($postagem["data_criacao"]))) ?></div>
                </header>
                <!-- Preview image figure-->
                <img class="img-fluid rounded" style="height: 480px; object-fit: scale-down" src="../img-posts/<?= htmlspecialchars($postagem['imagem_url']) ? htmlspecialchars($postagem['imagem_url']) : 'imgPadrao.png' ?>" alt="..." />
                <!-- Post content-->
                <section class="mt-3">
                    <p class="fs-5 mb-4"><?= htmlspecialchars($postagem['conteudo']) ?></p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                        <!-- Comment with nested comments-->
                        <div class="d-flex mb-4">
                            <!-- Parent comment-->
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                <!-- Child comment 1-->
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                    </div>
                                </div>
                                <!-- Child comment 2-->
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When you put money directly to a problem, it makes a good headline.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single comment-->
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
<?php
include_once("../includes/footer.php");
?>