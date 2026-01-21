<div class="table-responsive">
    <table class="table table-vcenter">
        <thead>
            <tr>
                <th><?= esc(lang('patients.name')) ?></th>
                <th><?= esc(lang('patients.birth_number')) ?></th>
                <th><?= esc(lang('patients.phone')) ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= esc(($patient['last_name'] ?? '') . ' ' . ($patient['first_name'] ?? '')) ?></td>
            <td><?= esc($patient['birth_number'] ?? '') ?></td>
            <td><?= esc($patient['phone'] ?? '') ?></td>
            <td class="text-end">

            <button class="btn btn-sm btn-outline-primary"
                    type="button"
                    @click="modalTitle='<?= esc(
                        lang('patients.detail_title', [
                            'name' => ($patient['last_name'] ?? '') . ' ' . ($patient['first_name'] ?? '')
                        ]),
                        'js'
                    ) ?>'; modalOpen=true"
                    hx-get="<?= route_to('patients.detail', (int)$patient['id']) ?>"
                    hx-target="#patientDetailBody"
                    hx-swap="innerHTML">

                <?= esc(lang('patients.detail')) ?>
            </button>

            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?php if (isset($pager)): ?>
    <div class="mt-3">
        <?= $pager->links() ?>
    </div>
<?php endif; ?>