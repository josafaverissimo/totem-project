<?php $this->load->view("components/base_head"); ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>


        <?php $this->load->view("components/sidebar"); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?php
                                if ($editMode) :
                                    echo "Editar usuário";
                                else :
                                    echo "Criar usuário";
                                endif;
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulário</h3>
                    </div>
                    <form id="main-form" action="<?= $formAction ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control" value="<?= $user['name'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input id="cpf" name="cpf" type="text" class="form-control" value="<?= $user['cpf'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Cellphone</label>
                                <input id="cellphone" name="cellphone" type="text" class="form-control" value="<?= $user['cellphone'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    <?php
                                    if ($editMode) :
                                        echo "Nova senha";
                                    else :
                                        echo "Senha";
                                    endif;
                                    ?>
                                </label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <?php
                                if ($editMode) :
                                    echo "Editar";
                                else :
                                    echo "Criar";
                                endif;
                                ?>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>


    <?php $this->load->view("components/base_footer"); ?>