</div>
<footer class="clr">
		Copyleft Przemek R. 2009 - 2011 
		<a href="https://github.com/rootkowski/baseMVC" title="Get the code at GitHub.com">Get The Code</a>
		<!-- Validate:
		<a href="http://validator.w3.org/check?uri=referer">XHTML Strict</a> 
		<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> 
		<a href="http://validator.w3.org/checklink?uri=<?php /*echo REFR_URL;*/ ?>">Links</a>-->
</footer>
</div>
	
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/msg_func.js"></script>
<!-- 	<script type="text/javascript" src="js/ajax.js"></script> -->
<?php 
/*
 * todo: Would be nice to move the following to a controller.
 */
if( in_array('LoadEditor', get_declared_classes() ) && $this->load_editor === true ) :
	$this->LoadEditor->chooseEditor( $this->content_data );
?>
	<!--script type="text/javascript" src="js/jquery.autosave.js"></script-->
	<script type="text/javascript" src="js/autosave.js"></script>
<?php endif; ?>
</body>
</html>