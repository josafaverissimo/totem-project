<?php $this->load->view("components/base_head"); ?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        <?php $this->load->view("components/sidebar"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Criar usuário</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulário</h3>
                    </div>
                    <form id="main-form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control">

                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input id="cpf" name="cpf" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Cellphone</label>
                                <input id="cellphone" name="cellphone" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Criar</button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer"></footer>
    </div>
    <!-- ./wrapper -->


    <?php $this->load->view("components/base_footer"); ?>