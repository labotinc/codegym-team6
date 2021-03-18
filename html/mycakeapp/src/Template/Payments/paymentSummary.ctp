<?= $this->Html->css('payment.css') ?>
<?php $this->assign("title", "決済概要"); ?>


<?= $this->Form->create(null, array('novalidate' => true)); ?>
<div class="under-area">
	<div class="back"><a href="<?= $this->Url->build(['action' => 'payment']) ?>">戻る</a></div>
	<?php echo $this->Form->button('決済する', ['label' => false, 'type' => 'submit']); ?>
</div>
<?= $this->Form->end() ?>
