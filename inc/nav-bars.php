    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="src/images/logo_secec.png" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->

    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>

        </div>
        <div class="header-right align-items-center">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <!-- <span class="user-icon">
                         <img src="src/images/default-user-image.png" alt="" />
                        </span> -->
                        <span class="user-name"><?= $_SESSION['nome'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Perfil</a> -->
                        <a class="dropdown-item" href="alterar-senha.php"><i class="dw dw-settings2"></i> Alterar Senha</a>
                        <!-- <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Ajuda</a> -->
                        <a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Sair</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark ">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>



                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">
                        Reset Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="menu.php">
                <img src="src/images/logo_secec.png" alt="" class="dark-logo" />
                <img src="src/images/logo_secec.png" alt="" class="light-logo" />
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="menu.php" class="dropdown-toggle no-arrow" data-option="off">
                            <span class="micon bi bi-house"></span><span class="mtext"> Home</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon icon-copy fa fa-user"></span><span class="mtext">Visitante</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="cadastro-completo.php">Cadastrar</a></li>
                            <li><a href="buscar-visitante.php">Procurar</a></li>


                        </ul>
                    </li>
                    <?php
                    if ($_SESSION['perfil'] == 1) {

                    ?>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon icon-copy fa fa-user-circle"></span><span class="mtext">Admin</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="cadastro.php">Criar Usuário Interno</a></li>
                                <li><a href="buscar-usuario.php">Configuração Usuários Internos</a></li>
                                <li><a href="relatorios.php">Relatórios</a></li>
                            </ul>
                            
                        </li>
                    <?php
                    }

                    ?>


                    <!-- <li>
                        <a href="invoice.html" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Relatório</span>
                        </a>
                    </li> -->
                    <!-- <li>
                        <div class="dropdown-divider"></div>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>