<style>
	/* footer */
	.footer {
		width: 100%;
		height: 168px;
		background: var(--unnamed-color-262626) 0% 0% no-repeat padding-box;
		background: #262626 0% 0% no-repeat padding-box;
		opacity: 1;
		position: absolute;
		/* ←絶対位置 */
		bottom: 0;


	}

	/* footer logo */
	.footer-left {
		float: left;
		margin-left: 10%;
		padding-top: 48px;
		margin-bottom: 78px;
		margin-left: 7%;
		margin-right: 6%;
	}

	p {
		color: #FFFFFF;
		margin: 30px;
		font-weight: bold;
		width: 163px;
		height: 14px;
		opacity: 1;
	}

	/* footer link */
	.footer a {
		padding: 3px 16px;
		text-decoration: none;
		text-align: center;
		font: normal normal normal 14px/19px Noto Sans;
		letter-spacing: 1.12px;
		color: #FFFFFF;
		opacity: 1;
	}

	.footer a:hover {
		opacity: 0.7;
	}

	.footer-centered {
		float: left;
		padding-top: 76px;
		margin-bottom: 78px;
		margin: 0 auto;
		display: flex;
		white-space: nowrap;
		width: 28%;
	}

	.footer-centered a {
		float: none;
		opacity: 1;
	}

	.footer-link {
		color: #FFFFFF;
		padding-left: 30px;
		opacity: 1;
	}
</style>

<div class="footer">
	<!-- 左寄せ -->
	<div class="footer-left">
		<p>QUEL CINEMAS</p>
	</div>

	<!--中央 -->
	<div class="footer-centered">
		<!-- トップ -->
		<a href="#">トップ <span class="footer-link">|</span></a>
		<!-- 上映スケジュール -->
		<a href="#">上映スケジュール <span class="footer-link">|</span></a>
		<!-- 料金•割引 -->
		<a href="#">料金•割引 </a>
	</div>

</div>
