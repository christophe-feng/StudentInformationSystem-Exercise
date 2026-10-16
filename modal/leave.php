<h3 class="cent">請假申請單</h3>
<hr>
<form action="./api/leave.php?action=add" method="post" enctype="multipart/form-data">
    <table style="width: 90%; margin: auto; border-spacing: 10px;">
        <tr>
            <td style="text-align: right; white-space: nowrap; width: 30%;">開始日期：</td>
            <td><input type="date" name="start_date" style="width: 100%; padding: 5px;" required></td>
        </tr>
        <tr>
            <td style="text-align: right; white-space: nowrap;">結束日期：</td>
            <td><input type="date" name="end_date" style="width: 100%; padding: 5px;" required></td>
        </tr>
        <tr>
            <td style="text-align: right; white-space: nowrap;">請假時數：</td>
            <td>
                <input type="number" name="duration" min="1" max="1000" style="width: 80%; padding: 5px;" placeholder="請輸入總時數" required> 
                <span style="font-weight: bold;">H</span>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align: right; padding-top: 10px; white-space: nowrap;">請假原因：</td>
            <td>
                <textarea name="reason" style="width: 100%; height: 120px; padding: 10px; border-radius: 4px; border: 1px solid #ccc;" placeholder="請詳細說明請假事由..." required></textarea>
            </td>
        </tr>
    </table>
    <div class="cent" style="margin-top: 25px; border-top: 1px solid #eee; padding-top: 20px;">
        <input type="submit" value="確認送出申請" class="btn-primary" style="padding: 10px 30px;">
        <input type="reset" value="重置表單" class="btn-outline" style="padding: 10px 20px; margin-left: 10px;">
    </div>
</form>