<?= $this->Html->css('Users/confirm.css') ?>
	<div class="content-area">
        <h3>会員登録完了</h3>
        <p>ご登録ありがとうございました。</p>
        <p>メールアドレスに登録完了メールを送信いたしました。</p>
        <div class="btn">
        <?= $this->Html->link("ログインする", ['controller' => 'Users', 'action' => 'login']) ?>
        </div>
    </div>
