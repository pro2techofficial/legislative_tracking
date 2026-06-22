<?php include "../includes/header.php";
if(!is_admin()){ echo "<div class='panel'>Access denied.</div>"; include "../includes/footer.php"; exit(); }
if(isset($_POST['save'])){
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=md5($_POST['password']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
    mysqli_query($conn,"INSERT INTO users(fullname,username,password,role) VALUES('$fullname','$username','$password','$role')");
    log_action($conn,"Created user $username","Users");
    header("Location: index.php"); exit();
}
$items=mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");
?>
<div class="topbar"><div><h1>User Management</h1><p class="subtitle">Create system accounts for administrators, staff, and councilors.</p></div></div>
<div class="panel">
<form method="POST" class="form-grid">
<div><label>Full Name</label><input name="fullname" required></div>
<div><label>Username</label><input name="username" required></div>
<div><label>Password</label><input type="password" name="password" required></div>
<div><label>Role</label><select name="role"><option>Admin</option><option>Staff</option><option>Councilor</option></select></div>
<div><button class="btn" name="save">Create User</button></div>
</form>
</div>
<div class="panel table-wrap"><table><tr><th>Name</th><th>Username</th><th>Role</th><th>Status</th></tr>
<?php while($r=mysqli_fetch_assoc($items)): ?><tr><td><?= e($r['fullname']) ?></td><td><?= e($r['username']) ?></td><td><?= e($r['role']) ?></td><td><?= e($r['status']) ?></td></tr><?php endwhile; ?>
</table></div>
<?php include "../includes/footer.php"; ?>
