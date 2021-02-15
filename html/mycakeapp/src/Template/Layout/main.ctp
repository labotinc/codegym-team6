<!DOCTYPE html>
<html lang="ja">

<head>
	<?= $this->Html->charset() ?>
	<!-- resetcss -->
	<?= $this->Html->css('reset') ?>
	<?= $this->Html->css('main') ?>

</head>

<body>
	<!-- header表示部分 -->
	<?= $this->element('header1') ?>
	<!-- メインコンテンツ -->
	<?= $this->element('main',['title' => 'TITLE']) ?>
	<!-- footer表示部分 -->
	<?= $this->element('footer') ?>
</body>

</html>
