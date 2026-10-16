<div class="card-inner">
    <div class="table-header">
        <p>作業繳交管理系統</p>
        <span class="badge">今日日期：<?= date("Y-m-d"); ?></span>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr class="yel cent">
                    <td width="20%">課程名稱</td>
                    <td width="25%">作業標題</td>
                    <td width="20%">截止日期</td>
                    <td width="15%">繳交狀態</td>
                    <td width="10%">成績</td>
                    <td width="10%">繳交</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $assignments = $Assignment->all();
                foreach ($assignments as $as) {
                    $course = $Course->find($as['course_id']);
                    $sub = $Submission->find(['assignment_id' => $as['id'], 'student_id' => $_SESSION['user']['id']]);
                    $is_submitted = $sub ? true : false;
                    $is_overdue = (strtotime($as['due_date']) < time()) ? true : false;
                ?>
                    <tr class="cent">
                        <td><?= $course['name'] ?></td>
                        <td>
                            <a href="javascript:void(0)" class="assignment-link" onclick="op('#cover','#cvr','./modal/assignment_detail.php?id=<?= $as['id'] ?>')">
                                <?= $as['title'] ?>
                            </a>
                        </td>
                        <td class="text-muted"><?= $as['due_date'] ?></td>
                        <td>
                            <?php
                            if ($is_submitted) {
                                echo "<span class='status-submitted'>已繳交</span>";
                                echo "<br><small><a href='upload/{$sub['file_path']}' download class='download-link'>查看已繳檔案</a></small>";
                            } else {
                                if ($is_overdue) {
                                    echo "<span class='status-overdue'>已截止</span>";
                                } else {
                                    echo "<span class='status-pending'>未繳交</span>";
                                }
                            }
                            ?>
                        </td>
                        <td class="grade-cell"><?= ($is_submitted && isset($sub['grade'])) ? $sub['grade'] : '-' ?></td>
                        <td>
                            <?php if (!$is_overdue || $is_submitted): ?>
                                <button class="btn-primary" style="padding: 6px 12px; font-size: 13px;" 
                                       onclick="op('#cover','#cvr','./modal/submit_assignment.php?id=<?= $as['id'] ?>')">
                                    <?= $is_submitted ? '重新繳交' : '繳交' ?>
                                </button>
                            <?php else: ?>
                                <span class="text-muted" style="font-size: 12px;">已關閉</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .card-inner { padding: 10px; }
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary);
    }
    .modern-table { width: 100%; border-collapse: collapse; border: 1px solid #eee; }
    .modern-table td { padding: 15px; border-bottom: 1px solid #eee; }
    .assignment-link { color: var(--primary); font-weight: 600; text-decoration: none; }
    .assignment-link:hover { text-decoration: underline; }
    
    .status-submitted { color: #155724; background: #d4edda; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    .status-overdue { color: #721c24; background: #f8d7da; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    .status-pending { color: #856404; background: #fff3cd; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem; }
    
    .download-link { color: #0066cc; text-decoration: none; font-size: 11px; }
    .grade-cell { font-weight: bold; color: var(--accent); }
    .text-muted { color: #777; font-size: 0.9rem; }
</style>