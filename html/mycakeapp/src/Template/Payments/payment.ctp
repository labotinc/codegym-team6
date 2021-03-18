<?= $this->Html->css('payment.css') ?>
<?php $this->assign("title", "決済方法"); ?>

<div class="wrapper">
	<div class="card-container">
		<div class="card-info">ご登録のクレジットカード</div>
		<?= $this->Form->create(null, array('novalidate' => true)); ?>
		<?php foreach ($cards as $card) : ?>
			<?php
			//暗号化したクレジットカード番号を復号
			$decryption_number = openssl_decrypt($card['card_number'], 'aes-256-ecb', 'keykeykey');
			//後ろから4文字を切り取る
			$ext_number = substr($decryption_number, -4);
			//有効期限
			$limit_date = date('m/y', strtotime($card['expiration_date']));
			?>
			<div class="card-area">
				<div class="card">
					<?php echo $this->Form->input('card', array(
						'hiddenField' => false,
						'label' => false,
						"type" => "radio",
						'checked' => "checked",
						'options' => array(
							$card['id'] => $card['name'],
						)
					)); ?>
					<div class="card-number">
						****-****-****-<span class="number"><?= h($ext_number) ?></span> - 有効期限(月/年) <span><?= $limit_date ?></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="under-area">
		<div class="back"><a href="<?= $this->Url->build(['controller' => 'reservations', 'action' => 'reservation']) ?>">戻る</a></div>
		<?php echo $this->Form->button('確認する', ['label' => false, 'type' => 'submit']); ?>
	</div>
	<?= $this->Form->end() ?>
</div>
<?php if (isset($error)) : ?>
	<div class="error">チケットを選択してください</div>
<?php endif; ?>
