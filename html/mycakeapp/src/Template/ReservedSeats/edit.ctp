<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservedSeat $reservedSeat
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reservedSeat->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reservedSeat->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reserved Seats'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['controller' => 'ScreeningSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['controller' => 'ScreeningSchedules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservedSeats form large-9 medium-8 columns content">
    <?= $this->Form->create($reservedSeat) ?>
    <fieldset>
        <legend><?= __('Edit Reserved Seat') ?></legend>
        <?php
            echo $this->Form->control('reservation_id', ['options' => $reservations]);
            echo $this->Form->control('screening_schedule_id', ['options' => $screeningSchedules]);
            echo $this->Form->control('seat');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
