<?= $this->Html->css('Users/login.css') ?>
    <?php $this->assign("title", "ログイン"); ?>
    <div class="content-area">
		<?= $this->Form->create($user_form, array('novalidate' => true)); ?>
		<div class="login-form">
			<?php echo $this->Form->email('email', ['label' => false, 'placeholder' => 'メールアドレス']); ?>
            <?php echo $this->Form->error('email'); ?>
		</div>
		<div class="login-form">
			<?php echo $this->Form->password('password', ['label' => false, 'placeholder' => 'パスワード']); ?>
            <?php echo $this->Form->error('password'); ?>
		</div>
		<?php echo $this->Form->submit('ログイン', ['label' => false]); ?>
		<?= $this->Form->end() ?>
        <?= $this->Html->link("会員登録", ['controller' => 'Users', 'action' => 'signup']) ?>
        <?= $this->Html->link("パスワードを忘れた方はコチラ", ['controller' => '', 'action' => '']) ?>
	</div>
