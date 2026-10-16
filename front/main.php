<div class="welcome-container">
    <div class="announcement">
        <marquee scrolldelay="120" direction="left">
            歡迎使用卓越科技大學教務行政系統，請登入後進行各項功能操作。
        </marquee>
    </div>
    
    <div class="intro-section">
        <h2 class="cent" style="color: var(--primary); margin-bottom: 20px;">系統服務簡介</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="icon-placeholder">👤</div>
                <h3>個人資料管理</h3>
                <p>維護您的基本聯繫資訊與密碼設定。</p>
            </div>
            <div class="service-card">
                <div class="icon-placeholder">📅</div>
                <h3>課表教材查詢</h3>
                <p>隨時查閱課程表並下載老師上傳的教學講義。</p>
            </div>
            <div class="service-card">
                <div class="icon-placeholder">✅</div>
                <h3>出缺席追蹤</h3>
                <p>即時追蹤課堂出缺席狀況，包含請假紀錄。</p>
            </div>
            <div class="service-card">
                <div class="icon-placeholder">📝</div>
                <h3>作業繳交管理</h3>
                <p>查看作業要求、上傳成品並檢閱評分。</p>
            </div>
        </div>

        <div class="login-prompt cent">
            <?php if(!isset($_SESSION['user'])): ?>
                <button class="btn-primary" style="padding: 12px 30px; font-size: 1.1rem;" onclick="lo('?do=login')">立即登入系統</button>
            <?php else: ?>
                <div class="user-welcome">
                    <p>您好，<span style="font-weight: bold; font-size: 1.2rem; color: var(--accent);"><?= $_SESSION['user']['name']; ?></span> 先生/小姐</p>
                    <p>您目前已進入教務系統，請由左側功能選單選擇您需要的服務。</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .welcome-container {
        padding: 10px;
    }
    
    .services-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 30px 0;
    }
    
    .service-card {
        padding: 20px;
        background: #f8f9fa;
        border-radius: var(--border-radius);
        border: 1px solid #eee;
        transition: transform 0.3s;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        background: #fff;
        box-shadow: var(--shadow);
    }
    
    .icon-placeholder {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .service-card h3 {
        color: var(--primary);
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    
    .service-card p {
        font-size: 0.9rem;
        color: #666;
    }
    
    .user-welcome {
        background: #eef7ff;
        padding: 20px;
        border-radius: var(--border-radius);
        margin-top: 20px;
    }

    @media (max-width: 576px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>