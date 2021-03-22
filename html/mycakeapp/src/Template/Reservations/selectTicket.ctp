<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "チケット種別"); ?>
<?php
//データの読み込み
$title = $movie->toArray()[0]->title;
$date = $screening_schedules->toArray()[0]->screening_date;
$start_time = $screening_schedules->toArray()[0]->start_time;
$end_time = $screening_schedules->toArray()[0]->end_time;
$seat = $reserved_seats->toArray()[0]->seat;
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
				<?php echo $this->Form->control('ticket_id', array(
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
