<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="<?= base_url(); ?>">
                <!-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> -->
                TRIMOROGO
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                <?php foreach ($template_menu as $menu) : ?>
                    <?php if (isset($menu['submenu'])) : ?>
                        <li class="nav-item <?= str_contains($menu['title'], $page_pretitle) ? "active" : ""; ?> dropdown">
                            <a class="nav-link dropdown-toggle <?= str_contains($menu['title'], $page_pretitle) ? "show" : ""; ?>" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="<?= $menu['icon']; ?>"></i>
                                </span>
                                <span class="nav-link-title">
                                    <?= $menu['title']; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu <?= str_contains($menu['title'], $page_pretitle) ? "show" : ""; ?>">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <?php foreach ($menu['submenu'] as $sm) : ?>
                                            <a class="dropdown-item" href="<?= base_url($sm['url']); ?>">
                                                <?= $sm['title']; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= get_called_class(); ?>" href="<?= base_url($menu['url']); ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="<?= $menu['icon']; ?>"></i>
                                </span>
                                <span class="nav-link-title">
                                    <?= $menu['title']; ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("auth/logout"); ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
            <div class="mt-auto m-2 d-flex flex-row">
                <div class="d-flex me-2">
                    <img src="<?= base_url('assets/img/missing.png'); ?>" alt="Profile" class="img-fluid rounded-circle" style="width: 40px;">
                </div>
                <div class="d-flex flex-column items-align-center">
                    <span><?= $user_template->full_name; ?></span>
                    <span><?= $user_template->email; ?></span>
                </div>
            </div>
        </div>
    </div>
</aside>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <?= $page_pretitle ?? "Pre Title"; ?>
                    </div>
                    <h2 class="page-title">
                        <?= $page_title ?? "Page Title"; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <?= $this->session->flashdata('message'); ?>