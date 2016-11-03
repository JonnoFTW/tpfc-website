<div class="col-md-9" id="table">
<div class="panel panel-default">
<div class="panel panel-heading">				
Show User
<span class="counter pull-right" style="padding:8px;"></span>
</div>
<div class="panel panel-body">
<div class="col-md-3">
<h4> <? echo $user['name'];?></h4>
<?
foreach($user as $k=>$m) {
echo "<b>".ucwords($k)."</b>: $m</br>";
}  
?>
</div>
<div class="col-md-3">
<?
echo heading("Registrations", 5);
foreach($registrations as $r) {
    echo "{$r['year']}- {$r['level']}<br>";
}
?>
</div>
<div class="col-md-3">
<?

echo heading("Attendance", 5);
foreach($attendance as $r) {
    echo "{$r['date']}<br>";
}
?>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>

</script>
