<?php
  /**
   * @var string $message
   * @var string $type success|error|info|warning
   */

  $map = [
      'success' => ['bg' => 'bg-green', 'title' => lang('toast.ok')],
      'error'   => ['bg' => 'bg-red',   'title' => lang('toast.error')],
      'info'    => ['bg' => 'bg-blue',  'title' => lang('toast.info')],
      'warning' => ['bg' => 'bg-yellow','title' => lang('toast.warning')],
  ];

  $cfg = $map[$type] ?? $map['info'];
?>

<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true"
    x-data="{ visible: true }"
    x-init="setTimeout(() => visible = false, 3000)"
    x-show="visible"
    x-transition>

  <div class="toast-header">
    <span class="badge me-2 <?= esc($cfg['bg']) ?>"></span>
    <strong class="me-auto"><?= esc($cfg['title']) ?></strong>
    <button type="button" class="btn-close" @click="visible = false"></button>
  </div>

  <div class="toast-body">
    <?= esc($message) ?>
  </div>

</div>