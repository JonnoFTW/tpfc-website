<div class="panel panel-default">
<div class="panel-body">
<div class="col-md-12">
<div class="block" id="tables">
		<table class="table table-striped">
			<colgroup>
				<col class="colA" />
				<col class="colB" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="table-head">General Documents</th>
				</tr>
				<tr>
					<th>Link</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
<?
function form($i){
	echo "<tr><th>".anchor('download/get/'.$i['fid'],str_replace('-', ' ',$i['name']))."</th><td>{$i['description']}</td></tr>";
}
foreach($res as $i){form($i);}
 ?>
			</tbody>
		</table>
		<table class="table table-striped">
			<colgroup>
				<col class="colA" />
				<col class="colB" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="table-head">Competition Documents</th>
				</tr>
				<tr>
					<th>Link</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
<?
foreach($comp as $i){
	form($i) ;
}
 ?>
 			</tbody>
		</table>
	</div>

</div>
</div>
