<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "予約確認"); ?>
<div class="wrapper">
  <div class="reservation-list">
    <div class="title">タイトルタイトル</div>
    <div class="schedules">
      <span class="month">00</span>月
      <span class="date">00</span>日（<span class="day">月</span>）
      <span class="start">00:00</span>〜
      <span class="end">00:00</span>
    </div>
    <div class="seat">座席：<span>A-1</span></div>
    <div class="seat">種別：<span>一般</span></div>
    <div class="seat">金額：<span>0000</span>円</div>
  </div>


  <?= $this->Form->create(null, array('novalidate' => true)); ?>
  <div class="under-area">
    <div class="back"><a href="#">戻る</a></div>
    <?php echo $this->Form->button('決済へ', ['label' => false, 'type' => 'submit']); ?>

  </div>
  <?= $this->Form->end() ?>
