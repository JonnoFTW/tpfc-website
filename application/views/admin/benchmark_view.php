<script type="text/javascript" language="javascript">
// < ![CDATA[
    $(function() {
        var btn = "<div id='profiler_bar' style='background-color: green; width: 150px; height: 20px; padding: 2px; position: absolute; top: 5px; left: 0px; text-align: center; color: #FFF; font-family: Verdana, Geneva, sans-serif; filter: alpha(opacity=30); -moz-opacity: 0.30; opacity: 0.30;'><a href='#' id='profiler_btn' style='color: #FFF; text-decoration: none;'>SHOW PROFILER</a><a href='#' id='profiler_close_btn' style='color: #FFF; text-decoration: none; margin-left:10px'>X</a></div>"

		$('body').append(btn);

		$('#codeigniter_profiler').hide();
		$('#profiler_btn').click(function(){
			$('#codeigniter_profiler').toggle();

			if($('#codeigniter_profiler').is(':visible')) {
				$('#profiler_btn').text('HIDE PROFILER');
			} else {
				$('#profiler_btn').text('SHOW PROFILER');
			}

			return false;
		});
		$('#profiler_close_btn').click(function(){
			$('#profiler_bar, #codeigniter_profiler').hide();
			return false;
		});
    });
// ]]>
</script>
