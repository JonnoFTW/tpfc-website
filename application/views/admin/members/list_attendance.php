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
    echo "<td class='col-md-5'>$dt <a href='/admin/members/show/{$m['id']}'>{$m['name']}</a> {$cake}</td><td class='col-md-7'>";
    $present = in_array($m['id'], $attending);
    echo "<button type='button' class='btn btn-default btn-lg attended' id='{$m['id']}' ><i id='icon-{$m['id']}' class='fa ".($present?'fa-user-times':'fa-user-plus')."' aria-hidden='true'></i> <span id='text-{$m['id']}'>".($present?'Present':'')."</span></button>";
    
    echo "</td></tr>";
}

?>
</tbody>
</table>
<script>
$('.attended').click(function() {
    var uid = $(this).attr('id');
    var $btn = $(this);
    var $btnText = $('span#text-'+uid);
    var icon = $('i#icon-'+uid);
    var url = $btn.text() != ' Present' ? '/admin/members/set_attended/'  : '/admin/members/unset_attended/';
    $.post(url+uid+'/<? echo $today ?>', function(data) {
        console.log(data);
        if(data.status == "User attended") {
            $btnText.text('Present');
            icon.removeClass('fa-user-plus');
            icon.addClass('fa-user-times');
        } else if (data.status == "Removed") {
            // Error!
            $btnText.text('');
            icon.removeClass('fa-user-times');
            icon.addClass('fa-user-plus');
        }
    });
});
</script>
