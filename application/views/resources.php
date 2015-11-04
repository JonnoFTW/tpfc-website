<div class="col-md-12">
<div class="panel panel-default">
	<h2>
		<a href="#" id="toggle-tables">Forms</a>
	</h2>
<div class="table table-striped" id="tables">
<? foreach($forms as $category => $val){?>
		<table>
			<colgroup>
				<col class="colA" />
				<col class="colB" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="table-head"><? echo $category;?></th>
				</tr>
				<tr>
					<th>Link</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
<?
foreach($val as $i){
	echo "<tr><th class=\"fixed\">".anchor('assets/documents/'.$i['file'],$i['title'])."</th><td>{$i['description']}</td></tr>";
}

 ?>
			</tbody>
		</table>
        <? } ?>
	</div>
</div>
