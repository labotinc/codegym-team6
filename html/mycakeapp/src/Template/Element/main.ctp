<style>
	/* 背景 */
	.container {
		background-color: lightgray;
		overflow: hidden;
		width: 100%;
		height: 100%;
		vertical-align: middle;
		margin-bottom: 0;
		position: relative;
	}

	/* タイトル */
	h2 {
		color: gray;
		text-align: center;
		margin: 0;
		padding-top: 3%;
		padding-bottom: 3%;
	}

	/* コンテンツ表示部分 */
	.main {
		text-align: center;
		width: 700px;
		height: 500px;
		margin: auto;
		background-color: white;
		margin-bottom:18%;
	}
</style>
<div class="container">
	<!-- タイトル -->
	<h2><?= $title ?></h2>　<!-- 各ページのタイトルを変数に代入 -->
<!-- コンテンツ表示枠 -->
	<div class="main">
	</div>
</div>
