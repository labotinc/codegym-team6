<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "予約確認"); ?>
<?php
//セッションデータの読み込み
$title = $this->Session->read('session.movie.title');
$date = $this->Session->read('session.screening_schedule.screening_date');
$start_time = $this->Session->read('session.screening_schedule.start_time');
$end_time = $this->Session->read('session.screening_schedule.end_time');
$seat = $this->Session->read('session.seats.seat');
//曜日に変換するための配列
$week_name = ['日', '月', '火', '水', '木', '金', '土'];
?>
<div class="wrapper">
  <div class="reservation-list">
    <div class="title"><?= $title; ?></div>
    <div class="schedules">
      <span><?= date('m', strtotime($date)) ?></span>月
      <span><?= date('d', strtotime($date)) ?></span>日（<span><?= $week_name[date('w', strtotime($date))] ?></span>）
      <span><?= date('G:i', strtotime($start_time)) ?></span> 〜
      <span><?= date('G:i', strtotime($end_time)) ?></span>
    </div>
    <div class="seat">座席：<?= $seat ?></div>
    <div class="seat">種別：<span>
        <? echo $tickets->toArray()[0]->type; ?>
      </span></div>
    <div class="seat">割引：<span>なし</span></div>
    <div class="seat">金額：<span>
        <? echo number_format($tickets->toArray()[0]->price); ?>
      </span>円</div>
  </div>

  <?= $this->Form->create(null, array('novalidate' => true)); ?>
  <div class="under-area">
    <div class="back"><a href="<?= $this->Url->build(['action' => 'ticket']) ?>">戻る</a></div>
    <?php echo $this->Form->button('決済へ', ['label' => false, 'type' => 'submit']); ?>
  </div>
  <?= $this->Form->end() ?>
