<?php

/*
 * ------------------------------------------------------------------------
 * Error reporting set to all for development only.
 * ------------------------------------------------------------------------
 * 
 */
error_reporting(E_ALL);

/*
 * ------------------------------------------------------------------------
 * Start new session
 * ------------------------------------------------------------------------
 * 
 */
session_start();


/*
 * ------------------------------------------------------------------------
 * Define Application Paths
 * ------------------------------------------------------------------------
 * 
 */
define( 'DS',    DIRECTORY_SEPARATOR );
define( 'ROOTPATH', dirname(__FILE__) );
define( 'BASEPATH',    dirname(__FILE__) . DS . 'src' );
define( 'APPLPATH',  dirname(__FILE__) . DS . 'application' );
define( 'MODELS', APPLPATH . DS . 'models' );
define( 'VIEWS',  APPLPATH . DS . 'views' );
define( 'CTRLS',  APPLPATH . DS . 'controllers' );


/*
 * ------------------------------------------------------------------------
 * Load main config file
 * ------------------------------------------------------------------------
 * 
 */
require_once BASEPATH . DS . 'config.php';

/*
 * ------------------------------------------------------------------------
 * Load all class files
 * ------------------------------------------------------------------------
 * 
 */
function __autoload( $class_name )
{
	if( is_file(BASEPATH . DS . strtolower($class_name) . '.class.php') )
		require_once BASEPATH . DS . strtolower($class_name) . '.class.php';

	if( file_exists(MODELS . DS . strtolower($class_name) . '.php') )
		require_once MODELS . DS . strtolower($class_name) . '.php';

	if( is_file(CTRLS . DS . strtolower($class_name) . '.php') )
		require_once CTRLS . DS . strtolower($class_name) . '.php';
}



/*
 * ------------------------------------------------------------------------
 * Check style cookies and set if necessary
 * ------------------------------------------------------------------------
 * 
 */
if( isset( $_POST['alternateCSS'] ) )
{
	setcookie('style', BASE_URL . DS . 'css/alt.css', time()+2592000);
	header('Location: ' . BASE_URL . DS);
}
elseif( isset ( $_POST['defaultCSS'] ) )
{
	setcookie('style', BASE_URL . DS . 'css/default.css', time()+2592000);
	header('Location: ' . BASE_URL . DS);
}

if( isset( $_COOKIE['style'] ) )
{
	Page::$config['css'] = $_COOKIE['style'];
}
elseif( !isset ( $_COOKIE['style'] ) )
{
	setcookie('style', BASE_URL . DS . 'css/default.css', time()+2592000);
	header('Location: ' . BASE_URL . DS);
}



/*
 * ------------------------------------------------------------------------
 * Front controller
 * ------------------------------------------------------------------------
 * 
 */
$content = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($content) {
	// Main Menu Pages
	case 'home':		require_once CTRLS . DS . 'home.php'; break;
	case 'blog':		require_once CTRLS . DS . 'blog.php'; break;
	case 'forum':		require_once CTRLS . DS . 'forum.php'; break;
	case 'restore_DB':	require_once CTRLS . DS . 'restoredb.php'; break;

	// forum pages
	case 'thread':		require_once CTRLS . DS . 'thread.php'; break;

	// User Pages
	case 'new_post':	require_once CTRLS . DS . 'adminusers/new_post.php'; break;
		
	case 'article':		require_once CTRLS . DS . 'blog_article.php'; break;
	case 'feed':		require_once CTRLS . DS . 'feed.php'; break;
	case 'login':		require_once CTRLS . DS . 'login.php'; break;
	case 'logout':		require_once CTRLS . DS . 'logout.php'; break;
	case 'profile':		require_once CTRLS . DS . 'userprofile/profile.php'; break;
	case 'admin':		require_once CTRLS . DS . 'adminusers/admin.php'; break;
	case 'manage':		require_once CTRLS . DS . 'adminusers/manage.php'; break;
	case 'edit':		require_once CTRLS . DS . 'adminusers/edit.php'; break;
	case 'delete':		require_once CTRLS . DS . 'adminusers/delete.php'; break;
	case 'addnew':		require_once CTRLS . DS . 'adminusers/new_blog_article.php'; break;
	case 'delComment':	require_once CTRLS . DS . 'adminusers/delete_comment.php'; break;
	case 'style':		require_once CTRLS . DS . 'styleswitch.php'; break;
	case 'feed':		require_once CTRLS . DS . 'feed.php'; break; 
		
	default:			require_once CTRLS . DS . 'home.php'; break;
}
