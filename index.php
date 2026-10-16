<?php include_once "./api/db.php" ?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>卓越科技大學 - 教務行政系統</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-3.4.1.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<div id="cover">
		<div id="coverr">
			<a style="position:absolute; right:15px; top:15px; cursor:pointer; z-index:9999; font-size: 20px;" onclick="cl('#cover')">&times;</a>
			<div id="cvr"></div>
		</div>
	</div>

	<header>
		<div class="container">
			<a href="index.php" style="color: white; text-decoration: none;">
				<h1>卓越科技大學教務行政系統</h1>
			</a>
		</div>
	</header>

	<div class="container">
		<div class="main-layout">
			<!-- 側邊欄 -->
			<aside>
				<div class="card">
					<div class="menu-title">教務功能選單</div>
					<?php
					if(!isset($_SESSION['user'])){
						echo "<a href='?do=login' class='menu-item'>系統登入</a>";
					} else {
						if($_SESSION['user']['role'] == 'student'){
							echo "<a href='?do=profile' class='menu-item'>個人資料管理</a>";
							echo "<a href='?do=leave' class='menu-item'>請假申請查詢</a>";
							echo "<a href='?do=attendance' class='menu-item'>出缺席紀錄查詢</a>";
							echo "<a href='?do=grade' class='menu-item'>個人成績查詢</a>";
							echo "<a href='?do=course' class='menu-item'>課表教材下載</a>";
							echo "<a href='?do=assignment' class='menu-item'>作業繳交系統</a>";
						}
					}
					?>
				</div>

				<div class="card cent">
					<div class="menu-title">身分狀態</div>
					<?php if(isset($_SESSION['admin'])):?>
						<p style="margin-bottom: 10px;">管理者：<?= $_SESSION['admin']; ?></p>
						<button class="btn-accent" style="width:100%; margin-bottom:10px;" onclick="lo('back.php')">進入管理後台</button>
						<button style="width:100%;" onclick="lo('./api/logout.php')">登出系統</button>
					<?php elseif(isset($_SESSION['user'])):?>
						<p style="margin-bottom: 10px;">歡迎，<?= $_SESSION['user']['name']; ?>！</p>
						<button style="width:100%;" onclick="lo('./api/logout.php')">登出系統</button>
					<?php else:?>
						<p style="margin-bottom: 10px; color: #666;">尚未登入</p>
						<button style="width:100%;" onclick="lo('?do=login')">立即登入</button>
					<?php endif;?>
				</div>
			</aside>

			<!-- 主要內容 -->
			<main>
				<div class="content-area">
					<?php
					$do = $_GET['do'] ?? "main";
					$file = "./front/" . $do . ".php";
					if (file_exists($file)) {
						include $file;
					} else {
						include "./front/main.php";
					}
					?>
				</div>
			</main>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>卓越科技大學教務行政系統 版權所有 &copy; 2026</p>
			<p style="font-size: 0.8rem; margin-top: 10px; opacity: 0.7;">建議使用 Chrome 或 Edge 瀏覽器以獲得最佳體驗</p>
		</div>
	</footer>

    <script>
        // 覆蓋層點擊外部關閉
        $(window).on('click', function(e) {
            if ($(e.target).is('#cover')) {
                cl('#cover');
            }
        });
    </script>
</body>
</html>