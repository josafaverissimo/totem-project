<script src="<?= base_url("public/assets/adminlte/plugins/jquery/jquery.min.js") ?>"></script>
<script src="<?= base_url("public/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= base_url("public/assets/adminlte/dist/js/adminlte.min.js") ?>"></script>

<?php foreach ($scripts as $script) : ?>
    <script src="<?= base_url($script); ?>"></script>
<?php endforeach; ?>

</body>

</html>