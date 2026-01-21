<?php
  $patient = $patient ?? [];
  $errors = $errors ?? [];
?>

<form hx-post="<?= esc($action) ?>" hx-target="#patientModalBody" hx-swap="innerHTML">
    <?php if (($mode ?? '') === 'edit'): ?>
        <input type="hidden" name="id" value="<?= (int)($patient['id'] ?? 0) ?>">
    <?php endif; ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.first_name') ?></label>
            <input name="first_name" class="form-control <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['first_name'] ?? '') ?>">
                <?php if (isset($errors['first_name'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['first_name']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.last_name') ?></label>
            <input name="last_name" class="form-control <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['last_name'] ?? '') ?>">
                <?php if (isset($errors['last_name'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['last_name']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.birth_number') ?></label>
            <input name="birth_number" class="form-control <?= isset($errors['birth_number']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['birth_number'] ?? '') ?>">
                <?php if (isset($errors['birth_number'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['birth_number']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.birth_date') ?></label>
            <input type="date" name="birth_date" class="form-control <?= isset($errors['birth_date']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['birth_date'] ?? '') ?>">
                <?php if (isset($errors['birth_date'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['birth_date']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.email') ?></label>
            <input name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.phone') ?></label>
            <input name="phone" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" value="<?= esc($patient['phone'] ?? '') ?>">
                <?php if (isset($errors['phone'])): ?>
                    <div class="invalid-feedback"><?= esc($errors['phone']) ?></div>
                <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.address_line1') ?></label>
            <input name="address_line1" class="form-control" value="<?= esc($patient['address_line1'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.address_line2') ?></label>
            <input name="address_line2" class="form-control" value="<?= esc($patient['address_line2'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.city') ?></label>
            <input name="city" class="form-control" value="<?= esc($patient['city'] ?? '') ?>">
        </div>

        <div class="col-md-6">
            <label class="form-label"><?= lang('admin/patients.zip') ?></label>
            <input name="zip" class="form-control" value="<?= esc($patient['zip'] ?? '') ?>">
        </div>

        <div class="col-12">
            <label class="form-label"><?= lang('admin/patients.note') ?></label>
            <textarea name="note" class="form-control" rows="3"><?= esc($patient['note'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="button" class="btn" @click="$dispatch('closePatientModal')">
            <?= esc(lang('admin/patients.cancel')) ?>
        </button>
        <button type="submit" class="btn btn-primary">
            <?= esc(lang('admin/patients.save')) ?>
        </button>
    </div>
</form>