<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $this->Html->charset() ?>
    <title>QUEL CINEMAS</title>
    <!-- resetcss読み込み -->
    <?= $this->Html->css('reset') ?>
    <?= $this->Html->css('screenschedule') ?>
    <!-- GoogleFont読み込み -->
    <!-- Noto Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreeningSchedule[]|\Cake\Collection\CollectionInterface $screeningSchedules
 */
?>
<?= $this->layout = false; ?>
<?= $this->element('header') ?>

    <div class="screeningSchedules index large-9 medium-8 columns content">
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('movie_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('date') ?></th>
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
                        <td><?= h($screeningSchedule->date) ?></td>
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
    <?= $this->element('footer') ?>
