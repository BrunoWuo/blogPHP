<?php 

if (!$logado) {
    header("Location:" . ROOT_PATH . "screens/login.php");
    exit;
}

?>