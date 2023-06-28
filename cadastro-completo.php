<?php
include("inc/validar-sessao.php");
include("inc/header.php");

?>

<body class="login-page">



    <?php
    include("inc/nav-bars.php");
    ?>


    <div class="main-container">
        <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7' href="buscar-visitante.php">voltar</a>

        <div class="pd-20 card-box mb-30">
            <form method="POST" action="salvar-usuario.php" class="col-md-10 ml-auto" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="cadastrar_visitante">

                <?php 
                    echo"<br>"
                ?>
                
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input name="nome-visitante" class="form-control" type="text" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nome Social</label>
                            <input name="nome-social" class="form-control" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>CPF</label>
                            <input name="cpf" id="cpf" class="form-control" placeholder="" type="text" maxlength="20" required>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>RG</label>
                            <input name="rg" class="form-control" placeholder="" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" placeholder="email@example.com" type="email" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input name="telefone" class="form-control" id="celular" placeholder="(21)99999-9999" type="tel" >
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Data Nasc.</label>
                            <input type="date" name="nascimento" id="nascimento" class="form-control" onchange="validarIdade()" required max="<?= date("Y-m-d",time()) ?>">


                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Sexo</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="sexo" required>
                                <option value="">Escolha uma opção</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>


                        </div>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>CEP</label>
                            <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" class="form-control" >
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Rua</label>
                            <input name="rua" type="text" id="rua" size="60" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label>Número</label>
                            <input name="numero" type="text" id="numero" size="60" class="form-control" >
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Bairro</label>
                            <input name="bairro" type="text" id="bairro" size="40" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input name="cidade" type="text" id="cidade" size="40" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                            <label>UF</label>
                            <input name="uf" type="text" id="uf" size="2" class="form-control" >
                        </div>
                    </div>
                </div>

                <div class="row" id="linha-responsaveis" style="display:none">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nome do Responsável</label>
                            <input name="nome-responsavel" id="nome-responsavel1" class="responsavel form-control" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>CPF do Responsável</label>
                            <input name="cpf-responsavel" id="cpf2" class="responsavel form-control" placeholder="" type="text" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="row" id="linha-responsaveis-2" style="display:none">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nome do Responsável</label>
                            <input name="nome-responsavel2" id="nome-responsavel2" class="responsavel form-control" type="text" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>CPF do Responsável</label>
                            <input name="cpf-responsavel2" id="cpf3" class="responsavel form-control" placeholder="" type="text" maxlength="20">
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Medium-modal" type="button" value="Tirar foto"><i class="icon-copy bi bi-camera-fill"> Tirar Foto</i>
                        </a>
                    </div>
                </div>




                <img src="" alt="" class="mostrafoto">



                <div class=" ">
                    <div class="col-sm-12">
                        <div class="input-group mb-0 ml-auto">
                            <input type="hidden" name="txtfoto" id="txtfoto">
                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Cadastrar">
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
        include("inc/footer.php");
        ?>

        <!-- <script src="./script.js"></script> -->
        <script src="./src/scripts/jquery.mask.js"></script>



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
                var responsavel = document.querySelectorAll(".responsavel");

                if (mes < 0 || (mes === 0 && hoje.getDate() < dtNascimento.getDate())) {
                    idade--;
                }

                if (idade < 18) {
                    document.getElementById("linha-responsaveis").style.display = "flex";
                    document.getElementById("linha-responsaveis-2").style.display = "flex";
                    // document.querySelector(".responsavel").setAttribute("required", "");
                    for (let i = 0; i < responsavel.length; i++) {
                        responsavel[i].setAttribute("required", "");
                    }
                } else {
                    document.getElementById("linha-responsaveis").style.display = "none";
                    document.getElementById("linha-responsaveis-2").style.display = "none";
                    // document.querySelector(".responsavel").removeAttribute("required");
                    for (let i = 0; i < responsavel.length; i++) {
                        responsavel[i].removeAttribute("required");

                    }
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