<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">作業管理</p>
    <form method="post" action="./api/assignment.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="20%">課程名稱</td>
                    <td width="30%">作業名稱</td>
                    <td width="20%">截止日期</td>
                    <td width="10%">參考檔案</td>
                    <td width="10%">繳交情況</td>
                    <td width="10%">操作</td>
                    <td width="7%">刪除</td>
                </tr>
                <?php
                $rows = $Assignment->all();
                foreach ($rows as $row) {
                    $course = $Course->find($row['course_id']);
                ?>
                    <tr>
                        <td><?= $course['name']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td><?= $row['due_date']; ?></td>
                        <td>
                            <?php if(!empty($row['file_path'])): ?>
                            <a href="upload/<?= $row['file_path']; ?>" download>下載</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?do=submission&id=<?= $row['id']; ?>">查看(<?= $Submission->count(['assignment_id' => $row['id']]); ?>)</a>
                        </td>
                        <td>
                            <input type="button" onclick="op('#cover','#cvr','./modal/assignment.php?id=<?= $row['id']; ?>')" value="修改">
                        </td>
                        <td>
                            <input type="button" onclick="del('assignment',<?= $row['id']; ?>)" value="刪除">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button" onclick="op('#cover','#cvr','./modal/assignment.php')" value="新增作業">
                    </td>
                    <td class="cent">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>