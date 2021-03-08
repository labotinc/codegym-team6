<?php $this->layout = 'main'; ?>
<?= $this->Html->css('error.css') ?>
<?php $this->assign("title", "エラー"); ?>
    <h3>予期せぬエラーが発生しました。</h3>
    <div class="btn">
        <?= $this->Html->link("トップページへ戻る", ['controller' => 'Main', 'action' => 'top']) ?>
    </div>
