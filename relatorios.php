<?php

include("inc/validar-sessao.php");
include("inc/header.php");
include("contar-usuario.php");

if ($_SESSION['perfil'] == 0) {
    echo "<script>alert('Você não possui permissão de acesso a esta página!');
        location.href='index.php'</script>";
}

?>

<body>
    <?php
    include("inc/nav-bars.php");

    // echo "Aqui: ".$_SESSION['id'];
    ?>

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">Dados e Relatórios</h2>
            </div>

            <div class="row pb-10">
                <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
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


                <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
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
                <div class="col-xl-4 col-lg-4 col-md-4 mb-20">
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

            </div>



            <!-- <div class="pd-20 card-box mb-20 ">
                <label for="dados-biblioteca">Dados Biblioteca</label>
                <select name="relatorios" class="form-control">
                    <option value="total">Total</option>
                    <option value="janeiro">Janeiro</option>
                    <option value="fevereiro">Fevereiro</option>
                    <option value="marco">Março</option>
                    <option value="abril">Abril</option>
                    <option value="maio">Maio</option>
                    <option value="junho">Junho</option>
                    <option value="julho">Julho</option>
                    <option value="agosto">Agosto</option>
                    <option value="setembro">Setembro</option>
                    <option value="outubro">Outubro</option>
                    <option value="novembro">Novembro</option>
                    <option value="dezembro">Dezembro</option>
                </select>
            </div> -->



            <div class="card-box pb-10">
                <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7' href="menu.php">voltar</a>

                <div class="h5 pd-20 mb-0">Ano <?= date('Y', time()) ?></div>
                <table class="relatorio table table-hover table-bordered" data-ordering="false">
                    <thead class="thead-dark">
                        <tr>
                            <th class="data">Meses</th>
                            <th class="">Nº de Registros</th>
                            <th>Nº de Visitas</th>
                            <th>Registros Masculinos</th>
                            <th>Registros Femininos</th>
                            <th>Visitas Masculinas</th>
                            <th>Visitas Femininas</th>
                            <!-- <th class="">Faixa Etária</th> -->
                            <?php if ($_SESSION['perfil'] == 1) { ?>
                                <!-- <th class="datatable-nosort">Editar</th> -->
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        function getCount($conn, $table, $whereClause)
                        {
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM $table WHERE $whereClause");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            return $result->fetch_assoc()['COUNT(*)'];
                        }

                        function getRowCount($conn, $sql)
                        {
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $stmt->store_result();
                            $rowCount = $stmt->num_rows;
                            $stmt->close();
                            return $rowCount;
                        }

                        $months = array("janeiro" => 31, "fevereiro" => 28, "março" => 31, "abril" => 30, "maio" => 31, "junho" => 30, "julho" => 31, "agosto" => 31, "setembro" => 30, "outubro" => 31, "novembro" => 30, "dezembro" => 31);

                        $timestamp = strtotime('2023-01-01');
                        foreach ($months as $month => $days) {
                            // Total de visitantes cadastrados no mês
                            $start = $timestamp;
                            $end = strtotime("+ $days days", $timestamp);
                            $rowcount1 = getCount($conn, "tabela_visitante", "data_cadastro >= '$start' AND data_cadastro < '$end'");

                            // Total de visitas no mês
                            $rowcount2 = getCount($conn, "tabela_horario", "data_saida >= '$start' AND data_saida < '$end'");

                            // Total de visitantes masculinos cadastrados no mês
                            $rowcount3 = getCount($conn, "tabela_visitante", "sexo = 'masculino' AND data_cadastro >= '$start' AND data_cadastro < '$end'");

                            // Total de visitantes femininos cadastrados no mês
                            $rowcount4 = getCount($conn, "tabela_visitante", "sexo = 'feminino' AND data_cadastro >= '$start' AND data_cadastro < '$end'");

                            // Total de visitas de homens no mês
                            $sql_visitas_homens_mes = "SELECT COUNT(*) as total_visitas FROM tabela_visitante INNER JOIN tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante WHERE tabela_visitante.sexo = 'masculino' AND tabela_horario.data_saida >= '$start' AND tabela_horario.data_saida < '$end' GROUP BY YEAR(tabela_horario.data_saida), MONTH(tabela_horario.data_saida)";
                            $result_visitas_homens_mes = mysqli_query($conn, $sql_visitas_homens_mes);
                            $total_visitas_homens_mes = 0;
                            while ($row = mysqli_fetch_assoc($result_visitas_homens_mes)) {
                                $total_visitas_homens_mes += $row['total_visitas'];
                            }

                            // Total de visitas de mulheres no mês
                            $sql_visitas_mulheres_mes = "SELECT COUNT(*) as total_visitas FROM tabela_visitante INNER JOIN tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante WHERE tabela_visitante.sexo = 'feminino' AND tabela_horario.data_saida >= '$start' AND tabela_horario.data_saida < '$end' GROUP BY YEAR(tabela_horario.data_saida), MONTH(tabela_horario.data_saida)";
                            $result_visitas_mulheres_mes = mysqli_query($conn, $sql_visitas_mulheres_mes);
                            $total_visitas_mulheres_mes = 0;
                            while ($row = mysqli_fetch_assoc($result_visitas_mulheres_mes)) {
                                $total_visitas_mulheres_mes += $row['total_visitas'];
                            }


                        ?>
                            <tr class="table-primary">
                                <td><?php echo ucfirst($month); ?></td>
                                <td><?php echo $rowcount1; ?></td>
                                <td><?php echo $rowcount2; ?></td>
                                <td><?php echo $rowcount3; ?></td>
                                <td><?php echo $rowcount4; ?></td>
                                <td><?php echo $total_visitas_homens_mes; ?></td>
                                <td><?php echo $total_visitas_mulheres_mes; ?></td>
                                <!-- <td><?php echo $rowcount4; ?></td> -->
                            </tr>
                        <?php
                            $timestamp = $end;
                        } ?>
                        <tr class="table-primary">
                            <td><b>Total</td>
                            <td><?php echo $rowcount_cadastros_total; ?></td>
                            <td><?php echo $rowcount_visitas_total; ?></td>
                            <td><?php echo $rowcount_total_h_c; ?></td>
                            <td><?php echo $rowcount_total_m_c; ?></td>
                            <td><?php echo $rowcount_result_visita_h_t; ?></td>
                            <td><?php echo $rowcount_result_visita_m_t; ?></td>
                            <!-- <td><?php echo $rowcount4; ?></td> -->
                        </tr>
                    </tbody>
                </table>
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

            <script>
                $(document).ready(function() {
                    $('.relatorio').DataTable({
                        dom: "<'row justify-content-between align-items-center'<'col-3'l><'col-3'B><'col-3'f>><t><'row justify-content-between align-items-center'<'col-3'i><'col-3'p>>",
                        buttons: [
                            {
                        extend: "copy",
                        className: "btn-sm"
                    },
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm"
                    },
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                        ],
                        "language": {
                            "info": "_START_-_END_ of _TOTAL_ entries",
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
                            searchPlaceholder: "Search",
                            paginate: {
                                next: '<i class="ion-chevron-right"></i>',
                                previous: '<i class="ion-chevron-left"></i>'
                            }
                        },
                    });
                });
            </script>



</body>

</html>