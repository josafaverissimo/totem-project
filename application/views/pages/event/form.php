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

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url("event"); ?>">
                                            Eventos
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
                      data-redirect="<?= base_url("event"); ?>" enctype="multipart/form-data" novalidate>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input id="name" name="name" type="text" class="form-control"
                                   value="<?= $event['name']; ?>" required>
                            <p id="name-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div class="form-group">
                            <label for="clients">Clientes</label>
                            <select id="clients" name="clients[]" class="form-control select2" multiple
                                    data-placeholder="Selecione os clientes" style="width: 100%;" required>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= $client->name ?>">
                                        <?= $client->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <p id="client-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div class="form-group">
                            <label for="event-category">Categoria</label>
                            <select id="event-category" name="event-category" class="form-control" required>
                                <?php foreach ($eventsCategories as $eventCategory): ?>
                                    <option value="<?= $eventCategory->hash ?>">
                                        <?= $eventCategory->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <p id="event-category-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div class="form-group">
                            <label for="background">Imagem de fundo</label>
                            <input id="background" name="background" type="file" class="form-control" required>
                            <p id="background-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div class="form-group">
                            <label for="active">Ativo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active"
                                       id="active-yes" value="1" checked>
                                <label class="form-check-label" for="active-yes">Habilitado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="active"
                                       id="active-no" value="0">
                                <label class="form-check-label" for="active-no">Desabilitado</label>
                            </div>
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
