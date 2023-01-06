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
                                    echo "Editar evento";
                                else :
                                    echo "Criar evento";
                                endif;
                                ?>
                            </h1>
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
                          data-redirect="<?= base_url("event"); ?>" novalidate>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?= $event['name']; ?>" required>
                                <p id="name-input-error" class="input-error-message mt-1" hidden></p>
                            </div>
                            <div class="form-group">
                                <label for="client">Cliente</label>
                                <select id="client" class="form-control" required>
                                    <?php foreach ($clients as $client): ?>
                                        <option value="<?= $client->hash ?>">
                                            <?= $client->name ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <p id="client-input-error" class="input-error-message mt-1" hidden></p>
                            </div>

                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <select id="category" class="form-control" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->hash ?>">
                                            <?= $category->name ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <p id="client-input-error" class="input-error-message mt-1" hidden></p>
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