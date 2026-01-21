<?php
/** @var string $message */
/** @var string $type */
?>
<div id="toastContainer" hx-swap-oob="beforeend">
    <?= view('ui/_toast', ['message' => $message, 'type' => $type]) ?>
</div>