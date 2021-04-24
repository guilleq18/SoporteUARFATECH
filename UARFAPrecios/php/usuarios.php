<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST['user'])){
    session_start();
    $_SESSION['inventarioUser'] = $_POST['user'];
    header("Location: /inventario");
}
?>
