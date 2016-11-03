<div class="col-md-9" id="table">
<div class="panel panel-default">
<div class="panel panel-heading">				
Attendance for <? echo date('l jS F Y'); ?>
<span class="counter pull-right" style="padding:8px;"></span>
</div>
<table class="table table-striped table-hover results">
<thead>
 <tr> 
  <th>Name</th>
  <th>Present</th>
 </tr> 
 </thead>
<tbody id="member-table">
<?
foreach($members as $m) {
    echo "<tr>";
    $cake = '';
    if ($m['dob']) {
        $dt = DateTime::createFromFormat('Y-m-d',$m['dob']);
     
        $now = new DateTime();    
        $nowBd = DateTime::createFromFormat('Y-m-d',$now->format('Y-').$dt->format('m-d'));
        
        $diff_tobd = abs($nowBd->diff($now)->days);
        
        if($diff_tobd <= 7)
            $cake = '<i class="fa fa-birthday-cake" aria-hidden="true"></i>';
   
    }
    echo "<td>$dt <a href='/admin/members/show/{$m['id']}'>{$m['name']}</a> {$cake}</td><td>";
    $present = in_array($m['id'], $attending);
    echo "<button type='button' class='btn btn-default btn-lg attended' id='{$m['id']}' ".($present?'disabled':'')."><i class='fa fa-user-plus' aria-hidden='true'></i> ".($present?'Present':'')."</button>";
    
    echo "</td></tr>";
}

?>
</tbody>
</table>
<script>
$('.attended').click(function() {
    var uid = $(this).attr('id');
    var $btn = $(this);
    $.post('/admin/members/set_attended/'+uid+'/<? echo $today ?>', function(data) {
        console.log(data);
        if(data.status == "User attended") {
            $btn.prop('disabled', true);
            
            $btn.append(' Present');
        } else {
            // Error!
        }
    });
});
</script>
