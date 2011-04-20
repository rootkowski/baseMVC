<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Blog Controller File
 */


class Blog extends Page
{

	function  __construct()
	{
		parent::__construct();
		Page::header('baseMVC - Blog');
	}
	

}

$blog = new Blog();

$autId = isset($_GET['id']) ? " WHERE SiteUsers.id = {$_GET['id']}" : '';

$data = $blog->callSelectSP('SELECT * FROM (BlogContent left outer join SiteUsers on authorId = SiteUsers.id)'. $autId . ' ORDER BY date DESC');

$blog->view('blog_view', $data);


/*
 * @todo: Module paths and locations (pages on which they should be viewed) should be stored in a db
 */

?>
	
	<aside>
	
	<!-- navigation div with all authors, 10 latest posts, style chooser and RSS -->
	<!--div id="modules">
		<div class="navModule">
			<h3>Our Authors</h3>
			<ul-->
				
			<?php

//			$get_authors = $blog->callSelectSP('SELECT * FROM BlogAuthors GROUP BY name');
			
//			$queryAuthors = "SELECT * FROM BlogAuthors GROUP BY name";
//			$resultAuthors = $mysqli->query($queryAuthors) or die("Could not query database");
//
//			while($row = $resultAuthors->fetch_object()) {
//				echo "<li><a href='?id={$row->id_Author}' title='View all posts by {$row->name}'>" . $row->name . "</a><span><br/>{$row->info}</span></li>";
//			}
			
			?>
			
			<!--/ul>
		</div-->
		<!--div class="navModule">
			<h3>Latest Posts</h3>
			<ul-->
				
			<?php
			
//			$queryLatest = "SELECT * FROM BlogContent ORDER BY date DESC LIMIT 10";
//			$resultLatest = $mysqli->query($queryLatest) or die("Could not query database");
//
//			while( $row = $resultLatest->fetch_object() ) {
//				echo "<li><a href='?page=article&amp;id={$row->id_Content}'>" . $row->title . "</a></li>";
//			}
			
			?>
				
			<!--/ul>			
		</div-->
		<!--div class="navModule">
			<h3>Style Chooser</h3>
			<form method="post" action="">
				<fieldset>
				<button type="submit" id="defaultCSS" name="defaultCSS">Default Style</button>
				<button type="submit" id="alternateCSS" name="alternateCSS">Alternate Style</button>
				</fieldset>
			</form>
		</div-->
		<div class="navModule">
			<h3>Get The Latest News</h3>
			<p><a href="?page=feed" title="Subscribe to our RSS feed"><img src="<?php echo TMPL_URL . DS; ?>img/rss.png" alt="feed icon" /></a></p>
		</div>
	</aside>
		<?php 	
	//	$resultAuthors->free();
	//	$resultLatest->free();
	//	$result->free();
	//	$mysqli->close();
	
	$blog->close_connection();
	$blog->footer();
	?>
	</div>
	