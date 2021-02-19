<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservedSeat[]|\Cake\Collection\CollectionInterface $reservedSeats
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reserved Seat'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['controller' => 'ScreeningSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['controller' => 'ScreeningSchedules', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservedSeats index large-9 medium-8 columns content">
    <h3><?= __('Reserved Seats') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reservation_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('screening_schedule_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservedSeats as $reservedSeat): ?>
            <tr>
                <td><?= $this->Number->format($reservedSeat->id) ?></td>
                <td><?= $reservedSeat->has('reservation') ? $this->Html->link($reservedSeat->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $reservedSeat->reservation->id]) : '' ?></td>
                <td><?= $reservedSeat->has('screening_schedule') ? $this->Html->link($reservedSeat->screening_schedule->id, ['controller' => 'ScreeningSchedules', 'action' => 'view', $reservedSeat->screening_schedule->id]) : '' ?></td>
                <td><?= h($reservedSeat->seat) ?></td>
                <td><?= h($reservedSeat->is_deleted) ?></td>
                <td><?= h($reservedSeat->created) ?></td>
                <td><?= h($reservedSeat->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reservedSeat->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservedSeat->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservedSeat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservedSeat->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
