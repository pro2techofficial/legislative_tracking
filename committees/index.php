<?php include "../includes/header.php";
if(isset($_POST['save'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $chair=mysqli_real_escape_string($conn,$_POST['chairperson']);
    $desc=mysqli_real_escape_string($conn,$_POST['description']);
    mysqli_query($conn,"INSERT INTO committees(name,chairperson,description) VALUES('$name','$chair','$desc')");
    log_action($conn,"Added committee $name","Committees");
    header("Location: index.php"); exit();
}
$items=mysqli_query($conn,"SELECT * FROM committees ORDER BY id DESC");
?>
<div class="topbar"><div><h1>Committees</h1><p class="subtitle">Manage Sangguniang Bayan committees.</p></div></div>
<div class="panel">
<form method="POST" class="form-grid">
<div><label>Committee Name</label><input name="name" required></div>
<div><label>Chairperson</label><input name="chairperson"></div>
<div class="form-full"><label>Description</label><textarea name="description"></textarea></div>
<div><button class="btn" name="save">Save Committee</button></div>
</form>
</div>
<div class="panel table-wrap"><table><tr><th>Name</th><th>Chairperson</th><th>Description</th><th>Action</th></tr>
<?php while($r=mysqli_fetch_assoc($items)): ?><tr><td><?= e($r['name']) ?></td><td><?= e($r['chairperson']) ?></td><td><?= e($r['description']) ?></td><td><a class="btn red" onclick="return confirmDelete()" href="delete.php?id=<?= $r['id'] ?>">Delete</a></td></tr><?php endwhile; ?>
</table></div>
<?php include "../includes/footer.php"; ?>
