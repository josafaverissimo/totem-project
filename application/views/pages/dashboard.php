<?php $this->load->view("components/base_head"); ?>

    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php $this->load->view("components/navbar"); ?>
    <?php $this->load->view("components/sidebar"); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos clientes criados</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem"
                                   data-baseurl-actions="<?= base_url("client") ?>"
                                   data-delete-modal="client-delete-modal"
                            >
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nome</th>
                                    <th>cpf</th>
                                    <th>telefone</th>
                                    <th>cep</th>
                                    <th>estado</th>
                                    <th>cidade</th>
                                    <th>endereço</th>
                                    <th>bairro</th>
                                    <th>número</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($clients)): ?>
                                    <?php foreach ($clients as $client): ?>
                                        <tr data-hash="<?= $client->hash; ?>">
                                            <td>
                                                <?= $client->id; ?>
                                            </td>
                                            <td><?= $client->name ?></td>
                                            <td>
                                                <?=
                                                preg_replace(
                                                    "/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/",
                                                    "$1.$2.$3-$4",
                                                    $client->cpf
                                                );
                                                ?>
                                            </td>
                                            <td>
                                                <?=
                                                preg_replace(
                                                    "/([0-9]{2})([0-9])([0-9]{4})([0-9]{4})/",
                                                    "($1) $2 $3-$4",
                                                    $client->cellphone
                                                );
                                                ?>
                                            </td>
                                            <td><?= $client->cep ?></td>
                                            <td><?= $client->state ?></td>
                                            <td><?= $client->city ?></td>
                                            <td><?= $client->address ?></td>
                                            <td><?= $client->neighborhood ?></td>
                                            <td><?= $client->number ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="10">
                                            Nenhum dado na tabela
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Útimos eventos criados</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem"
                                   data-baseurl-actions="<?= base_url("event") ?>"
                                   data-delete-modal="event-delete-modal"
                            >
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nome</th>
                                    <th>categoria</th>
                                    <th>ativo</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($events)): ?>
                                    <?php foreach ($events as $event) : ?>
                                        <tr data-hash="<?= $event->hash; ?>">
                                            <td><?= $event->id; ?></td>
                                            <td><?= $event->name ?></td>
                                            <td><?= $event->type ?></td>
                                            <td><?= $event->active ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            Nenhum dado na tabela
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos usuários criados</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem"
                                   data-baseurl-actions="<?= base_url("user") ?>"
                                   data-delete-modal="user-delete-modal"
                            >
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">nome</th>
                                    <th scope="col">cpf</th>
                                    <th scope="col">telefone</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr data-hash="<?= $user->hash; ?>">
                                            <td><?= $user->id; ?></td>
                                            <td><?= $user->name; ?></td>
                                            <td><?= formatCpf($user->cpf); ?></td>
                                            <td><?= formatCellphone($user->cellphone); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            Nenhum dado na tabela
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="table-actions-wrapper" hidden data-hash="">
    <div class="table-actions-content">
        <ul class="menu">
            <li class="item edit">
                <span><i class="fas fa-edit"></i> Editar</span>
            </li>
            <li class="item delete">
                <span><i class="fas fa-trash"></i> Deletar</span>
            </li>
        </ul>
    </div>
</div>

<!-- Client Modal Delete -->
<div class="modal fade" id="client-delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deseja realmente deletar esta linha da tabela de Clientes?</h5>
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
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="delete-modal-row" data-cols="0,1,2"></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" data-action="" data-hash=""
                        onclick="deleteRow(event.target)"
                >
                    Sim, apagar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Event Modal Delete -->
<div class="modal fade" id="event-delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deseja realmente deletar esta linha da tabela de Eventos?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>categoria</th>
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
                <button type="button" class="btn btn-danger" data-action="" data-hash=""
                        onclick="deleteRow(event.target)"
                >
                    Sim, apagar
                </button>
            </div>
        </div>
    </div>
</div>

<!--User modal Delete-->
<div class="modal fade" id="user-delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deseja realmente deletar esta linha da tabela de
                    Usuários?</h5>
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