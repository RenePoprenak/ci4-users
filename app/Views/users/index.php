<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h2 mb-0">Users</h1>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th class="text-end">Akcie</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= esc($u['id']) ?></td>
          <td><?= esc($u['username'] ?? '-') ?></td>
          <td><?= esc($u['email'] ?? '-') ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('users/' . $u['id']) ?>">
              Detail
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>