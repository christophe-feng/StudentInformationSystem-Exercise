<?php
include_once "./api/db.php";
if (!isset($_SESSION['admin'])) {
	to("index.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理後台 - 卓越科技大學教務行政系統</title>
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
			<a href="back.php" style="color: white; text-decoration: none;">
				<h1>卓越科技大學教務管理後台</h1>
			</a>
		</div>
	</header>

	<div class="container">
		<div class="main-layout">
			<!-- 側邊欄 -->
			<aside>
				<div class="card">
					<div class="menu-title">管理選單</div>
					<a href="?do=student_list" class="menu-item">學生名冊查詢</a>
					<a href="?do=leave" class="menu-item">學生請假審核</a>
					<a href="?do=grade" class="menu-item">學生成績管理</a>
					<a href="?do=course" class="menu-item">班級課表管理</a>
					<a href="?do=material" class="menu-item">教材講義管理</a>
					<a href="?do=roll_call" class="menu-item">課堂點名系統</a>
					<a href="?do=assignment" class="menu-item">作業佈置系統</a>
					<hr style="margin: 10px 0; opacity: 0.1;">
					<a href="index.php" class="menu-item btn-accent" style="color: white; text-align: center;">回系統首頁</a>
					<button style="width:100%; margin-top: 10px;" onclick="location.href='./api/logout.php'">管理員登出</button>
				</div>

				<div class="card cent" style="background: #e9f0f7;">
					<p style="font-size: 0.9rem;">目前管理員：<br><strong><?= $_SESSION['admin']; ?></strong></p>
				</div>
			</aside>

			<!-- 主要內容 -->
			<main>
				<div class="content-area">
					<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
						<h2 style="color: var(--primary);">
							<?php
							$titles = [
								'student_list' => '學生名冊查詢',
								'leave' => '學生請假審核管理',
								'grade' => '學生成績管理',
								'course' => '班級課表管理',
								'material' => '教材講義管理',
								'roll_call' => '班級課堂點名系統',
								'assignment' => '作業佈置與管理系統',
								'submission' => '學生作業批改'
							];
							echo $titles[$_GET['do'] ?? 'student_list'] ?? '後台管理';
							?>
						</h2>
						<button class="btn-accent" onclick="history.back()">回上一頁</button>
					</div>

					<?php
					$do = $_GET['do'] ?? "student_list";
					$file = "./back/" . $do . ".php";
					if (file_exists($file)) {
						include $file;
					} else {
						include "./back/student_list.php";
					}
					?>
				</div>
			</main>
		</div>
	</div>

	<footer>
		<div class="container">
			<p>卓越科技大學管理後台 &copy; 2026</p>
			<p style="font-size: 0.8rem; margin-top: 10px; opacity: 0.7;">Administrator Mode</p>
		</div>
	</footer>

	<script>
		$(window).on('click', function(e) {
			if ($(e.target).is('#cover')) {
				cl('#cover');
			}
		});
	</script>
</body>

</html>