<?= $this->Html->css('reservationConfirm.css') ?>
	<?php $this->assign("title", "予約詳細"); ?>
	<?php foreach ($my_reservations as $my_reservation) : ?>
		<?php foreach ($my_reservation->reserved_seats as $reserved_seat): ?>
			<?php echo $this->Html->image('/img/main/' . h($reserved_seat->screening_schedule->movie->slide_image_name)); ?>
			<?= h($reserved_seat->screening_schedule->movie->title); ?>
			<?= h($reserved_seat->screening_schedule->screening_date); ?>
			<?= h($reserved_seat->screening_schedule->start_time); ?>
			<?= h($reserved_seat->screening_schedule->end_time); ?>
			<?= h($reserved_seat->screening_schedule->start_time); ?>
			<?= h($reserved_seat->seat); ?>
			<?= h($my_reservation->payment->ticket->price); ?>
		<?php endforeach; ?>
		<?php endforeach; ?>
