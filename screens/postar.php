<?php 
include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../includes/header.php");
include_once("../service/auth.php");

##------------------------------------
## CODIGO PARA PAGINAÇÃO
##------------------------------------
$pagina = 1;
if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
}
if (!$pagina) {
    $pagina = 1;
}

$limite = 10;
$inicio = ($pagina * $limite) - $limite;

$sql = "SELECT COUNT(postagem_id) count FROM posts WHERE usuario_id = :idUser";
$select = $conexao->prepare($sql);
$select->bindParam(':idUser', $idUser);

if ($select->execute()) {
    $registros = $select->fetch()["count"];
}

$paginas = ceil($registros / $limite);
## FIM PAGINAÇÃO



##------------------------------------
## POSTS FILTRADOS POR USUARIO
##------------------------------------
$sqlPost = "SELECT * FROM posts WHERE usuario_id = :idUser LIMIT $inicio, $limite";
$select = $conexao->prepare($sqlPost);
$select->bindParam(":idUser", $idUser);
if ($select->execute()){
    $postagens = $select->fetchAll(PDO::FETCH_ASSOC);
}
unset($conexao);

##------------------------------------


?>

 <main class="container mt-5">

        <a class="btn btn-success mb-4" role="button" href="<?= ROOT_PATH ?>screens/criarPost.php"><i class="bi bi-plus-circle-fill"></i> Criar Novo Post</a>
        <div class="col-2" >
            <?php if (isset($mensagem)) { ?>
                <p class="alert <?= $cor ?> mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Titulo</th>
                <th>resumo</th>
                <th>Data Postagem</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($postagens as $post) { ?>
                <tr>
                    <td><?= htmlspecialchars($post["titulo"]) ?></td>
                    <td><?= htmlspecialchars($post["resumo"]) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:m', strtotime($post["data_criacao"]))) ?></td>
                    <td>
                        <a class="btn btn-warning" role="button" 
                        href="editarPost.php?id=<?= htmlspecialchars($post["postagem_id"]) ?>"><i class="bi bi-pencil"></i></a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= htmlspecialchars($post["postagem_id"]) ?>">
                            <i class="bi bi-trash3"></i>
                        </button>

                    </td>
                </tr>
                <!--  EXCLUIR POST -->
                <div class="modal fade" id="deleteModal-<?= htmlspecialchars($post["postagem_id"]) ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Excluir Postagem</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir a postagem "<?= htmlspecialchars($post["titulo"]) ?>" ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <a href="<?= ROOT_PATH ?>src/deletePost.php?id=<?= htmlspecialchars($post["postagem_id"]) ?>" class="btn btn-danger">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </table>
    


        <!--inicio navegar entre paginas-->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?pagina=1">Primeira</a></li>

                <?php if ($pagina > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?= $pagina - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php
                for ($i = 1; $i <= $paginas; $i++) {
                    $estilo = "";
                    if ($pagina == $i) {
                        $estilo = "active";
                    }

                ?>
                    <li class="page-item"><a class="page-link <?= $estilo ?>" href="?pagina=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($pagina < $paginas) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?= $pagina + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>


                <li class="page-item"><a class="page-link" href="?pagina=<?= $paginas ?>">Última</a></li>
            </ul>
        </nav>
        <!--fim navegar entre paginas-->

    </main>

<?php
include_once("../includes/footer.php");
?>

