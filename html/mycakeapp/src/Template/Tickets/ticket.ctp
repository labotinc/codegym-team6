<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "チケット種別"); ?>
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
  <div class="reservation">
    <div class="title"><?= $title; ?></div>
    <div class="schedules">
      <span><?= date('m', strtotime($date)) ?></span>月
      <span><?= date('d', strtotime($date)) ?></span>日（<span><?= $week_name[date('w', strtotime($date))] ?></span>）
      <span><?= date('G:i', strtotime($start_time)) ?></span> 〜
      <span><?= date('G:i', strtotime($end_time)) ?></span>
    </div>
    <div class="seat">座席：<?= $seat ?></div>
  </div>
  <?= $this->Form->create($tickets, array('novalidate' => true)); ?>
  <div class="ticket">
    <?php foreach ($tickets as $ticket) : ?>
      <div class="ticket-area">
        <?php echo $this->Form->control('ticket', array(
          'hiddenField' => false,
          'label' => false,
          "type" => "radio",
          'options' => array(
            $ticket['id'] => $ticket['type'],
          )
        )); ?>
        <div><?= number_format(h($ticket->price)) ?>円</div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="under-area">
    <div class="back"><a href="#">戻る</a></div>
    <?php echo $this->Form->button('次へ', ['label' => false, 'type' => 'submit']); ?>
  </div>
  <?= $this->Form->end() ?>
  <?php if (isset($error)) : ?>
    <div class="error">チケットを選択してください</div>
  <?php endif; ?>
