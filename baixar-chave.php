<?php
include("./inc/conn.php");
include("./inc/validar-sessao.php");

switch ($_REQUEST["acao"]) {
case 'chaves':

    //$visitante    = $_POST["id"];
    $data_saida = time();
   
  if(isset($_POST["chaves"])) {
    $totalchaves  = $_POST["chaves"];
    // $chaves       = serialize($_REQUEST["chave"]);


    $sql_status_chave = "SELECT * FROM tabela_chave WHERE status=1";
    $res_status_chave = $conn->query($sql_status_chave);
    $row_status_chave = $res_status_chave->fetch_assoc();
    //$ultima_acao = $row_status_cliente["stats"];

    if ($totalchaves != '') {

    foreach ($totalchaves as $key => $value) {
        $sql_saida_chave = "UPDATE entrada_chave set status=0,  data_saida = {$data_saida} WHERE id_chave = '{$value}'";
        $conn->query($sql_saida_chave);

        $sql_baixar_chave = "UPDATE tabela_chave SET status = 0, visitante='' WHERE chave = '{$value}' AND status = 1";
        $res_baixar_chave = $conn->query($sql_baixar_chave);
    }
}

    if ($res_baixar_chave === true) {

        echo "<script>alert('Chaves liberadas!')
        ;location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Erro: Tente novamente!')
        ;location.href='menu.php';</script>";
     
    }
} else {
    echo "<script>alert('Escolha pelo menos uma chave!')
    ;location.href='menu.php';</script>";
}

    
break;
}