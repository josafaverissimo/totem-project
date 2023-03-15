<script src="<?= base_url("public/assets/adminlte/plugins/jquery/jquery.min.js") ?>"></script>
<script src="<?= base_url("public/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= base_url("public/assets/adminlte/dist/js/adminlte.min.js") ?>"></script>
<script src="<?= base_url("public/assets/js/sidebar.js") ?>"></script>

<?php
if (isset($scripts)) :
    foreach ($scripts as $script) :
        echo '<script src="' . base_url($script) . '"></script>';
    endforeach;
endif;
?>

</body>

</html>