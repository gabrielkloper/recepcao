<?php

include("inc/validar-sessao.php");
include("inc/header.php");
include("contar-usuario.php");

if ($_SESSION['perfil'] == 0) {
    echo "<script>alert('Você não possui permissão de acesso a esta página!');
        location.href='index.php'</script>";
}







$sql_status_chave = "SELECT * FROM tabela_chave INNER JOIN tabela_visitante ON tabela_chave.visitante = tabela_visitante.id WHERE status = 1";
$res_status_chave = $conn->query($sql_status_chave);

?>

<body>
    <?php
    include("inc/nav-bars.php");

    // echo "Aqui: ".$_SESSION['id'];
    ?>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">Visão Geral da Biblioteca Parque</h2>
            </div>

            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-3 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"> <?= $rowcount3 ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    Visitantes Dentro da Biblioteca
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf">
                                    <i class="icon-copy fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-3 col-md-3 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"> <?= $rowcount_cadastros_total ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    Visitantes Cadastrados
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="green">
                                    <i class="icon-copy fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?= $rowcount_visitas_total ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    Visitas Recebidas
                                </div>
                            </div>
                            <div class="widget-icon">

                                <div class="icon" data-color="#d62828">
                                    <i class="icon-copy fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 mb-20">
                    <button type="button" class="w-100 h-100 border-0 text-left" data-toggle="modal" data-target="#exampleModalCenter">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark"> <?= $res_status_chave->num_rows ?></div>
                                    <div class="font-14 text-secondary weight-500">
                                        Chaves Ocupadas
                                    </div>
                                </div>
                                <div class="widget-icon">

                                    <div class="icon" data-color="#ffc107">
                                        <i class="icon-copy bi bi-key-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>

                </div>

            </div>


            <div class="pd-20 card-box mb-20 ">
                <div class="h4 mb-1">Buscar Usuário</div>

                <form method="POST" action="buscar-visitante.php">
                    <div class="input-group custom">
                        <input type="" name="buscar" class="form-control" placeholder="Insira o nome, nome social ou documento de identificação" />

                        <span class="input-group-btn input-group-append"><input class="btn btn-outline-primary" type="submit" name="btn-buscar" value="Buscar"></span>

                    </div>
                </form>


            </div>

            <!-- <div class="pd-20 card-box mb-20 ">

                 Button trigger modal 
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                    Chaves Ocupadas
                </button>
            </div> -->

            <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Ultimos Check ins - Dia <?= date('d/m/Y', time()) ?></div>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus">Nome</th>
                            <th>Nome Social</th>
                            <th>Data de Cadastro</th>
                            <th>Hora Entrada</th>
                            <th class="datatable-nosort">Check Out</th>
                            <?php
                            if ($_SESSION['perfil'] == 1) {

                            ?>
                                <!-- <th class="datatable-nosort">Editar</th> -->

                            <?php
                            }
                            ?>
                        </tr>
                    </thead>



                    <tbody>

                        <?php

                        while ($row = $result3->fetch_object()) {
                        ?>

                            <tr>
                                <td class="table-plus">


                                    <?= $row->nome_visitante ?>

                                </td>



                                <td><?= (empty($row->nome_social) ? "-" : $row->nome_social) ?></td>
                                <td> <?= date('d/m/Y', $row->data_cadastro) ?></td>
                                <td> <?= date('H:i:s', $row->data_entrada) ?> </td>


                                <td>
                                    <div class='table-actions'>
                                        <form method="post" action="salvar-horario.php?id=<?= $row->id ?>">
                                            <input type="hidden" name="acao" value="saida">

                                            <button type="submit" class="btn btn-danger" name="Saida">Saída</button>

                                        </form>
                                    </div>
                                </td>



                                <?php
                                if ($_SESSION['perfil'] == 1) {

                                ?>
                                    <!-- <td>
                                        <div class='table-actions'>
                                            
                                            <a href="?page=salvar-usuario&acao=excluir&id=<?php //$row->id 
                                                                                            ?>" data-color='#e95959'><i class='icon-copy dw dw-delete-3'></i></a>
                                            <a href="editar-visitante.php?id=<?php //$row->id 
                                                                                ?>" data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></a>
                                        </div>
                                    </td> -->


                            <?php
                                }
                                echo "</tr>";
                            }

                            ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Devolução de Chaves</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <form action="baixar-chave.php" method="post">
                                <input type="hidden" name="acao" value="chaves">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Chave</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Visitante</th>
                                            <th scope="col">Devolução</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($row_status_chave = $res_status_chave->fetch_assoc()) {
                                       
                                        ?>
                                            <tr>
                                                <td><?= $row_status_chave['chave'] ?></td>
                                                <td><?= $row_status_chave['status'] ? "Ocupada" : "Livre" ?></td>
                                                <td> <?= (empty($row_status_chave['nome_social']) ? $row_status_chave['nome_visitante'] : $row_status_chave['nome_visitante'] . " (" . $row_status_chave['nome_social'] . ")")  ?> </td>
                                                <td><input type="checkbox" name="chaves[]" class="chaves-ocupadas" value="<?= $row_status_chave['chave'] ?>"></td>
                                            </tr>
                                        <?php } 
                                         if ($res_status_chave->num_rows == 0) { ?>
                                            <tr>
                                                <td colspan="4">Não há chaves ocupadas</td>
                                            </tr>
                                            <?php
                                         }
                                        ?>

                                    </tbody>

                                </table>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button> -->
                            <?php 
                             if ($res_status_chave->num_rows > 0) { ?>
                            <button type="button" id="checkAll" class="btn btn-secondary">Marcar Todas</button>
                            <button type="submit" class="btn btn-primary">Devolver Chaves</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                </form>
            </div>


            <?php
            include("inc/footer.php");
            ?>

            <script>
                document.querySelector('#checkAll').addEventListener('click', function() {
                    if ($(this).hasClass('allChecked')) {
                        $('input[type="checkbox"]').prop('checked', false);
                    } else {
                        $('input[type="checkbox"]').prop('checked', true);
                    }
                    $(this).toggleClass('allChecked');
                });
            </script>



</body>

</html>