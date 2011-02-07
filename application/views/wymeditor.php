<?php
/* 
 * Provides all textarea instances with WYMeditor
 */

?>

	<script type="text/javascript" src="js/wymeditor/jquery.wymeditor.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('textarea').wymeditor();
		});
	</script>