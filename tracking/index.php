<?php include "../includes/header.php";
$type = $_GET['type'] ?? 'Ordinance';
$table = $type === 'Resolution' ? 'resolutions' : 'ordinances';
$no = $type === 'Resolution' ? 'resolution_no' : 'ordinance_no';
$items = mysqli_query($conn,"SELECT * FROM $table ORDER BY id DESC");
?>
<div class="topbar"><div><h1>Status Tracker</h1><p class="subtitle">View workflow progress of ordinances and resolutions.</p></div></div>
<form class="searchbar" method="GET">
<select name="type"><option <?= $type=='Ordinance'?'selected':'' ?>>Ordinance</option><option <?= $type=='Resolution'?'selected':'' ?>>Resolution</option></select>
<button class="btn">Filter</button>
</form>
<div class="panel table-wrap">
<table><tr><th>No.</th><th>Title</th><th>Current Status</th><th>Workflow</th><th>Action</th></tr>
<?php $steps=['Draft','Filed','Committee Review','First Reading','Second Reading','Public Hearing','Third Reading','Approved','Rejected','Implemented']; while($r=mysqli_fetch_assoc($items)): ?>
<tr>
<td><?= e($r[$no]) ?></td><td><?= e($r['title']) ?></td><td><span class="badge"><?= e($r['status']) ?></span></td>
<td><div class="timeline"><?php foreach($steps as $s): ?><span class="step <?= $r['status']==$s?'active':'' ?>"><?= $s ?></span><?php endforeach; ?></div></td>
<td><a class="btn blue" href="/mlts/<?= strtolower($type) ?>s/view.php?id=<?= $r['id'] ?>">View</a></td>
</tr>
<?php endwhile; ?></table>
</div>
<?php include "../includes/footer.php"; ?>
