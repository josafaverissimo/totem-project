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
                                    echo "Editar usuário";
                                else :
                                    echo "Criar usuário";
                                endif;
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulário</h3>
                    </div>
                    <form id="main-form" action="<?= $formAction ?>" novalidate>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?= $user['name'] ?>" required>
                                <p id="name-input-error" class="input-error-message mt-1" hidden></p>

                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input id="cpf" name="cpf" type="text" class="form-control" value="<?= $user['cpf'] ?>"
                                       required>
                                <p id="cpf-input-error" class="input-error-message mt-1" hidden></p>
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Cellphone</label>
                                <input id="cellphone" name="cellphone" type="text" class="form-control"
                                       value="<?= $user['cellphone'] ?>" required>
                                <p id="cellphone-input-error" class="input-error-message mt-1" hidden></p>
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    <?php
                                    if ($editMode) :
                                        echo "Nova senha";
                                    else :
                                        echo "Senha";
                                    endif;
                                    ?>
                                </label>
                                <input id="password" name="password" type="password" class="form-control" required>
                                <p id="password-input-error" class="input-error-message mt-1" hidden></p>
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