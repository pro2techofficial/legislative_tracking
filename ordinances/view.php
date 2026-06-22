<?php include "../includes/header.php";
$id=(int)($_GET['id'] ?? 0);
$item=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ordinances WHERE id=$id"));
$hist=mysqli_query($conn,"SELECT t.*, u.fullname FROM tracking_history t LEFT JOIN users u ON u.id=t.updated_by WHERE legislation_type='Ordinance' AND legislation_id=$id ORDER BY t.id DESC");
?>
<div class="topbar"><div><h1>Ordinance Details</h1><p class="subtitle">Legislative information and tracking history.</p></div><button onclick="window.print()" class="btn">Print</button></div>
<div class="print-header"><h2>Municipal Legislative Tracking System</h2><p>Ordinance Record</p></div>
<div class="panel">
  <h2><?= e($item['ordinance_no']) ?> - <?= e($item['title']) ?></h2><br>
  <p><b>Author:</b> <?= e($item['author']) ?></p>
  <p><b>Committee:</b> <?= e($item['committee']) ?></p>
  <p><b>Date Filed:</b> <?= e($item['date_filed']) ?></p>
  <p><b>Status:</b> <span class="badge"><?= e($item['status']) ?></span></p>
  <p><b>Remarks:</b><br><?= nl2br(e($item['remarks'])) ?></p>
  <p><b>Document:</b> <?php if($item['file_path']): ?><a target="_blank" href="/mlts/<?= e($item['file_path']) ?>">Open Document</a><?php else: ?>No uploaded document<?php endif; ?></p>
</div>
<div class="panel">
<h2>Status Timeline</h2>
<div class="timeline">
<?php $steps=['Draft','Filed','Committee Review','First Reading','Second Reading','Public Hearing','Third Reading','Approved','Rejected','Implemented']; foreach($steps as $s): ?>
  <span class="step <?= $item['status']==$s?'active':'' ?>"><?= $s ?></span>
<?php endforeach; ?>
</div>
</div>
<div class="panel table-wrap"><h2>Tracking History</h2>
<table><tr><th>Status</th><th>Remarks</th><th>Updated By</th><th>Date</th></tr>
<?php while($h=mysqli_fetch_assoc($hist)): ?><tr><td><?= e($h['status']) ?></td><td><?= e($h['remarks']) ?></td><td><?= e($h['fullname']) ?></td><td><?= e($h['created_at']) ?></td></tr><?php endwhile; ?>
</table></div>
<?php include "../includes/footer.php"; ?>
