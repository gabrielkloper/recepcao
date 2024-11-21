<?php
include("./inc/conn.php");
include("./inc/validar-sessao.php");

switch ($_REQUEST["acao"]) {
    case 'chaves':

        //$visitante    = $_POST["id"];
        $data_saida = time();

        if (isset($_POST["chaves"])) {
            $totalchaves  = $_POST["chaves"];
            // $chaves       = serialize($_REQUEST["chave"]);


            $sql_status_chave = "SELECT * FROM tabela_chave WHERE status=1";
            $res_status_chave = $conn->query($sql_status_chave);
            $row_status_chave = $res_status_chave->fetch_assoc();
            //$ultima_acao = $row_status_cliente["stats"];

            if ($totalchaves != '') {

                $chaves_ids = implode("','", $totalchaves); // Prepara os valores para a cláusula IN
                $sql_busca_visitantes = "SELECT chave, visitante FROM tabela_chave WHERE chave IN ('{$chaves_ids}') AND status = 1";
                $res_visitantes = $conn->query($sql_busca_visitantes);

                $visitantes = [];
                if ($res_visitantes && $res_visitantes->num_rows > 0) {
                    while ($row = $res_visitantes->fetch_assoc()) {
                        $visitantes[$row['chave']] = $row['visitante'];
                    }
                }

                foreach ($totalchaves as $key => $value) {
                    if (isset($visitantes[$value])) {
                        $id_visitante = $visitantes[$value];
                        $sql_saida = "UPDATE tabela_horario SET
        data_saida='{$data_saida}', chaves = '', stats = 0
        WHERE id_visitante='{$id_visitante}' AND stats=1";
                        //die($sql_saida);
                        $res = $conn->query($sql_saida);

                        $sql_saida_chave = "UPDATE entrada_chave set status=0,  data_saida = {$data_saida} WHERE id_chave = '{$value}'";
                        $conn->query($sql_saida_chave);

                        $sql_baixar_chave = "UPDATE tabela_chave SET status = 0, visitante='' WHERE chave = '{$value}' AND status = 1";
                        $res_baixar_chave = $conn->query($sql_baixar_chave);
                    }
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
