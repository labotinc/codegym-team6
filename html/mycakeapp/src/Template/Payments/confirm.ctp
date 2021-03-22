<?= $this->Html->css('Users/confirm.css') ?>
<div class="content-area">
	<h3>予約完了</h3>
	<p>決済が完了しました。</p>
	<div class="btn">
		<?= $this->Html->link("マイページに戻る", ['controller' => 'Main', 'action' => 'mypage']) ?>
	</div>
</div>
