<?= $this->Html->css('Cards/confirm.css') ?>
<div class="content-area">
  <h3>決済情報の登録が完了しました。</h3>
  <div class="btn">
    <a href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'mycredit']) ?>">決済情報一覧へ戻る</a>
  </div>
</div>
