<?= $this->Html->css('Users/signup.css') ?>
    <?php $this->assign("title", "会員登録"); ?>
    <div class="content-area">
		<?= $this->Form->create($user, array('novalidate' => true)); ?>
		<div class="signup-form">
			<?php echo $this->Form->email('email', ['label' => false, 'placeholder' => 'メールアドレス']); ?>
			<?php echo $this->Form->error('email'); ?>
		</div>
		<div class="signup-form">
			<?php echo $this->Form->password('password', ['label' => false, 'placeholder' => 'パスワード']); ?>
			<?php echo $this->Form->error('password'); ?>
		</div>
		<div class="signup-form">
			<?php echo $this->Form->password('password_confirm', ['label' => false, 'placeholder' => 'パスワード（確認用）']); ?>
			<?php echo $this->Form->error('password_confirm'); ?>
		</div>
		<?php echo $this->Form->submit('会員登録', ['label' => false]); ?>
		<?= $this->Form->end() ?>
	</div>
