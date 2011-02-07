<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * For tutorial see: http://www.webreference.com/authoring/languages/xml/rss/custom_feeds/
 */

class RSS {
	
	public function __construct() {
		
	}
	
	public function getFeed() {
		return $this->setDetails() . $this->getItems(); 
	}
	
	private function setDetails() {
		$details = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
   <channel>
      <title>baseMVC Blog</title>
      <link>http://www.student.bth.se/~prru09/kmom03/</link>
      <description>baseMVC is a project attempting to create a simple MVC-based CMS.</description>
      <language>en-gb</language>
      <webMaster>webmaster@rootkowski.com</webMaster>
XML;

		return $details;
	}
	
	private function getItems() {
		$mysqli = new mysqli(DB_host, DB_user, DB_pwd, DB_name);
		if(mysqli_connect_error()) {
			echo 'Connection failed: '.mysqli_connect_error()."<br/>";
			exit();
		}
		
		$query = "SELECT * FROM BlogContent ORDER BY date DESC LIMIT 8";
		$result = $mysqli->query($query);
		
		$items = '';
		
		while( $row = $result->fetch_object() ) {
			$items .= '
			<item>
				<title>'.$row->title.'</title>
				<link>'.BASE_URL.'?page=article&amp;id='.$row->id_Content.'</link>
				<description>'.$row->intro.'</description>
			</item>';
		}
		
		$items .= '
	</channel>
</rss>';
			
		return $items; 
	}
}
?>