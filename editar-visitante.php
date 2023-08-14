<?php
include("inc/validar-sessao.php");
include("inc/header.php");
include("inc/conn.php");



$sql_listar_id = "SELECT * FROM tabela_visitante WHERE id=" . $_REQUEST["id"];
$res = $conn->query($sql_listar_id);

if ($res->num_rows == 0) {
    header('Location: ./buscar-visitante.php');
}

$row = $res->fetch_object();
?>

<body>
    <?php
    include("inc/nav-bars.php");

    ?>


    <div class="main-container">
        <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7' href="buscar-visitante.php">voltar</a>

        <div class="pd-20 card-box mb-20 ">

            <form method="POST" action="editar-visitante.php" class="col-md-10 ml-auto">
                <input type="hidden" name="acao" value="editar-visitante">
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <label class="col-sm-12 col-md-2 col-form-label"></label>


                <div class="row">
                    <div class="col-md-12 ">
                        <div class="flex-row">
                            <div class=""> <!--d-flex justify-content-center-->
                                <img src="<?= $row->foto ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input name="nome-visitante" class="form-control" type="text" placeholder="" value="<?= $row->nome_visitante ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nome Social</label>
                            <input name="nome-social" class="form-control" type="text" placeholder="" value="<?= $row->nome_social ?>">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>CPF</label>
                            <input name="cpf" id="cpf" class="form-control" placeholder="" type="text" maxlength="20" value="<?= $row->cpf ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>RG</label>
                            <input name="rg" class="form-control" placeholder="" type="text" value="<?= $row->rg ?>" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" placeholder="email@example.com" type="email" value="<?= $row->email ?>" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input name="telefone" class="form-control" id="celular" placeholder="(21)99999-9999" value="<?= $row->telefone ?>" type="tel" >
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Data Nasc.</label>
                            <input type="date" name="nascimento" id="nascimento" class="form-control" value="<?= $row->data_nascimento ?>" onchange="validarIdade()">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Sexo</label>
                            <input type="text" name="sexo" class="form-control" value="<?= $row->sexo ?>" readonly>


                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>CEP</label>
                            <input name="cep" type="text" id="cep" size="10" maxlength="9" class="form-control" value="<?= $row->cep ?>" >
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Rua</label>
                            <input name="rua" type="text" id="rua" size="60" class="form-control" value="<?= $row->rua ?>" >
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Número</label>
                            <input name="numero" type="text" id="numero" size="60" class="form-control" value="<?= $row->numero ?>" >
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Bairro</label>
                            <input name="bairro" type="text" id="bairro" size="40" class="form-control" value="<?= $row->bairro ?>" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input name="cidade" type="text" id="cidade" size="40" class="form-control" value="<?= $row->cidade ?>" >
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                            <label>UF</label>
                            <input name="uf" type="text" id="uf" size="2" class="form-control" value="<?= $row->uf ?>" >
                        </div>
                    </div>
                </div>

                <div class="row" id="linha-responsaveis" style="display:none">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nome do Responsável</label>
                            <input name="nome-responsavel" id="nome-responsavel" class="responsavel form-control" type="text" placeholder="" value="<?= $row->nome_responsavel ?>">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>CPF do Responsável</label>
                            <input name="cpf-responsavel" id="cpf2" class="responsavel form-control" placeholder="" value="<?= $row->cpf_responsavel ?>" type="text" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="row" id="linha-responsaveis-2" style="display:none">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nome do Responsável</label>
                            <input name="nome-responsavel2" id="nome-responsavel" class="responsavel form-control" value="<?= $row->nome_responsavel2 ?>" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>CPF do Responsável</label>
                            <input name="cpf-responsavel2" id="cpf3" class="responsavel form-control" placeholder="" value="<?= $row->cpf_responsavel2 ?>" type="text" maxlength="20">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Medium-modal" type="button" value="Tirar foto"><i class="icon-copy bi bi-camera-fill"> Atualizar Foto</i>
                        </a>
                    </div>
                </div>




                <img src="" alt="" class="mostrafoto">



                <div class=" ">
                    <div class="col-sm-12">
                        <div class="input-group mb-0 ml-auto">
                            <input type="hidden" name="txtfoto" id="txtfoto" value="<?= $row->foto ?>">
                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar Dados">
                        </div>
                    </div>
                </div>
            </form>




            <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                Câmera
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">



                            <div id="my_camera" style="border: solid 1px #000; min-height:150px"></div>


                            <!-- A button for taking snaps -->

                            <div id="pre_take_buttons">
                                <input type=button value="Tirar Foto" onClick="preview_snapshot()" class="btn btn-primary btn-sm">
                            </div>
                            <div id="post_take_buttons" style="display:none">
                                <input type=button value="&lt; Tirar Outra" onClick="cancel_preview()" class="btn btn-primary btn-sm">
                                <input type=button value="Salvar Foto &gt;" onClick="save_photo()" style="font-weight:bold;" class="btn btn-primary btn-sm">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>




        <?php

        function limpar_dados($valor)
        {
            $valor = trim($valor);
            $valor = str_replace(array('.', '(', ')', '-', '/', " "), "", $valor);
            return $valor;
        }

        if (isset($_POST['acao'])) {
            switch ($_REQUEST["acao"]) {
                case 'editar-visitante':
                    $nome_visitante = $conn->real_escape_string($_POST["nome-visitante"]);
                    $nome_social = $conn->real_escape_string($_POST["nome-social"]);
                    $cpf = $conn->real_escape_string($_POST["cpf"]);
                    $rg = $conn->real_escape_string($_POST["rg"]);
                    $telefone = $conn->real_escape_string($_POST["telefone"]);
                    $email = $conn->real_escape_string($_POST["email"]);
                    $cep = $conn->real_escape_string($_POST["cep"]);
                    $rua = $conn->real_escape_string($_POST["rua"]);
                    $cidade = $conn->real_escape_string($_POST["cidade"]);
                    $bairro = $conn->real_escape_string($_POST["bairro"]);
                    $numero = $conn->real_escape_string($_POST["numero"]);
                    $uf = $conn->real_escape_string($_POST["uf"]);
                    $sexo = $conn->real_escape_string($_POST["sexo"]);
                    $data_nascimento = $conn->real_escape_string($_POST["nascimento"]);
                    $nome_responsavel = $conn->real_escape_string($_POST["nome-responsavel"]);
                    $cpf_responsavel = $conn->real_escape_string($_POST["cpf-responsavel"]);
                    $nome_responsavel2 = $conn->real_escape_string($_POST["nome-responsavel2"]);
                    $cpf_responsavel2 = $conn->real_escape_string($_POST["cpf-responsavel2"]);
                    $foto = $conn->real_escape_string($_POST["txtfoto"]);
                    $data_cadastro = time();

                    $telefone = limpar_dados($telefone);
                    $cpf = limpar_dados($cpf);
                    $cpf_responsavel = limpar_dados($cpf_responsavel);
                    $cpf_responsavel2 = limpar_dados($cpf_responsavel2);

                    $sql_update = "UPDATE tabela_visitante SET
                        nome_visitante ='{$nome_visitante}',
                        nome_social = '{$nome_social}',
                        cpf='{$cpf}',
                        rg='{$rg}',
                        email='{$email}',
                        telefone='{$telefone}',
                        cep='{$cep}',
                        rua='{$rua}',
                        cidade='{$cidade}',
                        bairro='{$bairro}',
                        numero='{$numero}',
                        uf='{$uf}',
                        sexo='{$sexo}',
                        data_nascimento='{$data_nascimento}',
                        nome_responsavel='{$nome_responsavel}',
                        nome_responsavel2='{$nome_responsavel2}',
                        cpf_responsavel='{$cpf_responsavel}',
                        cpf_responsavel2='{$cpf_responsavel2}',
                        foto='{$foto}'
                        
                    WHERE id=" . $_REQUEST["id"];

                    $res = $conn->query($sql_update);
                    // die($sql_update);

                    if ($res === true) {

                        echo "<script>alert('Editado com sucesso!');location.href='menu.php';</script>";
                    } else {

                        echo "<script>alert('Não foi possível realizar o edição.');location.href='menu.php';</script>";
                    }
                    break;
            }
        }
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
 left JOIN
    tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
 WHERE
    tabela_visitante.id =" . $_REQUEST['id'] . " ORDER BY tabela_horario.data_entrada ASC";

        $res = $conn->query($sql_listar_id);
        //$row = $res->fetch_object();
        ?>



        <div class="pd-20 card-box mb-20 ">
            <div class="h5 pd-20 mb-0">
                <h2>Histórico de Visitas</h2>
                <br>
                <?php
                // if ($res->num_rows >0 ) {
                $row = $res->fetch_assoc();
                if ($row['nome_social'] == '') {
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




                            <td data-sort="<?= $row['data_entrada'] ?>">
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
                                    <?= $row['setor']; ?>
                                </span>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
                <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7' href="buscar-visitante.php">voltar</a>
            </table>
        </div>
    </div>




    <?php
    

    include("inc/footer.php");
    ?>

    <script src="./src/scripts/jquery.mask.js"></script>
    <script src="./script.js"></script>



    <script>
        $(document).ready(function() {
            $('#celular').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');
            $('#cpf2').mask('000.000.000-00');
            $('#cpf3').mask('000.000.000-00');
        });
    </script>

    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

    <script>
        function validarIdade() {
            var dataNascimento = document.getElementById("nascimento").value;
            var parts = dataNascimento.split("-");
            var dtNascimento = new Date(parts[0], parts[1] - 1, parts[2]);
            var hoje = new Date();
            var idade = hoje.getFullYear() - dtNascimento.getFullYear();
            var mes = hoje.getMonth() - dtNascimento.getMonth();

            if (mes < 0 || (mes === 0 && hoje.getDate() < dtNascimento.getDate())) {
                idade--;
            }

            if (idade < 18) {
                document.getElementById("linha-responsaveis").style.display = "flex";
                document.getElementById("linha-responsaveis-2").style.display = "flex";
            } else {
                document.getElementById("linha-responsaveis").style.display = "none";
                document.getElementById("linha-responsaveis-2").style.display = "none";
            }
        }
    </script>


    <script src="./src/scripts/webcamjs-master/webcam.min.js"></script>

    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');


        function preview_snapshot() {
            // freeze camera so user can preview pic
            Webcam.freeze();

            // swap button sets
            document.getElementById('pre_take_buttons').style.display = 'none';
            document.getElementById('post_take_buttons').style.display = '';
        }

        function cancel_preview() {
            // cancel preview freeze and return to live camera feed
            Webcam.unfreeze();

            // swap buttons back
            document.getElementById('pre_take_buttons').style.display = '';
            document.getElementById('post_take_buttons').style.display = 'none';
        }



        function save_photo() {
            // actually snap photo (from preview freeze) and display it
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('txtfoto').value = data_uri;

                document.querySelector('.mostrafoto').setAttribute('src', data_uri);



                // swap buttons back
                document.getElementById('pre_take_buttons').style.display = '';
                document.getElementById('post_take_buttons').style.display = 'none';
            });
        }
    </script>

</body>



</html>