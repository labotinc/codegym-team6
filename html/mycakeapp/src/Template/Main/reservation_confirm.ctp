<?= $this->Html->css('reservationConfirm.css') ?>
	<?php $this->assign("title", "予約詳細"); ?>
	<?php foreach ($my_reservations as $my_reservation) : ?>
		<?php foreach ($my_reservation->reserved_seats as $reserved_seat): ?>
			<section class="my-reservation">
				<?php echo $this->Html->image('/img/main/' . h($reserved_seat->screening_schedule->movie->slide_image_name)); ?>
				<div class="reservation-detail">
					<h3><?= h($reserved_seat->screening_schedule->movie->title); ?></h3>
					<div class="schedule-seat">
						<?= h($reserved_seat->screening_schedule->screening_date); ?>
						<?= h($reserved_seat->screening_schedule->start_time); ?>
						<?= h($reserved_seat->screening_schedule->end_time); ?>
						<?= h($reserved_seat->seat); ?>
					</div>
					<?= h($my_reservation->payment->ticket->price); ?>
				</div>
			</section>
		<?php endforeach; ?>
		<?php endforeach; ?>
