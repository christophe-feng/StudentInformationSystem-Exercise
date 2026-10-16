<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}

$materials = $Material->all();
?>

<div style="width:95%; margin:auto;">
    <h3 class="cent">教材管理</h3>
    <div class="cent">
        <button onclick="op('#cover','#cvr','./modal/material.php')">上傳新教材</button>
    </div>
    <table style="width:100%; margin-top:10px; border-collapse: collapse;" border="1">
        <tr class="t cent">
            <td>課程名稱</td>
            <td>教材標題</td>
            <td>上傳日期</td>
            <td>檔案</td>
            <td>操作</td>
        </tr>
        <?php foreach ($materials as $m): ?>
            <?php $course = $Course->find($m['course_id']); ?>
            <tr class="cent">
                <td><?= $course['name'] ?? '未指定'; ?></td>
                <td><?= $m['title']; ?></td>
                <td><?= $m['upload_date']; ?></td>
                <td><a href="upload/<?= $m['file_path']; ?>" target="_blank">預覽/下載</a></td>
                <td>
                    <button onclick="del('material',<?= $m['id']; ?>)">刪除</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
