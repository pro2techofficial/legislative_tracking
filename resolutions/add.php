<?php include "../includes/header.php";
$statuses = ['Draft','Filed','Committee Review','First Reading','Second Reading','Public Hearing','Third Reading','Approved','Rejected','Implemented'];
if(isset($_POST['save'])){
    $no=mysqli_real_escape_string($conn,$_POST['no']);
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $author=mysqli_real_escape_string($conn,$_POST['author']);
    $committee=mysqli_real_escape_string($conn,$_POST['committee']);
    $date_filed=$_POST['date_filed'];
    $status=mysqli_real_escape_string($conn,$_POST['status']);
    $remarks=mysqli_real_escape_string($conn,$_POST['remarks']);
    $file=upload_document('document');
    mysqli_query($conn,"INSERT INTO resolutions(resolution_no,title,author,committee,date_filed,status,file_path,remarks) VALUES('$no','$title','$author','$committee','$date_filed','$status','$file','$remarks')");
    $id=mysqli_insert_id($conn);
    mysqli_query($conn,"INSERT INTO tracking_history(legislation_type, legislation_id, status, remarks, updated_by) VALUES('Resolution','$id','$status','$remarks','".$_SESSION['user_id']."')");
    log_action($conn,"Added resolution $no","Resolution");
    header("Location: index.php"); exit();
}
?>
<div class="topbar"><div><h1>Add Resolution</h1><p class="subtitle">Encode new legislative record.</p></div><a href="index.php" class="btn gray">Back</a></div>
<div class="panel">
<form method="POST" enctype="multipart/form-data" class="form-grid">
  <div><label>Resolution Number</label><input name="no" required></div>
  <div><label>Date Filed</label><input type="date" name="date_filed"></div>
  <div class="form-full"><label>Title</label><input name="title" required></div>
  <div><label>Author</label><input name="author"></div>
  <div><label>Committee</label><input name="committee"></div>
  <div><label>Status</label><select name="status"><?php foreach($statuses as $s): ?><option><?= $s ?></option><?php endforeach; ?></select></div>
  <div><label>Upload Document</label><input type="file" name="document"></div>
  <div class="form-full"><label>Remarks</label><textarea name="remarks"></textarea></div>
  <div class="form-full"><button class="btn" name="save">Save Resolution</button></div>
</form>
</div>
<?php include "../includes/footer.php"; ?>
