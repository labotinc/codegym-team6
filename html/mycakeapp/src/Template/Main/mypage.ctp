<?= $this->Html->css('mypage') ?>
<?php $this->assign("title", "マイページ"); ?>
<article>
	<table>
		<tr>
			<td>ポイント</td>
			<td class="right">**** p</td>
		</tr>
		<tr>
			<td>予約確認</td>
			<td class="right">
				<a class="button"href="<?= $this->Url->build(['controller' => 'Main', 'action' => 'reservationConfirm']) ?>">変更</a>
			</td>
		</tr>
		<tr>
			<td>決済情報</td>
			<td class="right">
				<a class="button" href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'mycredit']) ?>">変更</a>
			</td>
		</tr>
	</table>
	<!-- 現状は遷移先なし。遷移先の実装(アカウント削除画面)をしたら、遷移先を変更。アカウント削除画面を作るかは要相談 -->
	<a class="account-delete" href="#">アカウントを削除</a>
</article>
