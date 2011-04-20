<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link  href="http://fonts.googleapis.com/css?family=Droid+Sans:regular" rel="stylesheet" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo Page::$config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . DS . Page::$config['css']; ?>" />
</head>
<body>
	<div id="wrapper">
		<header>
<?php
if( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) :
?>
<div class="error"><?php echo $_SESSION['error_msg']; ?></div>
<?php
$_SESSION['error_msg'] = '';
endif;

if( isset($_SESSION['message']) && !empty($_SESSION['message']) ) :
?>
<div class="message"><?php echo $_SESSION['message']; ?></div>
<?php
$_SESSION['message'] = '';
endif;
?>
		<?php require_once 'loginmenu.php'; ?>
		<nav class="clr">
			<?php echo Page::$config['menu']; ?>
		</nav>
	</header>
	<div id="main">
