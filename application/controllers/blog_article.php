<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Article Controller
 *
 * Controls the Blog Article section
 */


$article = new BlogArticle();

if( isset($_POST['submit']) )
{
	if( !empty($_POST['comment']) )
		$article->submitComment();
}


$article->header($article->art_data['title']);
$article->view('blog_article_view', $article->art_data);
$article->footer();
