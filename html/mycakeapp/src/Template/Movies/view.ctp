<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie $movie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Movie'), ['action' => 'edit', $movie->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Movie'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Movies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['controller' => 'ScreeningSchedules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Screening Schedule'), ['controller' => 'ScreeningSchedules', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="movies view large-9 medium-8 columns content">
    <h3><?= h($movie->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($movie->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Top Image Name') ?></th>
            <td><?= h($movie->top_image_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slide Image Name') ?></th>
            <td><?= h($movie->slide_image_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($movie->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Running Time') ?></th>
            <td><?= $this->Number->format($movie->running_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($movie->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Release Date') ?></th>
            <td><?= h($movie->release_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($movie->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($movie->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $movie->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Screening Schedules') ?></h4>
        <?php if (!empty($movie->screening_schedules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Movie Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Start Time') ?></th>
                <th scope="col"><?= __('End Time') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($movie->screening_schedules as $screeningSchedules): ?>
            <tr>
                <td><?= h($screeningSchedules->id) ?></td>
                <td><?= h($screeningSchedules->movie_id) ?></td>
                <td><?= h($screeningSchedules->date) ?></td>
                <td><?= h($screeningSchedules->start_time) ?></td>
                <td><?= h($screeningSchedules->end_time) ?></td>
                <td><?= h($screeningSchedules->is_deleted) ?></td>
                <td><?= h($screeningSchedules->created) ?></td>
                <td><?= h($screeningSchedules->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ScreeningSchedules', 'action' => 'view', $screeningSchedules->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ScreeningSchedules', 'action' => 'edit', $screeningSchedules->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ScreeningSchedules', 'action' => 'delete', $screeningSchedules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $screeningSchedules->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
