<?php
if (!isset($_SESSION['admin'])) {
    to("index.php");
    exit();
}
$leaves = $Leave->all(" ORDER BY apply_date DESC");
?>

<div class="card-inner">
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th style="white-space: nowrap;">學生姓名</th>
                    <th style="white-space: nowrap;">申請日期</th>
                    <th style="white-space: nowrap;">日期</th>
                    <th style="white-space: nowrap;">時數</th>
                    <th width="35%">請假原因</th>
                    <th style="white-space: nowrap;">狀態</th>
                    <th style="white-space: nowrap;">審核操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaves as $l): ?>
                    <?php $student = $User->find($l['student_id']); ?>
                    <tr class="cent">
                        <td style="white-space: nowrap;"><?= $student['name']; ?></td>
                        <td class="text-muted" style="font-size: 0.85rem; white-space: nowrap;"><?= date("Y-m-d", strtotime($l['apply_date'])); ?></td>
                        <td style="white-space: nowrap; font-size: 0.85rem;"><?= $l['start_date']; ?><br>~ <?= $l['end_date']; ?></td>
                        <td style="font-weight: bold; color: var(--accent);"><?= $l['duration']; ?> H</td>
                        <td style="text-align: left; font-size: 0.9rem; line-height: 1.4; padding: 15px;"><?= $l['reason']; ?></td>
                        <td>
                            <?php
                            $status_map = [
                                'pending' => '<span class="status-pending">待審核</span>',
                                'approved' => '<span class="status-approved">已批准</span>',
                                'rejected' => '<span class="status-rejected">已拒絕</span>'
                            ];
                            echo $status_map[$l['status']];
                            ?>
                        </td>
                        <td style="white-space: nowrap;">
                            <?php if ($l['status'] == 'pending'): ?>
                                <form action="./api/leave.php?action=update" method="post" style="display:inline-flex; gap: 5px;">
                                    <input type="hidden" name="id" value="<?= $l['id']; ?>">
                                    <select name="status" style="padding: 2px;">
                                        <option value="approved">批准</option>
                                        <option value="rejected">拒絕</option>
                                    </select>
                                    <input type="submit" value="送出" style="padding: 2px 8px;">
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .card-inner { padding: 5px; }
    .status-pending { color: #856404; background: #fff3cd; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem; }
    .status-approved { color: #155724; background: #d4edda; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem; }
    .status-rejected { color: #721c24; background: #f8d7da; padding: 2px 6px; border-radius: 4px; font-size: 0.8rem; }
    .modern-table { width: 100%; border-collapse: collapse; }
    .modern-table th { background: #f1f4f8; padding: 12px 8px; border-bottom: 2px solid #ddd; }
    .modern-table td { padding: 10px 5px; border-bottom: 1px solid #eee; }
    .text-muted { color: #999; }
</style>