<?= $this->Html->css('Users/login.css') ?>
    <?php $this->assign("title", "ログイン"); ?>
    <div class="content-area">
		<?= $this->Form->create($user_form, array('novalidate' => true)); ?>
		<div class="login-form">
			<?php echo $this->Form->email('email', ['label' => false, 'placeholder' => 'メールアドレス']); ?>
            <?php echo $this->Form->error('email'); ?>
			<?php if (empty($this->Form->error('email')) && !(empty($error_msg))) : ?>
				<span class="error-msg"><?php echo $error_msg; ?></span>
			<?php endif; ?>
		</div>
		<div class="login-form">
			<?php echo $this->Form->password('password', ['label' => false, 'placeholder' => 'パスワード']); ?>
            <?php echo $this->Form->error('password'); ?>
		</div>
		<?php echo $this->Form->submit('ログイン', ['label' => false]); ?>
		<?= $this->Form->end() ?>
        <?= $this->Html->link("会員登録", ['controller' => 'Users', 'action' => 'signup']) ?>
		<!--　現時点ではパスワード再発行ページへのリンクなし -->
        <?= $this->Html->link("パスワードを忘れた方はコチラ", ['controller' => '', 'action' => '']) ?>
	</div>
