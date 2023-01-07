<?php $this->load->view("components/base_head"); ?>

    <div class="wrapper">
        <?php $this->load->view("components/navbar"); ?>
        <?php $this->load->view("components/sidebar"); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?php
                                if ($editMode) :
                                    echo "Editar categoria de evento";
                                else :
                                    echo "Criar categoria de evento";
                                endif;
                                ?>
                            </h1>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?= base_url("event/category"); ?>">
                                                Categoria de eventos
                                            </a>
                                        </li>
                                        <li class=" breadcrumb-item active">Formulário</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div id="form-card" class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Eventos</h3>
                    </div>
                    <form id="main-form" action="<?= $formAction; ?>" data-wrapper-selector="#form-card"
                          data-redirect="<?= base_url("event/category"); ?>" novalidate>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?= $eventCategory['name']; ?>" required>
                                <p id="name-input-error" class="input-error-message mt-1" hidden></p>
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