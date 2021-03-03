<!DOCTYPE html>
<html lang="ja">

<head>
	<?= $this->Html->charset() ?>
	<title>QUEL CINEMAS</title>
	<!-- resetcss読み込み -->
	<?= $this->Html->css('reset') ?>
	<?= $this->Html->css('main') ?>
	<!-- GoogleFont読み込み -->
	<!-- Noto Sans -->
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
	<!-- FontAwesomeを読み込み -->
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>

<body>
	<!-- header表示部分 -->
	<?= $this->element('header') ?>
	<!-- メインコンテンツ -->
	<main>
		<div class="container">
			<!-- タイトル -->
			<h2 class="main-title"><?= $this->fetch('title') ?></h2>
			<!-- 各ページのタイトルを変数に代入 -->
			<!-- コンテンツ表示枠 -->
			<div class="main">
				<?= $this->fetch('content') ?>
			</div>
		</div>
	</main>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>

</html>
