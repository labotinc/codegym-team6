<?= $this->Html->css('seatSelect'); ?>
<?php $this->assign("title", "座席指定"); ?>
<section class="table">
	<!-- 左側数字インデックス -->
	<table id="left-table">
		<?php for ($i = 0; $i < 8; $i++) : ?>
			<tr>
				<td><?php echo $i + 1 ?></td>
			</tr>
		<?php endfor; ?>
	</table>
	<?php echo $this->Form->create(); ?>
	<table id="data-table">
		<!-- 上部英字インデックス -->
		<tr>
			<?php for ($i = 0; $i < 11; $i++) : ?>
				<?php $seatIndex = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']; ?>
				<th><?php echo $seatIndex[$i] ?></th>
			<?php endfor; ?>
		</tr>
		<!-- 座席表 -->
		<?php for ($i = 0; $i < 8; $i++) : ?>
			<tr>
				<?php for ($j = 0; $j < 11; $j++) : ?>
					<td>
						<?php
						echo $this->Form->checkbox('', [
							'id' => ($seatIndex[$j] . '-' . ($i + 1)),
							'name' => 'seatNum[]',
							'value' => ($seatIndex[$j] . '-' . ($i + 1)),
							'class' => 'checkbox',
							'hiddenField' => false
						]);
						echo $this->Form->label('', '', [
							'for' => ($seatIndex[$j] . '-' . ($i + 1)),
							'class' => 'label',
						]);
						?>
					</td>
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
	<div class="bottom">
		<?php echo $this->Form->button('決定', ['type' => 'submit']); ?>
	</div>
	<?php if (isset($error)) : ?>
		<div class="error"><?php echo $error; ?></div>
	<?php endif; ?>
	<?= $this->Form->end(); ?>
	<!-- 右側数字インデックス -->
	<table id="right-table">
		<?php for ($i = 0; $i < 8; $i++) : ?>
			<tr>
				<td><?php echo $i + 1 ?></td>
			</tr>
		<?php endfor; ?>
	</table>
</section>
</select>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
	// 選択可能座席数を一つにする（※アロー関数にするとエラーが出るため、一旦function命令で記述します）
	$(".checkbox").on("click", function() {
		$('.checkbox').prop('checked', false); //  全部のチェックを外す
		$(this).prop('checked', true); //  押したやつだけチェックつける
	});

	// 予約済みの座席を選択不可にする
	let already_reserved = JSON.parse('<?= json_encode($already_reserved) ?>'); // jsonで予約済み座席の値取得
	$(function() {
		already_reserved.forEach(function(value) { //foreachで予約済みの座席番号をすべて取り出し
			let seatNumber = value['seat'];
			$(`label[for="${seatNumber}"]`).css('background-color', 'black'); //予約済み座席は色を黒に変更する
			$(`input[id="${seatNumber}"]`).prop('disabled', true); //予約済み座席は選択不可にする
		});
	});
</script>
