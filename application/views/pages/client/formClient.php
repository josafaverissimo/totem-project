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
                                <!-- <?php
                                if ($editMode) :
                                    echo "Editar usuário";
                                else :
                                    echo "Criar usuário";
                                endif;
                                ?> -->
                            </h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Clientes</h3>
                    </div>
                    <form id="main-form" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control" value="">

                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input id="cpf" name="cpf" type="text" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Telefone</label>
                                <input id="cellphone" name="cellphone" type="text" class="form-control" value="" data-inputmask='"mask": "(99) 9 9999-9999"' data-mask>
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço</label>
                                <input id="address" name="address" type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Enviar
                                <!-- <?php
                                if ($editMode) :
                                    echo "Editar";
                                else :
                                    echo "Criar";
                                endif;
                                ?> -->
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>


    <?php $this->load->view("components/base_footer"); ?>