<!DOCTYPE html>
<html lang="ja">
<head>
	<?= $this->Html->charset() ?>
	<title>QUEL CINEMAS</title>
	<!-- resetcss読み込み -->
	<?= $this->Html->css('reset') ?>
	<?= $this->Html->css('top') ?>
	<!-- GoogleFont読み込み -->
	<!-- Noto Sans -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header表示部分 -->
	<?= $this->element('header') ?>
	<!-- メインコンテンツ -->
	<main class="container">
		<article>
			<section class="top">
				<div class="top-image"><?php echo $this->Html->image('/img/main/' . h($movie[0]["slide_image_name"])); ?></div>
			</section>
			<section class="middle">
				<h2>上映映画一覧</h2>
				<ul class="middle-flex-box">
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[1]["slide_image_name"])); ?></li>
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[2]["slide_image_name"])); ?></li>
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[3]["slide_image_name"])); ?></li>
				</ul>
				<a class="button" href="#">詳しく見る</a>
			</section>
			<section class="bottom">
				<h2>お得な割引</h2>
				<ul class="bottom-flex-box">
					<li class="bottom-image"><img src="/img/main/discount1.png"></li>
					<li class="bottom-image"><img src="/img/main/discount2.png"></li>
					<li class="bottom-image"><img src="/img/main/discount3.png"></li>
					<li class="bottom-image"><img src="/img/main/discount4.png"></li>
				</ul>
				<a class="button" href="#">詳しく見る</a>
			</section>
		</article>
	</main>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>

</html>
