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
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <table class="main-table table table-striped table-bordered table-hover display">
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
                                <tr class="control">
                                    <td>
                                        <div class="buttons-control" data-hash="<?= $user->hash; ?>">
                                            <span class="edit"><i class="fas fa-edit"></i></span></a>
                                            <span class="delete"><i class="fas fa-trash"></i></span>
                                        </div>
                                        <span class="table-td-text"><?= $user->id; ?></span>
                                    </td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->cpf; ?></td>
                                    <td><?= $user->cellphone; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php $this->load->view("components/base_footer"); ?>