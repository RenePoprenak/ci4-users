<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4"><?= lang('Auth.loginTitle') ?></h2>

                <?php if ($error = session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= route_to('login') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label"><?= lang('Auth.email') ?></label>
                    <input name="email" type="email" class="form-control" placeholder="<?= lang('Auth.emailPlaceholder') ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label"><?= lang('Auth.password') ?></label>
                    <input name="password" type="password" class="form-control" placeholder="<?= lang('Auth.passwordPlaceholder') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="1">
                        <span class="form-check-label">
                            <?= lang('Auth.rememberMe') ?>
                        </span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                    <?= lang('Auth.login') ?>
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>