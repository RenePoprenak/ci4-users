<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<div class="container-xl" x-data="{ modalOpen:false, modalTitle:'' }">

    <div class="page-header d-print-none">
        <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title"><?= esc(lang('patients.title')) ?></h2>
        </div>

        <div class="col-auto ms-auto d-print-none">
            <a href="<?= route_to('admin.patients') ?>" class="btn btn-outline-secondary">
                <?= esc(lang('patients.manage')) ?>
            </a>
        </div>
        </div>
    </div>

    <div class="page-body">
        <div class="card">
        <div class="card-body">
            <div class="mb-3" id="patientSearch">
                <form id="patientSearch"
                    hx-get="<?= route_to('patients.table') ?>"
                    hx-target="#patientsTable"
                    hx-swap="innerHTML"
                    hx-include="this"
                    hx-trigger="keyup changed delay:400ms from:input[name='search'], search from:input[name='search']"
                >
                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="<?= esc(lang('patients.search')) ?>"
                        value="<?= esc($search ?? '') ?>"
                    >
                </form>
            </div>

            <div id="patientsTable"
                hx-get="<?= route_to('patients.table') ?>"
                hx-trigger="load, reload"
                hx-target="this"
                hx-swap="innerHTML"
                hx-include="#patientSearch">
            </div>

        </div>
        </div>
    </div>

    <!-- DETAIL MODAL -->
    <div class="modal modal-blur fade"
        :class="{show: modalOpen}"
        :style="modalOpen ? 'display:block;' : 'display:none;'"
        tabindex="-1" role="dialog" aria-modal="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="modalTitle"></h5>
                <button type="button" class="btn-close" @click="modalOpen=false"></button>
            </div>

            <div class="modal-body" id="patientDetailBody"></div>

        </div>
        </div>
    </div>

    <div class="modal-backdrop fade" :class="{show: modalOpen}" x-show="modalOpen"></div>

</div>

<?= $this->endSection() ?>