<style>
	/* header */
	.topnav {
		position: relative;
		background-color: black;
		width: 100%;
		height: 64px;
		overflow: hidden;
	}

	/* header logo */
	.topnav-left {
		float: left;
		padding-top: 18px;
		margin-bottom: 20px;
	}

	p {
		color: white;
		width: 300px;
		margin: 5px 0 5px 30px;
		font-weight: bold;
	}

	span {
		color: orange;
	}

	/* header link共通部分 */
	.topnav a {
		float: left;
		color: white;
		text-align: center;
		padding: 3px 16px;
		text-decoration: none;
		font-size: 15px;
		font-size: 15px;
		margin: 10px 30px;
	}

	.topnav a:hover {
		opacity: 0.7;
	}

	/* header中央リンク */
	.topnav-centered {
		float: left;
		padding-top: 20px;
		margin-bottom: 20px;
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
		padding-top: 8px;
		margin-bottom: 20px;
	}

	.topnav-right a {
		border: 1px solid #ccc;
		border-radius: 8%;
	}
</style>
<div class="topnav">
	<!-- 右寄せ -->
	<div class="topnav-left">
		<p>QUEL <span>CINNEMAS</span></p>
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
