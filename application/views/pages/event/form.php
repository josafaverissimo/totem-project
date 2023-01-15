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
                                    style="width: 100%;" required>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= $client->hash ?>"
                                        <?php
                                        if ($editMode):
                                            if (in_array($client->hash, $eventClientsHashs)):
                                                echo "selected";
                                            endif;
                                        endif;
                                        ?>
                                    >
                                        <?= $client->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <p id="client-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div class="form-group">
                            <label for="event-category">Categoria</label>
                            <select id="event-category" name="category" class="form-control" required>
                                <option disabled <?php echo $editMode ? "" : "selected"; ?> value="">
                                    Selecione uma categoria
                                </option>
                                <?php foreach ($eventsCategories as $eventCategory): ?>
                                    <option value="<?= $eventCategory->hash ?>"
                                        <?php echo $eventCategory->id === $event['events_category_id'] ? "selected" : ""; ?>
                                    >
                                        <?= $eventCategory->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <p id="event-category-input-error" class="input-error-message mt-1" hidden></p>
                        </div>

                        <div>
                            <p><strong>Background</strong></p>

                            <div style="position: relative">
                                <div style="position: absolute; bottom: 0">
                                    <button class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target=".full-image"
                                            type="button">
                                        <i class="fas fa-expand"></i>
                                    </button>

                                    <div class="modal fade full-image" tabindex="-1" role="dialog"
                                         aria-labelledby="full-image" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <img id="modal-full-image"
                                                    <?php if ($editMode): ?>
                                                        src="<?= base_url("public/uploads/{$event['background']}"); ?>"
                                                    <?php else: ?>
                                                        src="<?= base_url("public/assets/imgs/no-image.jpeg"); ?>"
                                                    <?php endif; ?>
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <img id="background-handler"
                                    <?php if ($editMode): ?>
                                        src="<?= base_url("public/uploads/{$event['background']}"); ?>"
                                    <?php else: ?>
                                        src="<?= base_url("public/assets/imgs/no-image.jpeg"); ?>"
                                    <?php endif; ?>
                                     style="width: 300px; height: 200px; max-width: 500px;"
                                     class="img-thumbnail pointer">
                            </div>

                            <p id="background-input-error" class="input-error-message mt-1" hidden></p>
                            <input id="background" name="background" type="file" class="form-control"
                                   accept="image/png,image/jpg,image/jpeg" hidden <?= $editMode ? "" : "required" ?>>
                        </div>

                        <div class="form-group">
                            <label for="active">Ativo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active"
                                       id="active-yes" value="T"
                                    <?php if ($editMode): ?>
                                        <?= $event['active'] === "T" ? "checked" : "" ?>
                                    <?php else: ?>
                                        checked
                                    <?php endif; ?>
                                >
                                <label class="form-check-label" for="active-yes">Habilitado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="active"
                                       id="active-no" value="F"
                                    <?= ($editMode && $event['active'] === "F") ? "checked" : "" ?>
                                >
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
