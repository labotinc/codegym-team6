<?= $this->Html->css('Cards/credit.css') ?>
<?php $this->assign("title", "決済情報"); ?>
<div class="content-area">
	<?= $this->Form->create($card, array('novalidate' => true)); ?>
	<div class="credit-number">
		<div class="credit-number-form">
			<?php echo $this->Form->text('card_number', ['label' => false, 'placeholder' => 'クレジットカード番号']); ?>
		</div>
		<div class="icon"><i class="fab fa-cc-visa fa-fw"></i></div>
		<div class="icon"><i class="fab fa-cc-mastercard"></i></div>
	</div>
	<?php echo $this->Form->error('card_number'); ?>
	<div class="credit-form">
		<?php echo $this->Form->control('name', ['label' => false, 'placeholder' => 'クレジットカード名義']); ?>
	</div>
	<div class="Gemini">
		<div class="Gemini-form">
			<?php echo $this->Form->control('expiration_date', [
				'label' => '有効期限',
				'monthNames' => false,
				'day' => false,
				'year' => false,
			]); ?>
			<?php echo $this->Form->error('expiration_date'); ?>
		</div>
		<div class="Gemini-form2">
			<?php echo $this->Form->control('expiration_date', [
				'label' => false,
				'monthNames' => false,
				'day' => false,
				'month' => false,
				'minYear' => date('Y'),
				'maxYear' => date('Y') + 6,
			]); ?>
		</div>
		<div class="Gemini-form">
			<?php echo $this->Form->control('securitycode', ['type' => 'password', 'label' => false, 'placeholder' => 'セキュリティコード']); ?>
		</div>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->checkbox('terms.check', [
			'id' => 'terms',
			'hiddenField' => false
			]); ?>
		<?php echo $this->Form->label('terms', '利用規約・プライバシーポリシーに同意の上、ご確認ください。'); ?>
	</div>
	<?php echo $this->Form->error('terms'); ?>
	<?php echo $this->Form->submit('登録', ['label' => false]); ?>
	<?= $this->Form->end() ?>
</div>
