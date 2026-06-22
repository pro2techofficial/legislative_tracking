<?php include "../includes/header.php";
$ord=mysqli_query($conn,"SELECT status, COUNT(*) total FROM ordinances GROUP BY status");
$res=mysqli_query($conn,"SELECT status, COUNT(*) total FROM resolutions GROUP BY status");
$logs=mysqli_query($conn,"SELECT a.*,u.fullname FROM audit_logs a LEFT JOIN users u ON u.id=a.user_id ORDER BY a.id DESC LIMIT 30");
?>
<div class="topbar"><div><h1>Reports</h1><p class="subtitle">Printable summary of legislative records and system activities.</p></div><button class="btn" onclick="window.print()">Print Report</button></div>
<div class="print-header"><h2>Municipal Legislative Tracking System</h2><p>Legislative Report</p></div>
<div class="panel table-wrap"><h2>Ordinances by Status</h2><table><tr><th>Status</th><th>Total</th></tr><?php while($r=mysqli_fetch_assoc($ord)): ?><tr><td><?= e($r['status']) ?></td><td><?= e($r['total']) ?></td></tr><?php endwhile; ?></table></div>
<div class="panel table-wrap"><h2>Resolutions by Status</h2><table><tr><th>Status</th><th>Total</th></tr><?php while($r=mysqli_fetch_assoc($res)): ?><tr><td><?= e($r['status']) ?></td><td><?= e($r['total']) ?></td></tr><?php endwhile; ?></table></div>
<div class="panel table-wrap"><h2>Recent Audit Logs</h2><table><tr><th>User</th><th>Action</th><th>Module</th><th>Date</th></tr><?php while($r=mysqli_fetch_assoc($logs)): ?><tr><td><?= e($r['fullname']) ?></td><td><?= e($r['action']) ?></td><td><?= e($r['module']) ?></td><td><?= e($r['created_at']) ?></td></tr><?php endwhile; ?></table></div>
<?php include "../includes/footer.php"; ?>
