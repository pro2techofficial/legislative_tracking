<?php include "../includes/header.php";
if(isset($_POST['save'])){
    $session_no=mysqli_real_escape_string($conn,$_POST['session_no']);
    $session_date=$_POST['session_date']; $session_time=$_POST['session_time'];
    $venue=mysqli_real_escape_string($conn,$_POST['venue']);
    $presiding=mysqli_real_escape_string($conn,$_POST['presiding_officer']);
    $agenda=mysqli_real_escape_string($conn,$_POST['agenda']);
    $minutes=mysqli_real_escape_string($conn,$_POST['minutes']);
    mysqli_query($conn,"INSERT INTO sessions(session_no,session_date,session_time,venue,presiding_officer,agenda,minutes) VALUES('$session_no','$session_date','$session_time','$venue','$presiding','$agenda','$minutes')");
    log_action($conn,"Added session $session_no","Sessions");
    header("Location: index.php"); exit();
}
$items=mysqli_query($conn,"SELECT * FROM sessions ORDER BY session_date DESC");
?>
<div class="topbar"><div><h1>Sessions</h1><p class="subtitle">Schedule regular/special sessions and record agendas/minutes.</p></div><button onclick="window.print()" class="btn gray">Print</button></div>
<div class="panel">
<form method="POST" class="form-grid">
<div><label>Session No.</label><input name="session_no" required></div>
<div><label>Date</label><input type="date" name="session_date" required></div>
<div><label>Time</label><input type="time" name="session_time"></div>
<div><label>Venue</label><input name="venue"></div>
<div class="form-full"><label>Presiding Officer</label><input name="presiding_officer"></div>
<div class="form-full"><label>Agenda</label><textarea name="agenda"></textarea></div>
<div class="form-full"><label>Minutes</label><textarea name="minutes"></textarea></div>
<div><button class="btn" name="save">Save Session</button></div>
</form>
</div>
<div class="panel table-wrap"><table><tr><th>Session</th><th>Date</th><th>Time</th><th>Venue</th><th>Presiding Officer</th><th>Agenda</th><th>Minutes</th></tr>
<?php while($r=mysqli_fetch_assoc($items)): ?><tr><td><?= e($r['session_no']) ?></td><td><?= e($r['session_date']) ?></td><td><?= e($r['session_time']) ?></td><td><?= e($r['venue']) ?></td><td><?= e($r['presiding_officer']) ?></td><td><?= nl2br(e($r['agenda'])) ?></td><td><?= nl2br(e($r['minutes'])) ?></td></tr><?php endwhile; ?>
</table></div>
<?php include "../includes/footer.php"; ?>
