<?php $this->load->view("components/base_head"); ?>

    <div class="login-box">
        <div class="mb-2 flex flex-jcent">
            <img src="<?= base_url("public/assets/imgs/LOGO-02.png"); ?>" class="rounded"
                 style="width: 175px; height: 175px;">
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Logue para iniciar uma sessão</p>

                <form id="main-form" action="<?= base_url("login/doLogin"); ?>" novalidate>
                    <div class="mb-3">
                        <div class="input-group">
                            <input id="user" name="user" type="text" class="form-control" placeholder="Usuário"
                                   required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <p id="user-input-error" class="input-error-message mt-1" hidden></p>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input id="password" name="password" type="password" class="form-control"
                                   placeholder="Password"
                                   required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p id="password-input-error" class="input-error-message mt-1" hidden></p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view("components/base_footer"); ?>