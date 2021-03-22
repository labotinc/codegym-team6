<?= $this->Html->css('payment.css') ?>
<?php $this->assign("title", "決済概要"); ?>
<div class="payments">
	<div class="list">
		<div class="summary">
			<div class="item">
				<div>チケット金額(税抜)</div>
				<div>&yen<?= number_format($price)  ?></div>
			</div>
			<div class="item point">
				<div>ご利用ポイント</div>
				<div>pt</div>
			</div>
			<div class="underline"></div>
			<div class="item">
				<div>小計</div>
				<!-- 利用ポイントの計算は現時点ではしない -->
				<div>&yen<?= number_format($price) ?></div>
			</div>
			<div class="item">
				<div>消費税</div>
				<div>&yen<?= number_format($sales_tax) ?></div>
			</div>
			<div class="underline"></div>
			<div class="item">
				<div>合計(税込)</div>
				<div>&yen<?= number_format($total) ?></div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->create(null, array('novalidate' => true)); ?>
<div class="under-area-summary">
	<div class="back"><a href="<?= $this->Url->build(['action' => 'payment']) ?>">戻る</a></div>
	<?php echo $this->Form->button('決済する', ['label' => false, 'type' => 'submit']); ?>
</div>
<?= $this->Form->end() ?>
