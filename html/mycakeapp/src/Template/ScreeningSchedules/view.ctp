<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreeningSchedule $screeningSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Screening Schedule'), ['action' => 'edit', $screeningSchedule->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Screening Schedule'), ['action' => 'delete', $screeningSchedule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $screeningSchedule->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reserved Seats'), ['controller' => 'ReservedSeats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reserved Seat'), ['controller' => 'ReservedSeats', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="screeningSchedules view large-9 medium-8 columns content">
    <h3><?= h($screeningSchedule->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Movie') ?></th>
            <td><?= $screeningSchedule->has('movie') ? $this->Html->link($screeningSchedule->movie->title, ['controller' => 'Movies', 'action' => 'view', $screeningSchedule->movie->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($screeningSchedule->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screening Date') ?></th>
            <td><?= h($screeningSchedule->screening_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($screeningSchedule->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Time') ?></th>
            <td><?= h($screeningSchedule->end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($screeningSchedule->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($screeningSchedule->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $screeningSchedule->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reserved Seats') ?></h4>
        <?php if (!empty($screeningSchedule->reserved_seats)) : ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Reservation Id') ?></th>
                    <th scope="col"><?= __('Screening Schedule Id') ?></th>
                    <th scope="col"><?= __('Seat') ?></th>
                    <th scope="col"><?= __('Is Deleted') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($screeningSchedule->reserved_seats as $reservedSeats) : ?>
                    <tr>
                        <td><?= h($reservedSeats->id) ?></td>
                        <td><?= h($reservedSeats->reservation_id) ?></td>
                        <td><?= h($reservedSeats->screening_schedule_id) ?></td>
                        <td><?= h($reservedSeats->seat) ?></td>
                        <td><?= h($reservedSeats->is_deleted) ?></td>
                        <td><?= h($reservedSeats->created) ?></td>
                        <td><?= h($reservedSeats->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'ReservedSeats', 'action' => 'view', $reservedSeats->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'ReservedSeats', 'action' => 'edit', $reservedSeats->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReservedSeats', 'action' => 'delete', $reservedSeats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservedSeats->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
