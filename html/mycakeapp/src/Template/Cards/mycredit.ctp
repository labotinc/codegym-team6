<?= $this->Html->css('Cards/credit.css') ?>
<?php $this->assign("title", "決済情報"); ?>
<div class="wrapper">
	<div class="card-countainer">

		<?php foreach ($cards as $card) : ?>
			<?php
			//暗号化したクレジットカード番号を復号
			$decryption_number = openssl_decrypt($card['card_number'], 'aes-256-ecb', 'keykeykey');
			//後ろから4文字を切り取る
			$ext_number = substr($decryption_number, -4);
			?>
			<div class="card-area">
				<div class="card">
					<div class="card-name"><?= h($card->name) ?></div>
					<div class="card-number">
						****-****-****-<span class="number"><?= h($ext_number) ?> </span>- 有効期限(月/年) <span><?= date('m/y',  strtotime($card['expiration_date'])) ?></span>
					</div>
				</div>
				<div class="buttons">
					<div class="buttons-link"><a href="#">編集</a></div>
					<div class="buttons-link"><a href="#">削除</a></div>
				</div>
			</div>
		<?php endforeach; ?>
		<?php if ($cardcount <= 0) : ?>
			<div class="card-area">
				<div class="card">
					<div class="card-name">クレジットカードが登録されていません</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="under-area">
			<div class="mypage-link"><a href="<?= $this->Url->build(['controller' => 'Main', 'action' => 'mypage']) ?>">マイページに戻る</a></div>
			<?php if ($cardcount  <= 1) : ?>
				<div class="Registration"><a href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'credit']) ?>">新規登録</a></div>
			<?php endif; ?>
		</div>
	</div>
</div>
