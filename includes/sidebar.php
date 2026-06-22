<?php
$currentPath = $_SERVER['REQUEST_URI'] ?? '';
function nav_active($needle){
    global $currentPath;
    return strpos($currentPath, $needle) !== false ? 'active' : '';
}
?>
<aside class="side">
    <div class="brand">
        <div class="logo-container">
            <img src="/mlts/assets/iguig.jpg" class="logo-img" alt="Municipal Logo">
        </div>
        <div class="brand-text">
            <div class="brand-title">Legislative Tracking</div>
            <div class="brand-sub"></div>
        </div>
    </div>

    <a class="<?= nav_active('/dashboard.php') ?>" href="/mlts/dashboard.php"><i class="bi bi-grid"></i> Dashboard</a>
    <a class="<?= nav_active('/ordinances/') ?>" href="/mlts/ordinances/index.php"><i class="bi bi-journal-text"></i> Ordinances</a>
    <a class="<?= nav_active('/resolutions/') ?>" href="/mlts/resolutions/index.php"><i class="bi bi-file-earmark-check"></i> Resolutions</a>
    <a class="<?= nav_active('/tracking/') ?>" href="/mlts/tracking/index.php"><i class="bi bi-diagram-3"></i> Status Tracker</a>
    <a class="<?= nav_active('/committees/') ?>" href="/mlts/committees/index.php"><i class="bi bi-people"></i> Committees</a>
    <a class="<?= nav_active('/members/') ?>" href="/mlts/members/index.php"><i class="bi bi-person-badge"></i> Council Members</a>
    <a class="<?= nav_active('/sessions/') ?>" href="/mlts/sessions/index.php"><i class="bi bi-calendar-event"></i> Sessions</a>
    <a class="<?= nav_active('/reports/') ?>" href="/mlts/reports/index.php"><i class="bi bi-file-earmark-text"></i> Reports</a>
    <?php if (is_admin()): ?>
    <a class="<?= nav_active('/users/') ?>" href="/mlts/users/index.php"><i class="bi bi-person-gear"></i> Users</a>
    <?php endif; ?>

    <hr>
    <a href="/mlts/auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</aside>
