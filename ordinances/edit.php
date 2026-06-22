<?php include "../includes/header.php";
$id=(int)($_GET['id'] ?? 0);
$item=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ordinances WHERE id=$id"));
if(!$item){ echo "<div class='panel'>Record not found.</div>"; include "../includes/footer.php"; exit(); }
$statuses = ['Draft','Filed','Committee Review','First Reading','Second Reading','Public Hearing','Third Reading','Approved','Rejected','Implemented'];
if(isset($_POST['update'])){
    $no=mysqli_real_escape_string($conn,$_POST['no']);
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $author=mysqli_real_escape_string($conn,$_POST['author']);
    $committee=mysqli_real_escape_string($conn,$_POST['committee']);
    $date_filed=$_POST['date_filed'];
    $status=mysqli_real_escape_string($conn,$_POST['status']);
    $remarks=mysqli_real_escape_string($conn,$_POST['remarks']);
    $file=$item['file_path'];
    $newFile=upload_document('document');
    if($newFile) $file=$newFile;
    mysqli_query($conn,"UPDATE ordinances SET ordinance_no='$no', title='$title', author='$author', committee='$committee', date_filed='$date_filed', status='$status', file_path='$file', remarks='$remarks' WHERE id=$id");
    mysqli_query($conn,"INSERT INTO tracking_history(legislation_type, legislation_id, status, remarks, updated_by) VALUES('Ordinance','$id','$status','$remarks','".$_SESSION['user_id']."')");
    log_action($conn,"Updated ordinance $no","Ordinance");
    header("Location: index.php"); exit();
}
?>
<div class="topbar"><div><h1>Edit Ordinance</h1><p class="subtitle">Update details and legislative status.</p></div><a href="index.php" class="btn gray">Back</a></div>
<div class="panel">
<form method="POST" enctype="multipart/form-data" class="form-grid">
  <div><label>Ordinance Number</label><input name="no" value="<?= e($item['ordinance_no']) ?>" required></div>
  <div><label>Date Filed</label><input type="date" name="date_filed" value="<?= e($item['date_filed']) ?>"></div>
  <div class="form-full"><label>Title</label><input name="title" value="<?= e($item['title']) ?>" required></div>
  <div><label>Author</label><input name="author" value="<?= e($item['author']) ?>"></div>
  <div><label>Committee</label><input name="committee" value="<?= e($item['committee']) ?>"></div>
  <div><label>Status</label><select name="status"><?php foreach($statuses as $s): ?><option <?= $item['status']==$s?'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select></div>
  <div><label>Replace Document</label><input type="file" name="document"><?php if($item['file_path']): ?><small>Current: <a target="_blank" href="/mlts/<?= e($item['file_path']) ?>">View file</a></small><?php endif; ?></div>
  <div class="form-full"><label>Remarks</label><textarea name="remarks"><?= e($item['remarks']) ?></textarea></div>
  <div class="form-full"><button class="btn" name="update">Update Ordinance</button></div>
</form>
</div>
<?php include "../includes/footer.php"; ?>
