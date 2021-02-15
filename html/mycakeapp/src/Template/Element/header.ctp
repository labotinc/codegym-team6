<style>
	/* header */
	.topnav {
		background: var(--unnamed-color-262626) 0% 0% no-repeat padding-box;
		background: #262626 0% 0% no-repeat padding-box;
		top: 0px;
		left: 0px;
		width: 1920px;
		height: 72px;
		/* overflow: hidden; */
		opacity: 1;
	}

	/* header logo */
	.topnav-left {
		float: left;
		margin-left: 140.78px;
		padding-top: 26px;
		margin-bottom: 20px;
	}

	p {
		color: white;
		width: 300px;
		margin: 5px 0 5px 30px;
		font-weight: bold;
	}

	span {
		color: #FFB100;
		opacity: 1;
		top: 29px;
		left: 141px;
		width: 53px;
		height: 14px;
	}

	/* header link共通部分 */
	.topnav a {
		float: left;
		color: #FFFFFF;
		text-align: center;
		padding: 3px 16px;
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
		float: left;
		padding-top: 28px;
		margin-bottom: 28px;
	}

	.topnav-centered a {
		float: none;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		margin: 30px;
	}

	/* header右側ボタンリンク */
	.topnav-right {
		float: right;
		padding-top: 16px;
		margin-bottom: 20px;
	}

	.topnav-right a {
		border: 1px solid #FFFFFF;
		border-radius: 3px;
		opacity: 1;
	}
</style>
<div class="topnav">
	<!-- 右寄せ -->
	<div class="topnav-left">
		<p><span>QUEL</span> CINNEMAS</p>
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

	<!-- 左寄せ -->
	<div class="topnav-right">
		<!-- 新規登録 ボタン-->
		<a href="#" type="button">新規登録</a>
		<!-- ログインボタン -->
		<a href="#" type="button">ログイン</a>
	</div>

</div>
