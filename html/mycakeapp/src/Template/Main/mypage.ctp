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
				<!-- 現状は遷移先なし。遷移先の実装(予約詳細)が完了したら、遷移先を変更 -->
				<a class="button" href="#">詳細</a>
				<!-- 下記は、オークションサイト作成時の遷移を行う記述。遷移先変を予約詳細に変更する時の参考用。変更できたら削除 -->
				<!-- <a href="<?= $this->Url->build(['action' => 'index', $biditem->id]) ?>">《入札する！》</a> -->
			</td>
		</tr>
		<tr>
			<td>決済情報</td>
			<td class="right">
				<!-- 現状は遷移先なし。遷移先の実装(決済情報一覧)が完了したら、遷移先を変更 -->
				<a class="button" href="<?= $this->Url->build(['controller' => 'Cards', 'action' => 'mycredit']) ?>">変更</a>
			</td>
		</tr>
	</table>
	<!-- 現状は遷移先なし。遷移先の実装(アカウント削除画面)をしたら、遷移先を変更。アカウント削除画面を作るかは要相談 -->
	<a class="account-delete" href="#">アカウントを削除</a>
</article>
