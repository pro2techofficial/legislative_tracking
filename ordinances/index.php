<?php include "../includes/header.php";
$search = mysqli_real_escape_string($conn, $_GET['search'] ?? '');
if ($search) {
    $items = mysqli_query($conn, "SELECT * FROM ordinances WHERE ordinance_no LIKE '%$search%' OR title LIKE '%$search%' OR author LIKE '%$search%' OR committee LIKE '%$search%' OR status LIKE '%$search%' ORDER BY id DESC");
} else {
    $items = mysqli_query($conn, "SELECT * FROM ordinances ORDER BY id DESC");
}
?>
<div class="topbar"><div><h1>Ordinances</h1><p class="subtitle">Manage municipal ordinances and monitor their legislative status.</p></div><a class="btn" href="add.php">Add Ordinance</a></div>
<form class="searchbar" method="GET"><input name="search" placeholder="Search by number, title, author, committee, or status" value="<?= e($search) ?>"><button class="btn">Search</button><a class="btn gray" href="index.php">Reset</a></form>
<div class="panel table-wrap">
<table>
<tr><th>No.</th><th>Title</th><th>Author</th><th>Committee</th><th>Date Filed</th><th>Status</th><th>File</th><th>Action</th></tr>
<?php while($r=mysqli_fetch_assoc($items)): ?>
<tr>
  <td><?= e($r['ordinance_no']) ?></td><td><?= e($r['title']) ?></td><td><?= e($r['author']) ?></td><td><?= e($r['committee']) ?></td><td><?= e($r['date_filed']) ?></td>
  <td><span class="badge <?= strtolower(str_replace(' ','',$r['status'])) ?>"><?= e($r['status']) ?></span></td>
  <td><?php if($r['file_path']): ?><a href="/mlts/<?= e($r['file_path']) ?>" target="_blank">View</a><?php else: ?>No file<?php endif; ?></td>
  <td class="actions"><a class="btn blue" href="view.php?id=<?= $r['id'] ?>">View</a><a class="btn green" href="edit.php?id=<?= $r['id'] ?>">Edit</a><a class="btn red" onclick="return confirmDelete()" href="delete.php?id=<?= $r['id'] ?>">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>
</div>
<?php include "../includes/footer.php"; ?>
