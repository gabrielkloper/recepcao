<?php
include("inc/validar-sessao.php");
include("inc/conn.php");
include("inc/header.php");

?>





<body class="login-page">
    <?php
    include("inc/nav-bars.php");
    ?>

    <div class="main-container">

        <div class="pd-20 card-box mb-20 ">
            <form method="POST" action="buscar-visitante.php">
                <div class="input-group custom">
                    <input type="" name="buscar" class="form-control" placeholder="Buscar Usuário" />

                    <span class="input-group-btn input-group-append"><input class="btn btn-outline-primary" type="submit" name="btn-buscar" value="Buscar"></span>

                </div>

            </form>
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">Tabela de Visitantes</h4>
                </div>
            </div>
            <?php

            @$pesquisa = $conn->real_escape_string($_POST['buscar']);
            $sql_pesquisa = "SELECT * FROM tabela_visitante WHERE nome_visitante LIKE '%$pesquisa%' OR cpf LIKE '$pesquisa%' LIMIT 10";
            $res_pesquisa = $conn->query($sql_pesquisa);
            $qtd = $res_pesquisa->num_rows;

            if ($qtd == 0) {
                echo "<h4>Nenhum resultado encontrado</h4>  <p>Para efetuar novo cadastro <a href='cadastro-completo.php'>clique aqui</a></p>";
            } else {
            ?>
                <table class="data-table table nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nome Social</th>
                            <th scope="col">CPF</th>
                            <th class="datatable-nosort" scope="col">Check In</th>
                            

                            <?php
                            if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] ==2) {

                            ?>
                                <th class="datatable-nosort" scope="col">Editar</th>
                            <?php
                            }
                            ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dados = $res_pesquisa->fetch_assoc()) {
                        ?>
                            <tr>

                                <td>
                                    <?= (empty($dados['nome_visitante']) ? "-" : $dados['nome_visitante']) ?>
                                    <?php
                                    $sql_pesquisa2 = "SELECT * FROM tabela_chave WHERE visitante =" . $dados['id'] ." AND status = 1";
                                    $res_pesquisa2 = $conn->query($sql_pesquisa2);
                                    if($res_pesquisa2->num_rows > 0){
                                ?>
                                   
                                   <small style="color: red; font-weight: bold"> Atenção! Visitante não devolveu a chave do armário.</small>
                                   
                                <?php } ?>
                                </td>
                                <td>
                                    <?= (empty($dados['nome_social']) ? "-" : $dados['nome_social']) ?>
                                </td>

                                <td>
                                    <?= substr($dados['cpf'], 0, 3) . "*****" . substr($dados['cpf'], -3) ?>
                                </td>
                                <td>

                                    <?php

                                    $hora_corte = '21:00:00'; //fazer verificação com timestamp
                                    $hora_atual = date('H:i:s');
                                    if ($hora_atual >= $hora_corte) {
                                        echo "Biblioteca fechada";
                                    } else {
                                    ?>



                                        
                                        <a href="#" data-toggle="modal" data-target="#Medium-modal" class="btn btn-success botao-item" name="Entrada" data-item="<?= $dados['id'] ?>" data-foto="<?= $dados['foto'] ?>" data-nome="<?= $dados['nome_visitante'] ?>" data-nome-social="<?= $dados['nome_social']?>">Entrada</a>


                                        

                                    <?php } ?>


                                </td>
                                
                                <?php
                                if ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2) {
                                ?>
                                    <td>
                                        <div class='table-actions'>
                                            <a href="editar-visitante.php?id=<?= $dados['id'] ?>" data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></a>
                                        </div>
                                    </td>

                                <?php
                                }
                                ?>
                            </tr>


                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
    </div>




    <!-- modal -->

    <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Escolha o Setor
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <form method="post" action="salvar-horario.php" onkeydown="return event.key != 'Enter';" id="form-chave">
                    <input type="hidden" name="acao" value="entrada">
                    <input type="hidden" name="id" id="item">
                    <input type="hidden" name="chaves" id="chaves-hidden">
                    <input type="hidden" id="totalchaves" name="totalchaves">



                    <div class="row">
                        <div class="col-md-12">
                            <img style='display:block; width:250px;height:175px; border: 1px solid #1b00ff;' id="foto" class="m-auto p-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="flex-row">


                                <h6 id="nome" class="d-flex justify-content-center"></h6>
                                <h7 id="nomesocial" class="d-flex justify-content-center"></h7>
                            </div>
                        </div>
                    </div>
                    

                    
                    <div class="modal-body p-4">

                        <label for='setor'>Biblioteca Parque</label>
                        <select class="form-control" id="setor" name="setor" required>
                            <option value="">Escolha uma opção</option>
                            <option value="biblioteca">Biblioteca</option>
                            <option value="secec">SECEC</option>
                            <option value="biblioteca infantil">Biblioteca Infantil</option>
                            <option value="auditorio">Auditório</option>
                            <option value="teatro">Teatro</option>
                            <option value="estudio">Estúdio</option>
                            <option value="proa">PROA</option>
                            <option value="sala de danca">Sala de Dança</option>
                            <option value="laboratorio 1">Laboratório 1</option>
                            <option value="laboratorio 2">Laboratório 2</option>
                            <option value="laboratorio 3">Laboratório 3</option>
                        </select>
                        <br>

                        <label for="chave">Chaves:</label>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <input type="text" name="" id="input_chave" class="form-control">

                            </div>


                            <div class="col-md-5 col-sm-12">
                                <select class="form-control" id="chave" name="chave[]" multiple>

                                </select>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <input type="button" id="btnAddOption" value="Confirmar" class="btn btn-sm btn-primary">

                                <input type="button" id="btnCorrectOption" value="  Corrigir  " class="btn btn-sm btn-danger mt-2">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label for="observacao" class="mt-4">Observação:</label>
                            </div>

                            <div class="col-md-8 col-sm-12">
                                <input type="text" name="observacao"  class="form-control mt-4">
                            </div>


                        </div>


                        <div class="modal-footer mt-2">
                            <button type="submit" class="btn btn-success" name="Entrada">Liberar Entrada</button>

                        </div>
                </form>

            </div>
        </div>
    </div>


    <!-- modal -->



    <?php
    include("inc/footer.php");
    ?>

    <script>
        
        $(document).ready(function() {
            $('.botao-item').click(function() {
                var x = $(this).data('item');
                $('#item').val(x);
                var y = $(this).data('nome');
                $('#nome').text(y);
                var w = $(this).data('nome-social');
                $('#nomesocial').text(w);
                var z = $(this).data('foto');
                $('#foto').attr('src', z);
            })
        })
    </script>



    <script>
        document.querySelector('#input_chave').addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
                document.getElementById('btnAddOption').click();
                

            }

        });



        document.querySelector('#btnAddOption').addEventListener('click', function() {

            let inputValue = document.querySelector('#input_chave').value;
            let select = document.querySelector('#chave');



            $.post("busca-chave.php", {
                    nomechave: inputValue
                })
                .done(function(data) {
                    if (data == "ok") {
                        document.querySelector('#totalchaves').value += inputValue + ',';

                        //Verifica se o valor é vazio
                        if (inputValue.trim() !== '') {

                            // Cria a opção no campo select com o mesmo valor para id e value
                            let option = document.createElement('option');
                            option.text = inputValue;
                            option.value = inputValue;

                            // Adiciona a opção no campo select
                            select.add(option);

                            for (let index = 0; index < select.options.length; index++) {
                                let option_selected = select.options[index];
                                option_selected.selected = true;
                            }
                        }
                    } else {
                        alert("Chave inexistente ou ocupada.")
                    }
                });

                document.querySelector('#input_chave').value = '';
                document.querySelector('#input_chave').focus();




        });

        //Script para limpar os options do select
        document.querySelector('#btnCorrectOption').addEventListener('click', function() {
            let select = document.querySelector('#chave');
            select.removeChild(select.lastChild);
            let totalchaves = document.querySelector('#totalchaves').value;
            document.querySelector("#totalchaves").value = totalchaves.substring(0, totalchaves.length - 4);
        });
    </script>

    <script>
        $(document).ready(function() {
            // adiciona o evento de listener no botão de submit do formulário
            $('form').submit(function(e) {
                // evita que o formulário seja enviado antes de modificar o valor do input hidden
                e.preventDefault();
                // define o valor selecionado no campo select para o valor do input hidden "chaves"
                $('#chaves-hidden').val($('#chaves').val());
                // envia o formulário
                this.submit();
            });
        });
    </script>





<script>
    $('#Medium-modal').on('hidden.bs.modal', function (e) {
        $('#form-chave').reset();
    })
</script>

</body>

</html>