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


        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tabela de usuários</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <table class="main-table table table-striped table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nome</th>
                                    <th>cpf</th>
                                    <th>telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="control">
                                        <td>
                                            <div class="buttons-control">
                                                <span class="edit"><i class="fas fa-edit"></i></span>
                                                <span class="delete"><i class="fas fa-trash"></i></span>
                                            </div>
                                            <span class="table-td-text"><?= $user->id; ?></span>
                                        </td>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->cpf; ?></td>
                                        <td><?= $user->cellphone; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <?php $this->load->view("components/base_footer"); ?>