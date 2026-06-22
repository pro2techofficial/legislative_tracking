<?php include "includes/header.php";
$ord = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM ordinances"))['total'];
$res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM resolutions"))['total'];
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM ordinances WHERE status NOT IN('Approved','Implemented','Rejected')"))['total']
        + mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM resolutions WHERE status NOT IN('Approved','Implemented','Rejected')"))['total'];
$approved = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM ordinances WHERE status='Approved'"))['total']
        + mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM resolutions WHERE status='Approved'"))['total'];
$latestOrd = mysqli_query($conn,"SELECT * FROM ordinances ORDER BY id DESC LIMIT 5");
$latestRes = mysqli_query($conn,"SELECT * FROM resolutions ORDER BY id DESC LIMIT 5");
?>
<div class="topbar">
    <div>
        <h1>Dashboard</h1>
        <p class="subtitle">Overview of municipal legislative records and current actions.</p>
    </div>
    <button class="btn gray" onclick="window.print()">Print</button>
</div>

<div class="cards">
    <div class="card"><h3><i class="bi bi-journal-text"></i> Total Ordinances</h3><p><?= $ord ?></p></div>
    <div class="card"><h3><i class="bi bi-file-earmark-check"></i> Total Resolutions</h3><p><?= $res ?></p></div>
    <div class="card"><h3><i class="bi bi-exclamation-circle"></i> Pending Items</h3><p><?= $pending ?></p></div>
    <div class="card"><h3><i class="bi bi-check-circle"></i> Approved Items</h3><p><?= $approved ?></p></div>
</div>

<div class="panel">
    <h2>Latest Ordinances</h2>
    <div class="table-wrap">
        <table><tr><th>No.</th><th>Title</th><th>Status</th><th>Date Filed</th></tr>
        <?php while($r=mysqli_fetch_assoc($latestOrd)): ?>
        <tr><td><?= e($r['ordinance_no']) ?></td><td><?= e($r['title']) ?></td><td><span class="badge <?= strtolower(str_replace(' ','',$r['status'])) ?>"><?= e($r['status']) ?></span></td><td><?= e($r['date_filed']) ?></td></tr>
        <?php endwhile; ?></table>
    </div>
</div>

<div class="panel">
    <h2>Latest Resolutions</h2>
    <div class="table-wrap">
        <table><tr><th>No.</th><th>Title</th><th>Status</th><th>Date Filed</th></tr>
        <?php while($r=mysqli_fetch_assoc($latestRes)): ?>
        <tr><td><?= e($r['resolution_no']) ?></td><td><?= e($r['title']) ?></td><td><span class="badge <?= strtolower(str_replace(' ','',$r['status'])) ?>"><?= e($r['status']) ?></span></td><td><?= e($r['date_filed']) ?></td></tr>
        <?php endwhile; ?></table>
    </div>
</div>
<?php include "includes/footer.php"; ?>
