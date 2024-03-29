<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="icon" sizes="32x32" type="image/png" href="<?= base_cdn("public/assets/imgs/logo5_transparente.png"); ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url("public/assets/adminlte/plugins/fontawesome-free/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("public/assets/adminlte/dist/css/adminlte.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("public/assets/css/styles.css") ?>">

    <?php
    if (isset($styles)) :
        foreach ($styles as $style) :
            echo '<link rel="stylesheet" href="' . base_url($style) . '">';
        endforeach;
    endif;
    ?>

    <script>
        const BASE_URL = "<?= base_url(); ?>"
        const PAGE = "<?= $page ?? ""; ?>"
    </script>
</head>

<body class="<?= !empty($bodyClasses) ? $bodyClasses : ""; ?>">