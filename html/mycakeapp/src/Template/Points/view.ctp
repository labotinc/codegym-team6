<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Point $point
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Point'), ['action' => 'edit', $point->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Point'), ['action' => 'delete', $point->id], ['confirm' => __('Are you sure you want to delete # {0}?', $point->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Points'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Point'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="points view large-9 medium-8 columns content">
    <h3><?= h($point->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $point->has('user') ? $this->Html->link($point->user->id, ['controller' => 'Users', 'action' => 'view', $point->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($point->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Point') ?></th>
            <td><?= $this->Number->format($point->point) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($point->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($point->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $point->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
