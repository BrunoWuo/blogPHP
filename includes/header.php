<?php


?>

<!DOCTYPE html>
<html lang="pt-br" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Blog - SENAC</title>    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT_PATH ?>index.php">Senac BLOG <?= $nomeUser ? " - $nomeUser" : "" ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                <div class="px-3">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= ROOT_PATH ?>index.php">Blogs</a>
                        </li>
                        <?php if ($logado) { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= ROOT_PATH ?>screens/postar.php">Postar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= ROOT_PATH ?>screens/perfil.php">Perfil</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <?php if (!$logado) { ?>
                                <a class="nav-link active" aria-current="page" href="<?= ROOT_PATH ?>screens/login.php">Login</a>
                            <?php } else { ?>
                                <a class="nav-link active" aria-current="page" href="<?= ROOT_PATH ?>src/logout.php">Logout</a>
                            <?php } ?>
                        </li>

                    </ul>
                </div>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>