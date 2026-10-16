<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入');location.href='?do=login';</script>";
    exit();
}

$courses = $Course->all();
?>

<div class="card-inner">
    <div class="table-header">
        <p>班級課表與教材下載</p>
        <span class="badge">共有 <?= count($courses); ?> 門課程</span>
    </div>

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr class="yel cent">
                    <td width="20%">課程名稱</td>
                    <td width="20%">上課時段</td>
                    <td width="20%">地點</td>
                    <td width="40%">相關教材 (點擊下載)</td>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($courses)): ?>
                    <tr><td colspan="4" class="cent" style="padding: 40px; color: #999;">目前尚無課表資料</td></tr>
                <?php else: ?>
                    <?php foreach ($courses as $c): ?>
                        <tr class="cent">
                            <td class="font-weight-bold"><?= $c['name']; ?></td>
                            <td class="text-muted"><?= $c['time_slot']; ?></td>
                            <td><?= $c['location']; ?></td>
                            <td style="text-align: left; padding: 10px;">
                                <div class="material-list">
                                    <?php 
                                        $mats = $Material->all(['course_id'=>$c['id']]);
                                        if(empty($mats)) {
                                            echo "<span style='color:#bbb; font-style:italic;'>目前尚未上傳教材</span>";
                                        } else {
                                            foreach($mats as $m){
                                                echo "<a href='upload/{$m['file_path']}' class='material-link' target='_blank'>
                                                        <span class='icon'>📁</span> {$m['title']}
                                                      </a>";
                                            }
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
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
    .font-weight-bold { font-weight: 600; color: var(--primary); }
    .text-muted { color: #555; font-size: 0.9rem; }
    
    .material-list {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .material-link {
        display: inline-block;
        padding: 5px 10px;
        background: #f0f7ff;
        color: var(--primary);
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.85rem;
        transition: background 0.2s;
        border: 1px solid #e1efff;
    }
    .material-link:hover {
        background: var(--primary);
        color: white;
    }
    .material-link .icon { margin-right: 5px; }
</style>