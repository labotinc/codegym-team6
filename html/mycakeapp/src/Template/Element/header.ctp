<style>
	/* header */
	.topnav {
		background: var(--unnamed-color-262626) 0% 0% no-repeat padding-box;
		background: #262626 0% 0% no-repeat padding-box;
		width: 100%;
		height: 79px;
		opacity: 1;
	}

	/* header logo */
	.topnav-left {
		float: left;
		margin-left: 7%;
		margin-right: 6%;
		padding-bottom: 30px;
	}

	p {
		color: #FFFFFF;
		margin: 5px 0 5px 30px;
		font-weight: bold;
	}

	span {
		color: #FFB100;
		opacity: 1;
		width: 53px;
		height: 14px;
	}

	/* header link共通部分 */
	.topnav a {
		/* float: left; */
		color: #FFFFFF;
		text-align: center;
		padding: 8px 16px;
		text-decoration: none;
		font-size: 15px;
		font-size: 15px;
		margin: 10px 30px;
		opacity: 1;
	}

	.topnav a:hover {
		opacity: 0.7;
	}

	/* header中央リンク */
	.topnav-centered {
		display: flex;
		white-space: nowrap;
		float: left;
		padding-top: 28px;
		margin-bottom: 28px;
		margin: 0 auto;
		width: 28%;
		margin-right: 10%;
	}

	.topnav-centered a {
		float: none;
		transform: translate(-50%, -50%);
		width: 18%;
	}

	/* header右側ボタンリンク */
	.topnav-right {
		display: flex;
		justify-content: flex-end;
		white-space: nowrap;
		padding-top: 16px;
		margin-bottom: 20px;
		margin-right: 100px;
	}

	.topnav-right a {
		border: 1px solid #FFFFFF;
		border-radius: 3px;
		opacity: 1;
	}
</style>

<div class="topnav">
	<!-- 左寄せ -->
	<div class="topnav-left">
		<p><span>QUEL</span> CINEMAS</p>
	</div>

	<!--中央 -->
	<div class="topnav-centered">
		<!-- トップ -->
		<a href="#">トップ</a>
		<!-- 上映スケジュール -->
		<a href="#">上映スケジュール </a>
		<!-- 料金•割引 -->
		<a href="#">料金•割引 </a>
	</div>

	<!-- 右寄せ -->
	<div class="topnav-right">
		<!-- 新規登録 ボタン-->
		<?= $this->Html->link("新規登録", ['controller' => 'Users', 'action' => 'signup']) ?>
		<!-- ログインボタン -->
		<?= $this->Html->link("ログイン", ['controller' => 'Users', 'action' => 'login']) ?>
	</div>

</div>
