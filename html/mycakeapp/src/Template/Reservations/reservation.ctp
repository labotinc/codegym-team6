<?= $this->Html->css('tickettype.css') ?>
<?php $this->assign("title", "予約確認"); ?>
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
		<div class="back"><a href="<?= $this->Url->build(['action' => 'selectticket']) ?>">戻る</a></div>
		<?php if ($cardcount  >= 1) : ?>
			<div class="next"><a href="<?= $this->Url->build(['controller' => 'payments', 'action' => 'payment']) ?>">決済へ</a></div>
		<?php else : ?>
			<div class="next"><a href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'credit']) ?>">決済へ</a></div>
		<?php endif; ?>
	</div>
	<?= $this->Form->end() ?>
