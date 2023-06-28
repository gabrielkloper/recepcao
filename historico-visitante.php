<?php
include("inc/validar-sessao.php");
include("inc/header.php");
include("inc/conn.php");

?>

<?php
include("inc/nav-bars.php");
?>

<?php
$sql_listar_id = "SELECT
    tabela_visitante.nome_visitante,
    tabela_visitante.nome_social,
    tabela_visitante.id,
    tabela_visitante.cpf,
    tabela_horario.data_entrada,
    tabela_horario.data_saida,
    tabela_horario.setor
 FROM
    tabela_visitante
 INNER JOIN
    tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
 WHERE
    tabela_visitante.id =" . $_REQUEST['id'] . " ORDER BY tabela_horario.data_entrada ASC";

$res = $conn->query($sql_listar_id);
//$row = $res->fetch_object();
?>


<body>
    <div class="main-container">
        <div class="pd-20 card-box mb-20 ">
            <div class="h5 pd-20 mb-0">
                <?php
               // if ($res->num_rows >0 ) { POSSIVEL ERRO AQUI PRIMEIRA LINHA NÃO APARECE
                $row = $res->fetch_assoc();
                if($row['nome_social'] == '') {  
                    echo $row['nome_visitante'] . " - ";
                } else {
                    echo $row['nome_visitante'] . " - ";
                    echo $row['nome_social'];
                }
                // echo "CPF: " . $row['cpf'];

                ?>

            </div>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <!-- <th class="datatable-nosort" scope="col">Nome</th> -->
                        <!-- <th class="datatable-nosort" scope="col">Matricula</th> -->
                        <!-- <th class="datatable-nosort" scope="col">Documento</th> -->
                        <th scope="col">Dia</th>
                        <th class="datatable-nosort" scope="col">Hora de Entrada</th>
                        <th class="datatable-nosort" scope="col">Hora de Saída</th>
                        <th class="datatable-nosort" scope="col">Setor</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $res->fetch_assoc()) {
                        ?>
                        <tr>



                            <!-- <td>
                                <?= $row['id'] ?>
                            </td> -->

                            <!-- <td>
                                <?= $row['documento'] ?>
                            </td> -->

                            <td  data-sort="<?=$row['data_entrada']?>">
                                <span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7'>
                                    <?= date('d/m/Y', $row['data_entrada']); ?>
                                </span>
                            </td>

                            <td>
                                <span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#2E8B57'>
                                    <?= date('H:i:s', $row['data_entrada']); ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                if ($row['data_saida'] == null) {
                                    echo "O cliente ainda está na biblioteca";
                                } else {
                                    echo " <span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#e95959'>" . date('H:i:s', $row['data_saida']) . "</span>";
                                }
                                ?>
                            </td>

                            <td>
                                <span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#736BA8'>
                                    <?=  $row['setor']; ?>
                                </span>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
                <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7'
                    href="buscar-visitante.php">voltar</a>
            </table>
        </div>
    </div>




    <?php
                //} else {
                  //  echo "<script>alert('Visitante ainda não possui histórico.');location.replace('buscar-visitante.php')</script>";
               // }
    include("inc/footer.php");
    ?>
</body>

</html>