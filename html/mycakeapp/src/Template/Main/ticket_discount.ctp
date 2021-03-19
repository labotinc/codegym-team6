<!DOCTYPE html>
<html lang="ja">
<head>
	<?= $this->Html->charset() ?>
	<title>QUEL CINEMAS</title>
	<!-- resetcss読み込み -->
	<?= $this->Html->css('reset') ?>
	<?= $this->Html->css('ticketDiscount') ?>
	<!-- GoogleFont読み込み -->
	<!-- Noto Sans -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header表示部分 -->
	<?= $this->element('header') ?>
	<!-- メインコンテンツ -->
	<main>
		<div class="container">
			<!-- コンテンツ表示枠 -->
			<div class="main">
				<article class="table">
					<h3>基本料金</h3>
					<table>
						<?php foreach ($tickets as $ticket) : ?>
							<tr class="ticket">
								<td><?= h($ticket->type) ?></td>
								<td class="number"><?= number_format(h($ticket->price)) ?>円</td>
							</tr>
						<?php endforeach; ?>
					</table>
					<h3>お得な割引サービス</h3>
					<table>
						<?php foreach ($discounts as $discount) : ?>
							<tr>
								<td class="discount">
									<p class="discount-name"><?= h($discount->name) ?></p>
									<p class="discription"><?= h($discount->discription) ?></p>
								</td>
								<td class="number amount"><?= number_format(h($discount->amount)) ?>円</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</article>
			</div>
		</div>
	</main>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>
</html>
