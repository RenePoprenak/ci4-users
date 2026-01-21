<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<div class="container-xl"
    x-data="patientsUi()"
    @closePatientModal.document="closeModal()">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title"><?= esc($title ?? lang('admin/patients.title')) ?></h2>
      </div>

      <div class="col-auto ms-auto d-print-none d-flex gap-2">
        <button class="btn btn-primary" type="button"
                @click="modalTitle=$el.dataset.title; modalOpen=true"
                data-title="<?= esc(lang('admin/patients.new_patient'), 'js') ?>"
                hx-get="<?= route_to('admin.patients.create') ?>"
                hx-target="#patientModalBody"
                hx-swap="innerHTML">
          <?= esc(lang('admin/patients.new_patient')) ?>
        </button>

        <a href="<?= route_to('admin.dashboard') ?>" class="btn btn-outline-secondary">
          <?= esc(lang('admin/dashboard.back')) ?>
        </a>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="card">
      <div class="card-body">

        <div id="patientsTable"
            hx-get="<?= route_to('admin.patients.table') ?>"
            hx-trigger="load, patientsChanged from:body"
            hx-swap="innerHTML"></div>

      </div>
    </div>
  </div>

  <!-- MODAL -->
  <div class="modal modal-blur fade"
      :class="{show: modalOpen}"
      :style="modalOpen ? 'display:block;' : 'display:none;'"
      tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" x-text="modalTitle"></h5>
          <button type="button" class="btn-close" aria-label="Close" @click="closeModal()"></button>
        </div>

        <div class="modal-body" id="patientModalBody">
          <!-- _form through HTMX -->
        </div>

      </div>
    </div>
  </div>

  <!-- Backdrop -->
  <div class="modal-backdrop fade" :class="{show: modalOpen}" x-show="modalOpen"></div>

</div>

<script>
  function patientsUi() {
    return {
      modalOpen: false,
      modalTitle: '',

      // Run once when Alpine component initializes
      init() {
        if (window.__patientsCloseBound) return;
        window.__patientsCloseBound = true;

        // HTMX triggers CustomEvent on document.body
        document.body.addEventListener('closePatientModal', () => {
          this.closeModal();
        });
      },

      // Close modal and clear its body
      closeModal() {
        this.modalOpen = false;
        const body = document.getElementById('patientModalBody');
        if (body) body.innerHTML = '';
      },
    };
  }
</script>

<?= $this->endSection() ?>