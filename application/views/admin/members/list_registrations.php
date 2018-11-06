<div class="col-md-9" id="table">
<div class="panel panel-default">
<div class="panel panel-heading">				
Club Registrations <button class="btn btn-primary btn-sm" id="save">Save</button>
<div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="Name"/>
</div> 
<span class="counter pull-right" style="padding:8px;"></span>
</div>
<div class="panel panel-body">
 <h4>Registrations should be in format year-level</h4>Levels are: <? echo join(', ',$member_types); ?>
 </div>
<table class="table table-striped table-hover results">
<thead>
 <tr> 
  <th>Name</th>
  <th>Years</th>
 </tr> 
 </thead>
<tbody id="member-table">
<?
$years_registered = [];
foreach($members as $m) {
    $years_registered[$m['member_id']]['years'][] = ['level'=>$m['level'],'year'=>$m['year']];
    $years_registered[$m['member_id']]['member_id'] = $m['member_id'];
    $years_registered[$m['member_id']]['name'] = $m['name'];
}
usort($years_registered, function($a, $b){return strcmp($a['name'],$b['name']);});
/*echo "<pre>";
//var_dump($members);
var_dump($years_registered);
echo "</pre>";*/
foreach($years_registered as $k=>$m) {
    echo "<tr data-id='{$m['member_id']}'><td class='col-md-2'><a href='/admin/members/show/{$m['member_id']}'>{$m['name']}</a></td><td class='col-md-10'><select multiple class='select2' style='width:100%' name='member-{$k}'>";
    foreach($m['years'] as $y) 
         echo "<option selected='selected'>{$y['year']}-{$y['level']}</option>\n";
    
    echo "</select></td></tr>\n";
}
?>

</tbody>
</table>

<script>
$(".select2").select2({
  tags: true,
  createTag: function(params) {
      var stuff = $.trim(params.term).split('-');
      if (stuff.length != 2) {
        return null;
      }
      var year = stuff[0];
      var level = stuff[1];
      if(year.match(/^\d{4}$/) && parseInt(year) > 1990 && ['club','state'].indexOf(level) >= 0) {
        // actual year
        var str = stuff.join('-');
        return {
        text: str,
        id: str
    }
      } else {
        return null;
      }
  }
}).on('change', function(e) {
    $(this).attr('changed','true');
});
$('button#save').click(function() {
    // gotta save em all
    var users = {};
    // users.user-id = "2012,2013"
    $('select.select2[changed]').each(function() {
        users[$(this).attr('name').split('-')[1]] = $(this).val();
    });
    $.post('/admin/members/update_registration', users, function() {
        console.log('Updated reigstrations');
    });
});
$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });
    var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item'+(jobCount>1?'s':''));

  if(jobCount == '0') {$('.no-result').show();}
  else {$('.no-result').hide();}
});
});
</script>
