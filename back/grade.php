<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}

$grades = $Grade->all();
?>

<div style="width:95%; margin:auto;">
    <h3 class="cent">學生成績管理</h3>
    <div class="cent">
        <button onclick="op('#cover','#cvr','./modal/grade.php')">登錄新成績</button>
    </div>
    <table style="width:100%; margin-top:10px; border-collapse: collapse;" border="1">
        <tr class="t cent">
            <td>學生姓名</td>
            <td>課程名稱</td>
            <td>成績類型</td>
            <td>分數</td>
            <td>操作</td>
        </tr>
        <?php foreach ($grades as $g): ?>
            <?php 
                $student = $User->find($g['student_id']); 
                $course = $Course->find($g['course_id']); 
            ?>
            <tr class="cent">
                <td><?= $student['name'] ?? '未命名學生'; ?></td>
                <td><?= $course['name'] ?? '未定義課程'; ?></td>
                <td>
                    <?php
                        $types = ['midterm'=>'期中考', 'final'=>'期末考', 'quiz'=>'小考', 'other'=>'其他'];
                        echo $types[$g['type']] ?? '其他';
                    ?>
                </td>
                <td style="<?= $g['score'] < 60 ? 'color:red;' : ''; ?>"><?= $g['score']; ?></td>
                <td>
                    <button onclick="op('#cover','#cvr','./modal/grade.php?id=<?= $g['id']; ?>')">修改</button>
                    <button onclick="del('grade',<?= $g['id']; ?>)">刪除</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
