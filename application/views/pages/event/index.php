<?php $this->load->view("components/base_head"); ?>

    <div class="wrapper">
        <?php $this->load->view("components/navbar"); ?>

        <?php $this->load->view("components/sidebar"); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tabela de eventos</h1>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Evento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <table id="main-table" class="main-table table table-striped table-bordered table-hover display"
                               data-form-link="<?= base_url("event/form"); ?>">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>nome</th>
                                <th>categoria</th>
                                <th>ativo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($events as $event) : ?>
                                <tr data-hash="<?= $event->hash; ?>">
                                    <td><?= $event->id; ?></td>
                                    <td><?= $event->name ?></td>
                                    <td><?= $event->category ?></td>
                                    <td style="font-size: 1rem;">
                                        <?php if ($event->active == "F"): ?>
                                            <span class="badge badge-danger">Desabilitado</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Habilitado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php $this->load->view("components/datatables_actions"); ?>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deseja realmente deletar esta linha?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>nome</th>
                            <th>evento</th>
                            <th>ativo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="delete-modal-row"></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button id="delete-button" type="button" class="btn btn-danger"
                            data-action="<?= base_url("event/delete"); ?>" data-hash=""
                            onclick="deleteRow(event.target)">
                        Sim, apagar
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view("components/base_footer"); ?>