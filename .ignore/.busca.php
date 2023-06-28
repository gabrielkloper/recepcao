<?php
include("inc/validar-sessao.php");
include("inc/header.php");

?>

<body class="login-page">
    <?php
    include("inc/nav-bars.php");
    ?>
    <div class="main-container">
        <div class="pd-20 mb-20 ">
            <div class="col-md-12 col-lg-12">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h4 class="text-center text-primary">Buscar Usuário </h4>
                    </div>
                    <form method="POST" action="buscar-visitante.php">
                        <div class="input-group custom">
                            <input type="search" name="buscar" class="form-control form-control-lg" placeholder="" />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">


                                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="btn-buscar" value="Buscar">


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    include("inc/footer.php");
    ?>
</body>

</html>