<?php
include("inc/validar-sessao.php");
if ($_SESSION['perfil'] != 1) {
    echo "<script>alert('Você não possui permissão de acesso a esta página!');
        location.href='menu.php'</script>";
}

include("inc/conn.php");
include("inc/header.php");
?>

<body class="login-page">
    <?php
    include("inc/nav-bars.php");
    ?>

    <div class="main-container">
        <div class="pd-20 card-box mb-20 ">
            <form method="POST" action="buscar-usuario.php">
                <div class="input-group custom">
                    <input type="" name="buscar" class="form-control" placeholder="Buscar Usuário" />

                    <span class="input-group-btn input-group-append"><input class="btn btn-outline-primary" type="submit" name="btn-buscar" value="Buscar"></span>
                </div>

            </form>
            <div class="clearfix mb-20">
                <div class="pull-left">
                    <h4 class="text-blue h4">Tabela de Usuarios Internos</h4>
                </div>
            </div>
            <?php

            @$pesquisa = $conn->real_escape_string($_POST['buscar']);
            $sql_pesquisa = "SELECT * FROM login_usuario WHERE perfil > 0 AND (nome_completo LIKE '%$pesquisa%' OR usuario LIKE '%$pesquisa%' OR cpf LIKE '%$pesquisa%')";
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
                            <th scope="col">Usuário</th>
                            <th scope="col">CPF</th>
                            <?php
                            if ($_SESSION['perfil'] == 1) {
                            ?>
                                <th class="datatable-nosort" scope="col">Editar</th>
                                <th class="datatable-nosort" scope="col">Excluir</th>
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
                                    <?= (empty($dados['nome_completo']) ? "-" : $dados['nome_completo']) ?>
                                </td>
                                <td>
                                    <?= (empty($dados['usuario']) ? "-" : $dados['usuario']) ?>
                                </td>

                                <td>
                                    <?= substr($dados['cpf'], 0, 3) . "*****" . substr($dados['cpf'], -3) ?>
                                </td>
                                <?php
                                if ($_SESSION['perfil'] == 1) {
                                ?>
                                    <td>
                                        <div class='table-actions'>
                                            <a href="editar-usuario.php?id=<?= $dados['id'] ?>" data-color='#265ed7'><i class='icon-copy dw dw-edit2'></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="salvar-usuario.php?acao=2&id=<?= $dados['id'] ?>" class="btn btn-danger botao-item" name="Excluir">Excluir</a>
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

    <?php
    include("inc/footer.php");
    ?>
</body>
</html>