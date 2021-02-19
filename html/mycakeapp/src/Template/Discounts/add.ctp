<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Discount $discount
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Discounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="discounts form large-9 medium-8 columns content">
    <?= $this->Form->create($discount) ?>
    <fieldset>
        <legend><?= __('Add Discount') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('amount');
            echo $this->Form->control('discription');
            echo $this->Form->control('row');
            echo $this->Form->control('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
