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
				<!-- <?php var_dump($movie) ?> -->
				<div class="top-image"><?php echo $this->Html->image('/img/main/' . h($movie[0]["top_image_name"])); ?></div>
			</section>
			<section class="middle">
				<h2>上映映画一覧</h2>
				<ul class="middle-flex-box">
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[1]["top_image_name"])); ?></li>
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[2]["top_image_name"])); ?></li>
					<li class="middle-image"><?php echo $this->Html->image('/img/main/' . h($movie[3]["top_image_name"])); ?></li>
				</ul>
				<a class="button" href="#">詳しく見る</a>
				<!-- 下記は、オークションサイト作成時の遷移を行う記述。遷移先変を映画情報に変更する時の参考用。変更できたら削除 -->
				<!-- <a href="<?= $this->Url->build(['action' => 'index', $biditem->id]) ?>">《入札する！》</a> -->
				<!-- <div class="button">a button will be here man.</div> -->
			</section>
			<section class="bottom">
				<h2>お得な割引</h2>
				<ul class="bottom-flex-box">
					<li class="bottom-image"><?php echo $this->Html->image('/img/main/' . h($movie[4]["top_image_name"])); ?></li>
					<li class="bottom-image"><?php echo $this->Html->image('/img/main/' . h($movie[5]["top_image_name"])); ?></li>
					<li class="bottom-image"><?php echo $this->Html->image('/img/main/' . h($movie[6]["top_image_name"])); ?></li>
					<li class="bottom-image"><?php echo $this->Html->image('/img/main/' . h($movie[7]["top_image_name"])); ?></li>
				</ul>
				<a class="button" href="#">詳しく見る</a>
			</section>
		</article>
	</main>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>

</html>
