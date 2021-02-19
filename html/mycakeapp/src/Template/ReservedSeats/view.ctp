<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservedSeat $reservedSeat
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reserved Seat'), ['action' => 'edit', $reservedSeat->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reserved Seat'), ['action' => 'delete', $reservedSeat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservedSeat->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reserved Seats'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reserved Seat'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['controller' => 'ScreeningSchedules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['controller' => 'ScreeningSchedules', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reservedSeats view large-9 medium-8 columns content">
    <h3><?= h($reservedSeat->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reservation') ?></th>
            <td><?= $reservedSeat->has('reservation') ? $this->Html->link($reservedSeat->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $reservedSeat->reservation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screening Schedule') ?></th>
            <td><?= $reservedSeat->has('screening_schedule') ? $this->Html->link($reservedSeat->screening_schedule->id, ['controller' => 'ScreeningSchedules', 'action' => 'view', $reservedSeat->screening_schedule->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seat') ?></th>
            <td><?= h($reservedSeat->seat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reservedSeat->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reservedSeat->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($reservedSeat->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $reservedSeat->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
