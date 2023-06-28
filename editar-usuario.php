<?php
include("inc/validar-sessao.php");
include("inc/conn.php");
if ($_SESSION['perfil'] != 1) {
    echo "<script>alert('Você não possui permissão de acesso a esta página!');
        location.href='menu.php'</script>";
}
include("inc/header.php");


$sql_listar_id_usuario = "SELECT * FROM login_usuario WHERE id=" . $_REQUEST["id"];
$res = $conn->query($sql_listar_id_usuario);

if ($res->num_rows == 0) {
    header('Location: ./buscar-usuario.php');
}

$row = $res->fetch_object();
?>

<body class="login-page">
    <?php
    include("inc/nav-bars.php");
    ?>

    <div class="main-container">
    <a class="float-right badge badge-pill" data-bgcolor='#fffff' data-color='#265ed7' href="buscar-usuario.php">voltar</a>

        <div class="pd-20 card-box mb-20 ">
            <form method="POST" action="editar-usuario.php">
            <input type="hidden" name="acao" value="editar-usuario">
                <input type="hidden" name="id" value="<?= $row->id ?>">


                <label for="">Nome Completo</label>
                <div class="input-group custom">
                    <input type="text" name="nome" class="form-control form-control-lg" value="<?= $row->nome_completo ?>" required />

                </div>

                <label for="">CPF</label>
                <div class="input-group custom">
                    <input type="text" name="cpf" class="form-control form-control-lg" value="<?= $row->cpf ?>" maxlength=11 required />

                </div>

                <label for="">Usuário</label>
                <div class="input-group custom">
                    <input type="text" name="usuario" class="form-control form-control-lg" value="<?= $row->usuario ?>" required />

                </div>
                <label for="">Senha</label>
                <div class="input-group custom">
                    <input type="password" name="senha" class="form-control form-control-lg" placeholder="**********" required />

                </div>
                <label for="">Confirmar Senha</label>
                <div class="input-group custom">
                    <input type="password" name="confirmar-senha" class="form-control form-control-lg" placeholder="**********" required />

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">

                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar">


                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['acao'])) {
            switch ($_REQUEST["acao"]) {
                case 'editar-usuario':
                    $nome = $conn->real_escape_string($_POST["nome"]);
                    $cpf = $conn->real_escape_string($_POST["cpf"]);
                    $usuario = $conn->real_escape_string($_POST["usuario"]);
                    $senha = md5(htmlentities($_POST["senha"]));
                    $sql_update_usuario = "UPDATE login_usuario SET
                        nome_completo ='{$nome}',
                        cpf='{$cpf}',
                        usuario='{$usuario}',
                        senha='{$senha}'
                        
                    WHERE id=" . $_REQUEST["id"];

                    $res = $conn->query($sql_update_usuario);
                    // die($sql_update);

                    if ($res === true) {

                        echo "<script>alert('Usuário editado com sucesso!');location.href='menu.php';</script>";
                    } else {

                        echo "<script>alert('Não foi possível realizar o edição.');location.href='menu.php';</script>";
                    }
                    break;
            }
        }
        ?>

    <?php
    include("inc/footer.php");
    ?>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            const password = document.querySelector("[name='senha']").value;
            const confirmPassword = document.querySelector("[name='confirmar-senha']").value;

            if (password !== confirmPassword) {
                event.preventDefault();
                alert("As senhas não correspondem!");
            }
        });
    </script>

</body>

</html>