<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= lang('admin/dashboard.dashboard') ?></h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <a href="<?= route_to('logout') ?>" class="btn btn-outline-danger">
                <?= lang('admin/dashboard.logout') ?>
            </a>
        </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row row-cards">
            <div class="col-md-4">
                <a href="<?= route_to('admin.patients') ?>" class="card card-link">
                    <div class="card-body">
                        <h3 class="card-title"><?= lang('admin/patients.patients') ?></h3>
                        <p class="text-muted">
                            <?= lang('admin/patients.patients_manage') ?>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>