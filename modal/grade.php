<?php
include_once "../api/db.php";
$id = $_GET['id'] ?? null;
$grade = $id ? $Grade->find($id) : null;
$students = $User->all(['role'=>'student']);
$courses = $Course->all();
?>
<h3 class="cent"><?= $id ? '修改成績' : '登錄新成績'; ?></h3>
<hr>
<form action="./api/grade.php?action=save" method="post">
    <?php if($id): ?>
        <input type="hidden" name="id" value="<?= $id; ?>">
    <?php endif; ?>
    <table style="width: 80%; margin: auto;">
        <tr>
            <td style="text-align: right;">選擇學生：</td>
            <td>
                <select name="student_id" required>
                    <?php foreach($students as $s): ?>
                        <option value="<?= $s['id']; ?>" <?= ($grade && $grade['student_id'] == $s['id']) ? 'selected' : ''; ?>>
                            <?= $s['name']; ?> (<?= $s['acc']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">選擇課程：</td>
            <td>
                <select name="course_id" required>
                    <?php foreach($courses as $c): ?>
                        <option value="<?= $c['id']; ?>" <?= ($grade && $grade['course_id'] == $c['id']) ? 'selected' : ''; ?>>
                            <?= $c['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">成績類型：</td>
            <td>
                <select name="type">
                    <option value="midterm" <?= ($grade && $grade['type'] == 'midterm') ? 'selected' : ''; ?>>期中考</option>
                    <option value="final" <?= ($grade && $grade['type'] == 'final') ? 'selected' : ''; ?>>期末考</option>
                    <option value="quiz" <?= ($grade && $grade['type'] == 'quiz') ? 'selected' : ''; ?>>小考</option>
                    <option value="other" <?= ($grade && $grade['type'] == 'other') ? 'selected' : ''; ?>>其他</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">成績分數：</td>
            <td><input type="number" name="score" min="0" max="100" value="<?= $grade ? $grade['score'] : '0'; ?>" required></td>
        </tr>
    </table>
    <div class="cent" style="margin-top: 20px;">
        <input type="submit" value="<?= $id ? '確認修改' : '送出登錄'; ?>">
        <input type="reset" value="重置">
    </div>
</form>
