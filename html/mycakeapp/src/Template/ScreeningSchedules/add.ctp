<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ScreeningSchedule $screeningSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Screening Schedules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reserved Seats'), ['controller' => 'ReservedSeats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reserved Seat'), ['controller' => 'ReservedSeats', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="screeningSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($screeningSchedule) ?>
    <fieldset>
        <legend><?= __('Add Screening Schedule') ?></legend>
        <?php
        echo $this->Form->control('movie_id', ['options' => $movies]);
        echo $this->Form->control('screening_date');
        echo $this->Form->control('start_time');
        echo $this->Form->control('end_time');
        echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
