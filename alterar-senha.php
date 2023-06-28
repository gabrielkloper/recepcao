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
    <?php
        echo "<h4>Alterar senha cadastrada</h4> <br>";
      
    ?>
    
            <form method="POST" action="salvar-usuario.php">
                <input type="hidden" name="acao" value="alterar-senha">
                
                <label for="">Insira a Nova Senha</label>
                <div class="input-group custom">
                    <input type="password" name="alterar-senha" class="form-control form-control-lg" placeholder="**********" required />

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group mb-0">

                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Alterar">


                        </div>

                    </div>
                </div>
            </form>

    </div>
</div>




<?php
include("inc/footer.php");
?>
</body>

</html>