<?php $this->load->view("components/base_head"); ?>
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <div class="flex flex-jcent" style="width: 100%">
                <img style="width: 90px; height: 90px" src="<?= base_cdn("public/assets/imgs/LOGO-03.png"); ?>" alt="Relive Logo" class="brand-image img-circle elevation mt-1 mb-1">
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0"> Selecione o evento</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Formulário</h5>
                            </div>
                            <form id="main-form" action="<?= base_url("eventSelection/loadEvent"); ?>" data-wrapper-selector="#form-card" data-redirect="<?= base_url("client"); ?>" novalidate>
                                <div id="form-card" class="card-body">
                                    <div class="form-group mb-0">
                                        <label for="clients">Eventos</label>
                                        <select id="event-category" name="category" class="form-control" required>
                                            <option disabled selected value=""> Selecione um evento</option>
                                            <?php foreach ($events as $event) : ?>
                                                <option value="<?= $event['hash'] ?>">
                                                    <?= $event['name'] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <p id="event-category-input-error" class="input-error-message mt-1" hidden></p>
                                    </div>
                                </div>

                                <div class="col-2 mx-auto">
                                    <button style="width: 100%" type="submit" class="btn btn-danger mb-2 mt-0">Iniciar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("components/base_footer"); ?>