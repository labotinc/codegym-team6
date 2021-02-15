<!DOCTYPE html>
<html lang="ja">

<head>
	<?= $this->Html->charset() ?>
	<title> </title>
	<!-- resetcss読み込み -->
	<?= $this->Html->css('reset') ?>
	<?= $this->Html->css('main') ?>
	<!-- GoogleFont読み込み -->
	<!-- Noto Sans -->


</head>

<body>
	<!-- header表示部分 -->
	<?= $this->element('header1') ?>
	<!-- メインコンテンツ -->
	<div class="container">
		<!-- タイトル -->
		<h2>タイトルを編集してください</h2>　
		<!-- 各ページのタイトルを変数に代入 -->
		<!-- コンテンツ表示枠 -->
		<div class="main">
			<?= $this->fetch('content') ?>
		</div>
	</div>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>

</html>
