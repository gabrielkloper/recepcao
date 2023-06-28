<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    echo "<script>alert('É necessário estar logado para acessar essa página')
    ;location.href='index.php'</script>";
}
?>