<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title><?= esc($title ?? 'CI4 App') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <div class="page">
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <a class="navbar-brand" href="<?= base_url('/') ?>">
                    <?= lang('essentials.header_title') ?>
                </a>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="container-xl py-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <div id="toastContainer"
        class="toast-container position-fixed top-0 end-0 p-3"
        style="z-index:1080">
    </div>
</body>
</html>