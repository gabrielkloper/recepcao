<?php

include("inc/validar-sessao.php");
include("inc/header.php");
include("contar-usuario.php");



?>

<body>
    <?php
    include("inc/nav-bars.php");
    ?>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">Visão Geral da Biblioteca Parque</h2>
            </div>

            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"><?= $rowcount2 ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    Visitas Recebidas
                                </div>
                            </div>
                            <div class="widget-icon">

                                <div class="icon" data-color="#ff5b5b">
                                    <i class="icon-copy fa fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark"> <?= $rowcount ?></div>
                                <div class="font-14 text-secondary weight-500">
                                    Visitantes Cadastrados
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

            </div>


            <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Visitantes cadastrados</div>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus">Nome</th>
                            <th>Matricula</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Data de Cadastro</th>
                            <!-- <th>Cadastrado por</th> -->
                            <?php
                            if ($_SESSION['perfil'] == 1) {

                            ?>
                                <th class="datatable-nosort">Editar</th>
                        </tr>
                    <?php
                            }
                    ?>
                    </thead>



                    <tbody>

                        <?php

                        while ($row = $result->fetch_object()) {
                        ?>

                            <tr>
                                <td class="table-plus">
                                    <div class="name-avatar d-flex align-items-center">
                                        <div class="txt">
                                            <div class="weight-600">
                                                <?php if ($row->nome_social == '') {
                                                    echo $row->nome_visitante;
                                                } else {
                                                    echo $row->nome_social;
                                                }  ?></div>
                                        </div>
                                    </div>
                                </td>



                                <td> <?= $row->id ?> </td>
                                <td> <?= $row->email ?> </td>

                                <td> <?= telefone($row->telefone)  // função telefone está em contar-usuario.php?></td> 

                                <td> <?= date('d/m/Y', $row->data_cadastro) ?></td>
                                <!-- <td>
                                    <span class='badge badge-pill' data-bgcolor='#e7ebf5' data-color='#265ed7'> <?= $_SESSION['usuario'] ?></span>
                                </td> -->

                                <?php
                                if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2) {

                                ?>
                                    <td>
                                        <div class='table-actions'>
                                            
                                            <!-- <a href="?page=salvar-usuario&acao=excluir&id=<?=$row->id ?>" data-color='#e95959'><i class='icon-copy dw dw-delete-3'></i></a> -->
                                            <a href="editar-visitante.php?id=<?=$row->id ?>" data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></a>
                                        </div>
                                    </td>
                            </tr>

                    <?php
                                }
                            }

                    ?>


                
                    </tbody>
                </table>
            </div>

           
        </div>
    </div>
    <?php
    include("inc/footer.php");
    ?>


</body>

</html>