<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="<?= base_url("/dashboard"); ?>" class="bd-b my-3 pb-3 flex flex-cdir flex-icent" style="width: 100%">
        <img src="<?= base_url("public/assets/imgs/LOGO-02.png"); ?>" style="width: 125px; height: 125px;" class="brand-image img-circle elevation-3" alt="Relive Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a id="dashboard-nav-link" href="<?= base_url("dashboard"); ?>" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="user-nav-link" href="#" class="nav-link">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>
                            Usuários
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="user-nav-link-table" href="<?= base_url("user"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon nav-icon"></i>
                                <p>Tabela</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="user-nav-link-form" href="<?= base_url("user/form"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Formulário</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a id="client-nav-link" href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            Clientes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="client-nav-link-table" href="<?= base_url("client"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabela</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="client-nav-link-form" href="<?= base_url("client/form"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Formulário</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a id="event-nav-link" href="#" class="nav-link">
                        <i class="fas fa-calendar nav-icon"></i>
                        <p>
                            Eventos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="event-nav-link-table" href="<?= base_url("event"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabela</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="event-nav-link-form" href="<?= base_url("event/form"); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Formulário</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="event-category-nav-link" href="#" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>
                                    Categorias
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a id="event-category-nav-link-table" href="<?= base_url("event/category"); ?>" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Tabela</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="event-category-nav-link-form" href="<?= base_url("event/category/form"); ?>" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Formulário</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>