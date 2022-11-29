<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url("public/assets/adminlte/dist/css/adminlte.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("") ?>">
    <title>Register</title>

</head>
<body>
    <div class="div container">
        <div class="row mt-3">
            <div class="div col-md-4 offset-4">
                    <h4>Cadastro</h4>
                    <hr>
                    <form action="<?= base_url('Register'); ?>" class="form mb-3" method="post">
                        
                            <div class="div form-group mb-3">
                                <label for="">E-mail</label>
                                <input type="text" class="form-control" name="email" placeholder="Digite o email">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'email') : '' ?>
                                </span>
                            </div>
                            <div class="div form-group mb-3">
                                <label for="">Nome</label>
                                <input type="text" class="form-control" name="nome" placeholder="Digite seu nome">
                            </div>
                            <div class="div form-group mb-3">
                                <label for="">Senha</label>
                                <input type="password" class="form-control" name="pass" placeholder="*******">
                            </div>
                            <div class="div form-group mb-3">
                                <label for="">Digite a senha novamente</label>
                                <input type="password" class="form-control" name="confitPass" placeholder="*******">
                            </div>
                            <div class="div form-group mb-3">
                                <input type="submit" class="btn btn-info" value="Enviar">    
                            </div>
                    </form>
                    <a href="<?= site_url('login'); ?>">Já tenho usuario</a>
            </div>
        </div>
    </div>
    
    <script src="<?= base_url("public/assets/adminlte/plugins/bootstrap/js/bootstrap.min.js") ?>"></script>
</body>
</html>

