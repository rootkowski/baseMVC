<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$new_article = new NewBlogArticle();

if( isset($_POST['submit']) )
	$new_article->submitArticle();

if(!isset($_SESSION['fullname'])) :
	$_SESSION['error_msg'] = "<p>Login required to access the page</p>";
	$new_article->requireLogin( REFR_URL );
else :
	$new_article->header('baseMVC - ' . $_SESSION['fullname'] . ' - Add New Article');
	if( $new_article->blogWriter($_SESSION['uid']) ) :
		$new_article->viewNewArticleForm();

	else :
		$_SESSION['error_msg'] = 'You do not have the necessary privilliges to create a blog post';
		header('Location: ' . BASE_URL);
	endif;
	$new_article->footer();
endif;
