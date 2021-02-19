<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxes'), ['controller' => 'Taxes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tax'), ['controller' => 'Taxes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards'), ['controller' => 'Cards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['controller' => 'Cards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tickets'), ['controller' => 'Tickets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Discounts'), ['controller' => 'Discounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="payments view large-9 medium-8 columns content">
    <h3><?= h($payment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reservation') ?></th>
            <td><?= $payment->has('reservation') ? $this->Html->link($payment->reservation->id, ['controller' => 'Reservations', 'action' => 'view', $payment->reservation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax') ?></th>
            <td><?= $payment->has('tax') ? $this->Html->link($payment->tax->id, ['controller' => 'Taxes', 'action' => 'view', $payment->tax->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Card') ?></th>
            <td><?= $payment->has('card') ? $this->Html->link($payment->card->name, ['controller' => 'Cards', 'action' => 'view', $payment->card->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ticket') ?></th>
            <td><?= $payment->has('ticket') ? $this->Html->link($payment->ticket->id, ['controller' => 'Tickets', 'action' => 'view', $payment->ticket->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount') ?></th>
            <td><?= $payment->has('discount') ? $this->Html->link($payment->discount->name, ['controller' => 'Discounts', 'action' => 'view', $payment->discount->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($payment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Payments') ?></th>
            <td><?= $this->Number->format($payment->total_payments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($payment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($payment->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Paid') ?></th>
            <td><?= $payment->is_paid ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $payment->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
