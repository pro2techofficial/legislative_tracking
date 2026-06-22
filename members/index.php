<?php include "../includes/header.php";
if(isset($_POST['save'])){
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $position=mysqli_real_escape_string($conn,$_POST['position']);
    $committee=mysqli_real_escape_string($conn,$_POST['committee']);
    $contact=mysqli_real_escape_string($conn,$_POST['contact']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    mysqli_query($conn,"INSERT INTO council_members(fullname,position,committee,contact,email) VALUES('$fullname','$position','$committee','$contact','$email')");
    log_action($conn,"Added council member $fullname","Council Members");
    header("Location: index.php"); exit();
}
$items=mysqli_query($conn,"SELECT * FROM council_members ORDER BY id DESC");
?>
<div class="topbar"><div><h1>Council Members</h1><p class="subtitle">Manage SB officials and committee assignments.</p></div></div>
<div class="panel">
<form method="POST" class="form-grid">
<div><label>Full Name</label><input name="fullname" required></div>
<div><label>Position</label><input name="position"></div>
<div><label>Committee</label><input name="committee"></div>
<div><label>Contact</label><input name="contact"></div>
<div class="form-full"><label>Email</label><input type="email" name="email"></div>
<div><button class="btn" name="save">Save Member</button></div>
</form>
</div>
<div class="panel table-wrap"><table><tr><th>Name</th><th>Position</th><th>Committee</th><th>Contact</th><th>Email</th><th>Action</th></tr>
<?php while($r=mysqli_fetch_assoc($items)): ?><tr><td><?= e($r['fullname']) ?></td><td><?= e($r['position']) ?></td><td><?= e($r['committee']) ?></td><td><?= e($r['contact']) ?></td><td><?= e($r['email']) ?></td><td><a class="btn red" onclick="return confirmDelete()" href="delete.php?id=<?= $r['id'] ?>">Delete</a></td></tr><?php endwhile; ?>
</table></div>
<?php include "../includes/footer.php"; ?>
