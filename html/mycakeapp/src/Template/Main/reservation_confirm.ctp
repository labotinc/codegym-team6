<?= $this->Html->css('reservationConfirm.css') ?>
	<?php $this->assign("title", "予約詳細"); ?>
	<?php $count = 0; ?>
	<?php if($my_reservations): ?>
		<?php foreach ($my_reservations as $my_reservation) : ?>
			<?php foreach ($my_reservation->reserved_seats as $reserved_seat): ?>
				<?php if($now_time < $reserved_seat->screening_schedule->start_time):?>
					<section class="my-reservation">
						<?php echo $this->Html->image('/img/main/' . h($reserved_seat->screening_schedule->movie->slide_image_name)); ?>
						<div class="reservation-detail">
							<h3><?= h($reserved_seat->screening_schedule->movie->title); ?></h3>
							<ul class="schedule-seat">
								<li><?= h($reserved_seat->screening_schedule->screening_date->format('n月d日')), '(', $week[h($reserved_seat->screening_schedule->screening_date->format('w'))],')'; ?></li>
								<li><?= h($reserved_seat->screening_schedule->start_time->format('H:i')), '~', h($reserved_seat->screening_schedule->end_time->format('H:i'));; ?></li>
								<li><?= h($reserved_seat->seat); ?></li>
							</ul>
							<div class="price-discount">
								&yen<?= number_format(h($my_reservation->payment->ticket->price)); ?>
							</div>
						</div>
						<?= $this->Html->link("キャンセル", ['controller' => '', 'action' => '']) ?>
					</section>
				<?php else: ?>
					<?php $count++; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
		<?php if($count > 1): ?>
			<div class="count-check">
				<p>現在予約はありません</p>
			</div>
		<?php endif; ?>
		<div class="btn">
			<?= $this->Html->link("マイページに戻る", ['controller' => 'Main', 'action' => 'mypage']) ?>
		</div>
	<?php else: ?>
		<div class="content-area">
			<p>現在予約はありません</p>
			<div class="btn">
				<?= $this->Html->link("マイページに戻る", ['controller' => 'Main', 'action' => 'mypage']) ?>
			</div>
		</div>
	<?php endif; ?>
