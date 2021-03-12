<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "チケット種別"); ?>
<div class="wrapper">
  <div class="reservation">
    <div class="title">タイトルタイトル</div>
    <div class="schedules">
      <span class="month">00</span>月
      <span class="date">00</span>日（<span class="day">月</span>）
      <span class="start">00:00</span>〜
      <span class="end">00:00</span>
    </div>
    <div class="seat">座席：<span>A-1</span></div>
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
