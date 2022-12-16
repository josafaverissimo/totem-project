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
                            <h3 class="card-title">Últimos usuários criados</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">nome</th>
                                    <th scope="col">cpf</th>
                                    <th scope="col">telefone</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr data-action="<?= base_url("user/form/{$user->hash}"); ?>">
                                        <td><?= $user->id; ?></td>
                                        <td><?= $user->name; ?></td>
                                        <td><?= formatCpf($user->cpf); ?></td>
                                        <td><?= formatCellphone($user->cellphone); ?></td>
                                    </tr>
                                <?php endforeach; ?>
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
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem">

                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos clientes criados</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" style="font-size: 0.85rem">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
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

<?php $this->load->view("components/base_footer"); ?>