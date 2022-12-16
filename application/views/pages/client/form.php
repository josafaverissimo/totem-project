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
                <div id="form-card" class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Clientes</h3>
                    </div>
                    <form id="main-form" action="<?= $formAction; ?>" data-wrapper-selector="#form-card" novalidate>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="form-control"
                                       value="<?= $client['name']; ?>" required>
                                <p id="name-input-error" class="input-error-message mt-1" hidden></p>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input id="cpf" name="cpf" type="text" class="form-control"
                                       value="<?= $client['cpf']; ?>" data-mask="000.000.000-00" required>
                                <p id="cpf-input-error" class="input-error-message mt-1" hidden></p>
                            </div>
                            <div class="form-group">
                                <label for="cellphone">Telefone</label>
                                <input id="cellphone" name="cellphone" type="text" class="form-control"
                                       value="<?= $client['cellphone']; ?>" data-mask="(00) 0 0000-0000" required>
                                <p id="cellphone-input-error" class="input-error-message mt-1" hidden></p>
                            </div>

                            <h1 class="h4 border-top py-3 my-2">Endereço</h1>

                            <div class="form-row pb-2">
                                <div class="col">
                                    <label for="cep">Cep</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cep" data-mask="00000-000"
                                               name="cep" required>
                                        <div class="input-group-append">
                                            <button id="search-cep" type="button" class="input-group-text">
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                    <p id="cep-input-error" class="input-error-message mt-1" hidden></p>
                                </div>

                                <div class="col">
                                    <label for="state">Estado</label>
                                    <input id="state" name="state" type="text" class="form-control"
                                           value="" required>
                                    <p id="state-input-error" class="input-error-message mt-1" hidden></p>
                                </div>

                                <div class="col">
                                    <label for="city">Cidade</label>
                                    <input id="city" name="city" type="text" class="form-control" value=""
                                           required>
                                    <p id="city-input-error" class="input-error-message mt-1" hidden></p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-5">
                                    <label for="address">Endereço</label>
                                    <input id="address" name="address" type="text" class="form-control"
                                           value="" required>
                                    <p id="address-input-error" class="input-error-message mt-1" hidden></p>
                                </div>

                                <div class="col-5">
                                    <label for="neighborhood">Bairro</label>
                                    <input id="neighborhood" name="neighborhood" type="text" class="form-control"
                                           value="" required>
                                    <p id="neighborhood-input-error" class="input-error-message mt-1" hidden></p>
                                </div>

                                <div class="col-2">
                                    <label for="number">Número</label>
                                    <input id="number" name="number" type="text" class="form-control" value=""
                                           required>
                                    <p id="number-input-error" class="input-error-message mt-1" hidden></p>
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