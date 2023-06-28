<?php
include("./inc/conn.php");
include("./inc/validar-sessao.php");

$sql_busca_chave = "SELECT * FROM tabela_chave WHERE status=0 and chave='" . $_POST["nomechave"] ."'";
$res_busca_chave = $conn->query($sql_busca_chave);

if ($res_busca_chave->num_rows>0) {
    echo "ok";
} 


//$row_busca_chave = $res_busca_chave ->fetch_object();
?>