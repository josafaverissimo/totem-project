<?php $this->load->view("components/base_head"); ?>

    <div class="wrapper">
        <?php $this->load->view("components/navbar"); ?>

        <?php $this->load->view("components/sidebar"); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tabela de usuários</h1>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Usuário</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <table id="main-table"
                               class="main-table table table-striped table-bordered table-hover display"
                               data-form-link="<?= base_url("user/form"); ?>"
                        >
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
                                <tr data-hash="<?= $user->hash; ?>">
                                    <td><?= $user->id; ?></td>
                                    <td><?= $user->name ?></td>
                                    <td>
                                        <?=
                                        preg_replace(
                                            "/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/",
                                            "$1.$2.$3-$4",
                                            $user->cpf
                                        );
                                        ?>
                                    </td>
                                    <td>
                                        <?=
                                        preg_replace(
                                            "/([0-9]{2})([0-9])([0-9]{4})([0-9]{4})/",
                                            "($1) $2 $3-$4",
                                            $user->cellphone
                                        );
                                        ?>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Deseja realmente deletar esta linha?</h5>
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
                            <th>cpf</th>
                            <th>telefone</th>
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
                            data-action="<?= base_url("user/delete"); ?>"
                            data-hash=""
                            onclick="deleteUser(event.target)"
                    >
                        Sim, apagar
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view("components/base_footer"); ?>