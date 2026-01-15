<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h2 mb-0">User #<?= esc($user->id) ?></h1>
  <a class="btn btn-outline-secondary" href="<?= route_to('users.index') ?>">Späť</a>
</div>

<div class="card">
  <div class="card-body">
    <dl class="row mb-0">
      <dt class="col-sm-3">ID</dt>
      <dd class="col-sm-9"><?= esc($user->id) ?></dd>

      <dt class="col-sm-3">Username</dt>
      <dd class="col-sm-9"><?= esc($user->username ?? '-') ?></dd>

      <dt class="col-sm-3">Email</dt>
      <dd class="col-sm-9"><?= esc($user->email ?? '-') ?></dd>

      <dt class="col-sm-3">Created</dt>
      <dd class="col-sm-9"><?= esc($user->created_at ?? '-') ?></dd>
    </dl>
  </div>
</div>
<?= $this->endSection() ?>