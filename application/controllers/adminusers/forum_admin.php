<?php
/* 
 * Forum Admin Model-Controller
 */

if(!isset($visited)) die('No direct access allowed!');

/**
 * Description of forum_admin
 *
 * @author przemek rutkowski
 */
class Forum_Admin extends Thread
{


	function __construct() {}




	function addCategory()
	{
		// insert new row into forum_categories table
	}




	function closeThread()
	{
		// set threads.writable to FALSE
	}
}
?>
