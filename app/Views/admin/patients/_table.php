<?php
  /** @var array $patients */
  /** @var \CodeIgniter\Pager\Pager $pager */
?>

<div class="table-responsive">
  <table class="table table-vcenter card-table">
    <thead>
      <tr>
        <th><?= esc(lang('admin/patients.table_name')) ?></th>
        <th><?= esc(lang('admin/patients.table_birth_date')) ?></th>
        <th><?= esc(lang('admin/patients.table_contact')) ?></th>
        <th><?= esc(lang('admin/patients.table_address')) ?></th>
        <th class="w-1"></th>
      </tr>
    </thead>

    <tbody>
      <?php if (empty($patients)): ?>
        <tr>
          <td colspan="5" class="text-muted"><?= esc(lang('admin/patients.table_empty')) ?></td>
        </tr>
      <?php else: ?>
        <?php foreach ($patients as $patient): ?>
          <tr>
            <td>
              <div class="fw-semibold">
                <?= esc($patient['last_name'] ?? '') ?> <?= esc($patient['first_name'] ?? '') ?>
              </div>
              <div class="text-muted">#<?= (int)($patient['id'] ?? 0) ?></div>
            </td>

            <td class="text-muted">
              <?= esc($patient['birth_date'] ?? '') ?>
            </td>

            <td>
              <div><?= esc($patient['email'] ?? '') ?></div>
              <div class="text-muted"><?= esc($patient['phone'] ?? '') ?></div>
            </td>

            <td class="text-muted">
              <?php
                $addr = trim(($patient['address_line1'] ?? '') . ' ' . ($patient['address_line2'] ?? ''));
                $city = trim(($patient['zip'] ?? '') . ' ' . ($patient['city'] ?? ''));
              ?>
              <div><?= esc($addr) ?></div>
              <div><?= esc($city) ?></div>
            </td>

            <td>
              <div class="btn-list flex-nowrap">
                <a href="javascript:void(0)" class="btn btn-sm"
                    @click="modalTitle=$el.dataset.title; modalOpen=true"
                    data-title="<?= esc(lang('admin/patients.edit_title')) ?>"
                    hx-get="<?= route_to('admin.patients.edit', (int)$patient['id']) ?>"
                    hx-target="#patientModalBody"
                    hx-swap="innerHTML">
                  <?= esc(lang('admin/patients.edit')) ?>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
</div>

<?php if ($pager): ?>
  <div class="mt-3"
      hx-boost="true"
      hx-target="#patientsTable"
      hx-swap="innerHTML">
    <?= $pager->links() ?>
  </div>
<?php endif ?>