<?php
session_start();
include("inc/conn.php");


$sql_listar_id_visitante = "SELECT * FROM tabela_visitante WHERE id=" . $_REQUEST["id"];
$res = $conn->query($sql_listar_id_visitante);
$row = $res->fetch_object();


switch ($_REQUEST["acao"]) {
    case 'entrada':

        $idCliente    = $_REQUEST["id"];
        $data_entrada = time();
        $setor        = $_REQUEST["setor"];
        $observacao        = $_REQUEST["observacao"];
        $totalchaves  = explode(',', substr($_REQUEST["totalchaves"], 0, -1));
        // $chaves       = serialize($_REQUEST["chave"]);


        $sql_status_cliente = "SELECT stats FROM tabela_horario WHERE stats=1 and id_visitante=" . $_REQUEST["id"] . " ORDER BY id DESC LIMIT 1";
        $res_status_cliente = $conn->query($sql_status_cliente);

        if ($res_status_cliente->num_rows >0) {
            $ultima_acao = 1;
        } else {
            $ultima_acao = 0;
        }

        



        if ($ultima_acao == 0) {
            $idUsuario = $_SESSION['id'];

            $sql_entrada = "INSERT INTO tabela_horario (id_usuario, id_visitante, data_entrada, setor, observacao, stats) VALUES ('{$idUsuario}','{$idCliente}','{$data_entrada}', '{$setor}', '{$observacao}', 1)";
            $res_entrada = $conn->query($sql_entrada);

            $id_entrada = mysqli_insert_id($conn);

            if ($totalchaves != '') {

                foreach ($totalchaves as $key => $value) {
                    $sql_entrada_chave = "INSERT INTO entrada_chave (id_entrada, id_chave, data_entrada) VALUES ('{$id_entrada}', '{$value}', '{$data_entrada}')";
                    $conn->query($sql_entrada_chave);

                    $sql_update_chave = "UPDATE tabela_chave SET  visitante ='{$idCliente}', status ='1' WHERE chave ='{$value}'";
                    $conn->query($sql_update_chave);
                }
            }
        } else {
            echo "<script>alert('Erro: Ultima ação registrada foi entrada')
            ;location.href='buscar-visitante.php'</script>";
        }

        if ($res_entrada === true) {

            echo "<script>alert('Entrada autorizada!');location.href='buscar-visitante.php'</script>";
           
            
        }
        break;



    case 'saida':


        $idCliente = $_REQUEST["id"];
        $data_saida = time();

        $sql_status = "SELECT stats FROM tabela_horario WHERE id_visitante=" . $_REQUEST["id"] . " ORDER BY id DESC LIMIT 1";
        $res = $conn->query($sql_status);
        $row = $res->fetch_assoc();
        $ultima_acao = $row["stats"];


        if ($ultima_acao == 1) {
            $sql_saida = "UPDATE tabela_horario SET
            data_saida='{$data_saida}', chaves = '', stats = 0
            WHERE id_visitante=" . $_REQUEST["id"] . " AND stats=1";
//die($sql_saida);
            $res = $conn->query($sql_saida);
            
        } else {
            echo "<script>alert('Erro: Ultima ação registrada foi saída')
            ;location.href='buscar-visitante.php'</script>";
        }
        if ($res === true) {

            echo "<script>alert('Saída autorizada!');location.href='menu.php';</script>";
        }

        break;

}
