<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet" href="<?= base_url("public/assets/adminlte/dist/css/adminlte.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("public/assets/css/login.css") ?>">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form id="main-form">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h5 class="card-title text-center">Login</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="password">Senha</label>
                                    <input id="password" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url("public/assets/adminlte/plugins/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/adminlte/plugins/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("public/assets/js/login.js") ?>"></script>
</body>

</html>