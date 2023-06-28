<?php
include("inc/validar-sessao.php");
if ($_SESSION['perfil'] != 1) {
    echo "<script>alert('Você não possui permissão de acesso a esta página!');
        location.href='menu.php'</script>";
}
include("inc/header.php");
?>

<body class="login-page">
    <?php
    include("inc/nav-bars.php");
    ?>

    <div class="main-container">
        <div class="pd-20 card-box mb-20 ">
            <form method="POST" action="salvar-usuario.php">
                <input type="hidden" name="acao" value="cadastrar">


                <label for="">Nome Completo</label>
                <div class="input-group custom">
                    <input type="text" name="nome" class="form-control form-control-lg" required />

                </div>

                <label for="">CPF</label>
                <div class="input-group custom">
                    <input type="text" name="cpf" class="form-control form-control-lg" maxlength=11 required />

                </div>

                <label for="">Usuário</label>
                <div class="input-group custom">
                    <input type="text" name="usuario" class="form-control form-control-lg" required />

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

                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Cadastrar">


                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>



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