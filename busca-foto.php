<?php
include("./inc/conn.php");
include("./inc/validar-sessao.php");

if (isset($_POST["idvalue"])) {
    $idValue = $_POST["idvalue"];

$sql_busca_foto = "SELECT nome_visitante, nome_social, cpf, foto FROM tabela_visitante WHERE id='" . $_POST["idvalue"] ."'";
$res_busca_foto = $conn->query($sql_busca_foto);

if ($res_busca_foto->num_rows > 0) {
    // Obtém os dados do resultado da consulta
    $row_busca_foto = $res_busca_foto->fetch_assoc();

    // Monta um array associativo com os dados desejados
    $dados = array(
        'nome_visitante' => $row_busca_foto['nome_visitante'],
        'nome_social' => $row_busca_foto['nome_social'],
        'cpf' => $row_busca_foto['cpf'],
        'foto' => $row_busca_foto['foto']
    );

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode($dados);
} else {
    // Caso nenhum resultado seja encontrado, pode retornar uma mensagem de erro, se desejado
    echo json_encode(array('erro' => 'Nenhum resultado encontrado.'));
}
} else {
// Caso o ID não seja fornecido, retorna uma mensagem de erro
echo json_encode(array('erro' => 'ID não fornecido.'));
}
?>
