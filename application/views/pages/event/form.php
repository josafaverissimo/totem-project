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
        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Evento</h3>
                </div>
                <form id="main-form" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <label>Cliente</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option>Cliente-1</option>
                                    <option>Cliente-2</option>
                                    <option>Cliente-3</option>
                                    <option>Cliente-4</option>
                                    <option>Cliente-5</option>
                                    <option>Josafa</option>
                                    <option>Joanderson</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label for="cpf">Tipo do Evento</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Aniversário</option>
                                    <option>Casamento</option>
                                    <option>Formatura</option>
                                    <option>Comemoração</option>
                                    <option>Outros</option>
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="nameEvent">Nome do evento</label>
                                <input id="nameEvent" name="nameEvent" type="text" class="form-control" value="">
                            </div>
                            <div class="col-sm-5">
                                <label for="address">Deseja que seja exibido o evento?</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger" type="radio"
                                           id="customRadio4" name="customRadio2" checked>
                                    <label for="customRadio4" class="custom-control-label">Sim, exibir evento</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                           type="radio" id="customRadio5" name="customRadio2">
                                    <label for="customRadio5" class="custom-control-label">Não exibir evento</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <label for="exampleInputFile">Upload plano de fundo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Escolha a foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>


<?php $this->load->view("components/base_footer"); ?>