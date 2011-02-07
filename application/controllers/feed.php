<?php 

header("Content-Type: application/xml; charset=ISO-8859-1");

require_once BASEPATH . DS . 'rss.class.php';

$rss = new RSS();
echo $rss->getFeed();

?>