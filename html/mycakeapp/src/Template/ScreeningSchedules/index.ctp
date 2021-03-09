<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreeningSchedule[]|\Cake\Collection\CollectionInterface $screeningSchedules
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reserved Seats'), ['controller' => 'ReservedSeats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reserved Seat'), ['controller' => 'ReservedSeats', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="screeningSchedules index large-9 medium-8 columns content">
    <h3><?= __('Screening Schedules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('movie_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('screening_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($screeningSchedules as $screeningSchedule) : ?>
                <tr>
                    <td><?= $this->Number->format($screeningSchedule->id) ?></td>
                    <td><?= $screeningSchedule->has('movie') ? $this->Html->link($screeningSchedule->movie->title, ['controller' => 'Movies', 'action' => 'view', $screeningSchedule->movie->id]) : '' ?></td>
                    <td><?= h($screeningSchedule->screening_date) ?></td>
                    <td><?= h($screeningSchedule->start_time) ?></td>
                    <td><?= h($screeningSchedule->end_time) ?></td>
                    <td><?= h($screeningSchedule->is_deleted) ?></td>
                    <td><?= h($screeningSchedule->created) ?></td>
                    <td><?= h($screeningSchedule->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $screeningSchedule->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $screeningSchedule->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $screeningSchedule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $screeningSchedule->id)]) ?>
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
