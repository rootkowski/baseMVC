<?php
/**
 * Description of LoadEditor Class
 * Loads the selected WYSIWYG editor for use in blogs, forums etc.
 *
 * @author przemek rutkowski
 */
class LoadEditor
{

	/*
	 * Loads the editor of choice
	 * @params: string: available choices: markitup (default), wymeditor
	 * @return: void
	 */
	public function chooseEditor( $editor = 'markitup' )
	{
		if( file_exists(VIEWS . DS . $editor . '.php') )
			require_once VIEWS . DS . $editor . '.php';
		else
			require_once VIEWS . DS . 'markitup.php';
	}


}
?>
