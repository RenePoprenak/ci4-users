<div class="row g-3">

  <div class="col-md-6">
    <div class="text-muted"><?= esc(lang('patients.name')) ?></div>
    <div class="fw-bold">
      <?= esc(($patient['last_name'] ?? '') . ' ' . ($patient['first_name'] ?? '')) ?>
    </div>
  </div>

  <div class="col-md-6">
    <div class="text-muted"><?= esc(lang('patients.birth_number')) ?></div>
    <div class="fw-bold"><?= esc($patient['birth_number'] ?? '') ?></div>
  </div>

  <div class="col-md-6">
    <div class="text-muted"><?= esc(lang('patients.phone')) ?></div>
    <div><?= esc($patient['phone'] ?? '') ?></div>
  </div>

  <div class="col-md-6">
    <div class="text-muted"><?= esc(lang('patients.email')) ?></div>
    <div><?= esc($patient['email'] ?? '') ?></div>
  </div>

  <div class="col-12">
    <div class="text-muted"><?= esc(lang('patients.address')) ?></div>
    <div>
      <?= esc($patient['address_line1'] ?? '') ?><br>
      <?php if (!empty($patient['address_line2'])): ?>
        <?= esc($patient['address_line2']) ?><br>
      <?php endif; ?>
      <?= esc($patient['zip'] ?? '') ?> <?= esc($patient['city'] ?? '') ?>
    </div>
  </div>

  <?php if (!empty($patient['note'] ?? null)): ?>
    <div class="col-12">
      <div class="text-muted"><?= esc(lang('patients.note')) ?></div>
      <div><?= esc($patient['note']) ?></div>
    </div>
  <?php endif; ?>

</div>