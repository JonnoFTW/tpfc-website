<div class="col-md-12" id="table">
<div class="panel panel-default">
<div class="panel-heading">				
Club Members  <button type="button" class="btn btn-default btn-xs" id="new-user"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
<div class="dropdown pull-right">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-hidden='true' id="radius-label">Year: <? echo $year_date->format('Y'); ?><b class="caret"></b></a>

    <ul class="dropdown-menu" role="menu" aria-labelledby="radius-label">
    <?
        foreach($years as $y) {
            echo "<li>".anchor('admin/members?year='.$y.'#table', $y)."</li>";
        }
    ?>
           
    </ul>
</div>
</div>
<table class="table table-striped table-hover">
<thead>
 <tr> 
  <th>Edit</th>
  <th>Name</th>
  <th>Email</th>
  <th>Address</th>
  <th>Telephone</th>
  <th>Mobile</th>
  <th>Hand</th>
  <th>DOB</th>
  <th>Age</th>
     </tr> 
 </thead>
 <tbody id="member-table">
<?
echo $member_table;
?>
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th>Thing</th><th>Count</th>
</tr>
</thead>
<tbody>
<?
foreach($summary as $k=>$v) {
    echo "<tr><td>".ucwords($k)."</td><td>$v</td></tr>";
}
?>
</tbody>
</table>
</div>
</div>
<script type='text/javascript'>
String.prototype.format = function () {
  var i = 0, args = arguments;
  return this.replace(/{}/g, function () {
    return typeof args[i] != 'undefined' ? args[i++] : '';
  });
};

var doRow = function(newUser) {
    var mid, row, vals = {};
    var keys = 'name,email,address,telephone,mobile,handedness,dob,age'.split(',');
    if(newUser) {
        mid = 'new';
        row = this;
    } else {
        row = $(this).parent();
        mid = $(this).parent().data('id');
        var cells = $(this).siblings();
        
    }
    for(var i =0; i < keys.length; i++) {
        if(newUser)
            vals[keys[i]] = '';
        else
            vals[keys[i]] = $(cells.get(i)).text();
    }
//    console.log(row);
    // swap in the form for the row
    

    var html = '<td><div class="btn-group" role="group"><button type="button" id="save-{}"  data-id="{}" class="btn btn-default btn-xs btn-secondary"><i class="fa fa-save"></i></button><button type="button" id="delete-{}"  data-id="{}" class="btn btn-default btn-xs btn-secondary"><i class="fa fa-user-times"></i></button></div></td>'.format(mid, mid, mid, mid);
    html += '<td><input class="form-control input-sm" placeholder="Lastname, FirstName" type="text"      name="{}" value="{}"/></td>'.format('name', vals.name);
    html += '<td><input class="form-control input-sm" type="email" placeholder="email@provider.com"  name="{}" value="{}"/></td>'.format('email',vals.email);
    html += '<td><input class="form-control input-sm" type="text" placeholder="123 Example Street, Suburb 5158" name="{}" value="{}"/></td>'.format('address',vals.address);
    html += '<td><input class="form-control input-sm" type="telephone" placeholder="8322 1234" name="{}" value="{}"/></td>'.format('telephone',vals.telephone);
    html += '<td><input class="form-control input-sm" type="telephone" placeholder="0401 234 123" name="{}" value="{}"/></td>'.format('mobile',vals.mobile);
    var sel = "selected";
    html += '<td><select class="selectpicker form-control" data-style="btn btn-default btn-sm" name="hand" data-width="fit"><option value="R" {}>R</option><option value="L" {}>L</option></select></td>'.format(vals.hand=='R'?sel:'',vals.hand=='L'?sel:'');
    html += '<td><input name="dob" placeholder="dd/mm/yyyy" type="text" class="form-control input-sm datepicker" value="{}"/></td>'.format(vals.dob);
    html += '<td id="age-{}">{}</td>'.format(mid, vals.age);
    row.html(html);
    $('.selectpicker').selectpicker();
    var dob = vals.dob.split('/');
    var saving = false;
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        toggleActive: true,
        immediateUpdates: true,
        defaultViewDate: { year: dob[2], month: dob[1], day: dob[0] }
    }).on('changeDate', function(ev) {
        // update their age
        console.log(ev);
        var diff = moment([<? echo $year_date->format('Y'); ?>,1,1]).diff(moment(ev.date), 'years');
       console.log(diff);
        $('#age-'+mid).text(diff);
    });
    $('#delete-'+mid).click(function() {
        if(mid=='new') {
            row.remove();
            return;
        }
        var r = confirm("Delete user: '{}'?".format($(this).parent().parent().siblings().first().find('input').val()));
        if(r) {
            // do the delete
            $.post('/admin/members/delete', {id:mid}, function(data) {
                // deleted!
                row.remove();
            });
        } 
    });
    $('#save-'+mid).click(function() { 
        if (saving)
            return;
        // save the form contents
        // for each of the keys, get the input in this row
        var _mid = $(this).data('id');
        var obj = _.object(
            _.map(keys.slice(0,-1), function(key){
                return [key, $('tr#member-'+_mid).find('[name={}]'.format(key)).val()];
            })
        );
        obj.dob = obj.dob.split('/').reverse().join('-');
        // should make the save button into a spinning load thingo
        var btn = $('#save-'+mid);
        var i = btn.find('.fa');
        i.removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
        saving = true;
        var url = '/admin/members/update/'+mid;
        if (newUser) 
            url = '/admin/members/create';
        var doError = function(msg, success=false) {
            if(success) {
                var message = $('<div class="alert alert-success error-message" style="display:none;" role="alert">');
            } else {
                i.attr('class', 'fa fa-save');
                var message = $('<div class="alert alert-danger error-message" style="display:none;" role="alert">');
            }
            
            
            var btnPos = btn.offset();
            message.css({left: btnPos.left+'px', top:(btnPos.top+2*btn.height())+'px'});
            var close = $('<button type="button" class="close" data-dismiss="alert">&times</button>');
            message.append(close); // adding the close button to the message
            message.append(msg); // adding the error response to the message
            // add the message element to the body, fadein, wait 3secs, fadeout
            message.appendTo($('body')).fadeIn(300).delay(3000).fadeOut(500);
        };
        $.post(url, obj , function(data) {
            saving = false;
            if(data.status !== 1) {
                doError(data.html);
            } else {
                // success! remake the table row using the returned data
                i.attr('class', 'fa fa-edit');
                doError('Updated!', true);
                var row = $('tr#member-'+mid).replaceWith(data.html);
                
            }
        }).fail(function() {
            saving = false;
            doError("Server Error");
        });
    });
}

$('#member-table').on('click', '.edit-user', function() {
    doRow.call(this, false);
});
$('#new-user').click(function() {
    var row = $('<tr id="member-new" data-id="new"></tr>').insertBefore('tbody#member-table tr:first');
    doRow.call(row, true);
});

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.en-AU.min.js"></script>

