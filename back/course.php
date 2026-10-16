<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}

$courses = $Course->all();
?>

<div style="width:95%; margin:auto;">
    <h3 class="cent">班級課表管理</h3>
    <div class="cent">
        <button onclick="op('#cover','#cvr','./modal/course.php')">新增課程</button>
    </div>
    <table style="width:100%; margin-top:10px; border-collapse: collapse;" border="1">
        <tr class="t cent">
            <td>課程名稱</td>
            <td>授課老師</td>
            <td>上課時段</td>
            <td>地點</td>
            <td>操作</td>
        </tr>
        <?php foreach ($courses as $c): ?>
            <?php $teacher = $User->find($c['teacher_id']); ?>
            <tr class="cent">
                <td><?= $c['name']; ?></td>
                <td><?= $teacher['name'] ?? '未指定'; ?></td>
                <td><?= $c['time_slot']; ?></td>
                <td><?= $c['location']; ?></td>
                <td>
                    <button onclick="op('#cover','#cvr','./modal/course.php?id=<?= $c['id']; ?>')">修改</button>
                    <button onclick="del('course',<?= $c['id']; ?>)">刪除</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
