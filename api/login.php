<?php
include_once "db.php";

// 從 users 資料表尋找符合帳號密碼的使用者
$user = $User->find(['acc' => $_POST['acc'], 'pw' => $_POST['pw']]);

if ($user) {
    // 儲存通用的使用者資訊
    $_SESSION['user'] = $user;

    // 判斷角色導向
    if ($user['role'] == 'teacher' || $user['role'] == 'admin') {
        // 老師或管理員視為後台管理員
        $_SESSION['admin'] = $user['acc'];
        to("../back.php");
    } else {
        // 學生導向首頁 (前台)
        to("../index.php");
    }
} else {
    // 登入失敗
    echo "<script>
        alert('帳號或密碼錯誤');
        location.href='../index.php?do=login';
    </script>";
}
?>
