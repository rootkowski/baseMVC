<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo Page::$config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Page::$config['css']; ?>" />
</head>
<body>
	<div id="wrapper">
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
		<div id="nav" class="clr">
			<ul>
				<?php echo Page::$config['menu']; ?>
			</ul>
		</div>
