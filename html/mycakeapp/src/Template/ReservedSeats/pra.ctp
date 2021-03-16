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
	<!-- <form action="" method="post"> -->
	<table id="data-table">
		<!-- 英字インデックス -->
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
							'id' => ($i . '.' . $j),
							'name' => 'seatNum[]',
							'value' => ($seatIndex[$j] . '-' . ($i + 1)),
							'class' => 'checkbox',
							'hiddenField' => false
						]);
						echo $this->Form->label('', '', [
							'for' => ($i . '.' . $j),
							'class' => 'label',
						]);
						?>
					</td>
					<!-- valueに席番号🔴.🔴が来るようになっている。valueを取得できてそれをDBに送信できるという仮定のものと実装した。 -->
					<!-- <td><input type="checkbox" class="checkbox" id="<?php echo ($i . '.' . $j) ?>" value="<?php echo ($i . '.' . $j) ?>"><label for="<?php echo ($i . '.' . $j) ?>" class="label"></label></td> -->
				<?php endfor; ?>
			</tr>
		<?php endfor; ?>
	</table>
	<div class="bottom">
		<?php echo $this->Form->button('決定', ['type' => 'submit']); ?>
	</div>
	<!-- <div class="bottom">
		<button type="submit">決定</button>
	</div> -->
	<?= $this->Form->end(); ?>
	<!-- </form> -->
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
	$(".checkbox").on("click", function() {
		$('.checkbox').prop('checked', false); //  全部のチェックを外す
		$(this).prop('checked', true); //  押したやつだけチェックつける
	});
</script>
