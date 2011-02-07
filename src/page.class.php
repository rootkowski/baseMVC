<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Description of page class
 *
 * @author Przemek Rutkowski
 */

class Page extends Authorise
{

	private static $path = array(
		'header' => 'header.php',
		'footer' => 'footer'
	);

//	private $mysqli = '';

	public static $config = array(
		'css'   => 'BASE_URL . DS . css/default.css',
		'title' => 'baseMVC',
		'menu'  => '',
		'error' => ''
	);
	
	/*
	 * Store a reference to the database instance.
	 * Initialized in the constructor.
	 */
	protected $db = '';

	private $content_data = array();
	
	private $current_url = REFR_URL;


	/*
	 * Checks for DB object instance, connects to db
	 * $return: void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setReturnURL( REFR_URL );
		$this->db = &DB::getInstance();
	}


	/*
	 * Sets page title, menu and loads header file
	 * @params: string
	 * @return: void
	 */
	public function header($title)
	{
		if( !empty( $title ) )
			self::$config['title'] = $title;

		$this->setMENU();
		
		require_once VIEWS . DS . self::$path['header'];
	}


	/*
	 * Loads footer file
	 * @params:
	 * @return: void
	 */
	public function footer( $editor = 'markitup' )
	{
		$this->view(self::$path['footer'], $editor);
	}


	/*
	 * Loads main content file and stores content data
	 * @params: string, object/array
	 * @return: void/error
     *
     * @todo: this function does two things, perhaps it should be split in 2
     * @todo: remove the warning in the else statement. too helpful to hackers!
	 */
	public function view($view, $data)
	{
		// recieves data from controller, extracts and sends on to viewer
		if( is_file(VIEWS . DS . $view . '.php') )
		{
			$this->content_data = $data;
			require_once VIEWS . DS . $view . '.php';
		}
		else
			header('HttpResponse: 404');
	}


	/*
	 * Sets a different path for header and footer
	 * Potentially a security whole
	 * @params: string['header' || 'footer'], string
	 * @return: void
	 */
	private function setPath($key, $value)
	{
		$this->path[$key] = $value;
	}




	function setCSS( $css = 'css/default.css' )
	{
		if( !empty($css) )
			self::$config['css'] = $css;
	}




	
	private function setMENU()
	{
		$tmp_menu = unserialize(Page_MENU);

		foreach( $tmp_menu as $key => $value )
		{
			self::$config['menu'] .= "<li><a href=\"$value\">$key</a></li>
				";
		}
	}




	public function outputContent( $string )
	{
		//return htmlentities($string, ENT_QUOTES, 'UTF-8');
		return strip_tags($string, '<p><a><h1><h2><h3><h4><h5><h6>');
	}
}
?>
