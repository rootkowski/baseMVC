<?php

/**
 * Description of db class
 *
 * @author przemek rutkowski
 */
class DB {

	private $result;
	private $fetched_rows = array();

	protected static $_instance; // @todo: change to private and create methods for managing the instance instead of accessing it from child classes
	protected $count_rows;


	private function  __construct() { }
	private function  __clone() { }


	public static function getInstance()
	{
		if( self::$_instance === NULL)
			self::$_instance = new self();

		return self::$_instance;
	}


	protected function connect($host = DB_host, $user = DB_user, $pwd = DB_pwd, $db_name = DB_name)
	{
		self::$_instance = new mysqli($host, $user, $pwd, $db_name);
	}


	function  close_connection()
	{
		self::$_instance->close();
	}


	/*
   * @todo: might turn out to be completely redundant. Favour for callSelectSP()
	 * select - allows Read operations on a db
	 * @params: string
	 * @return: assoc array - query results
	 */
	public function select($query)
	{
		$this->fetched_rows = array();
		$this->result = self::$_instance->query($query);

		$this->count_rows = $this->result->num_rows;

		while( $row = $this->result->fetch_assoc() )
		{
			$this->fetched_rows[] = $row;
		}

		$this->result->free_result();

		return $this->fetched_rows;
	}




	protected function selectRow($query)
	{
		$this->result = self::$_instance->query($query);

		$row = $this->result->fetch_row();

		return $row;
	}



	/*
	 * insert - allows C-U-D operations on a db
	 * Access: public
	 * @params: string
	 * @return: int
	 */
	public function insert($query)
	{
		self::$_instance->query($query);

		return self::$_instance->affected_rows;
	}



  /*
   * Send a query to the db and ensure there'll be no leftovers in the buffer.
   * Access: public
   * @params: string
   * @return: array
   */
	public function callSelectSP($query)
	{
		$this->fetched_rows = array();
		if( self::$_instance->multi_query($query) )
		{
			if( $this->result = self::$_instance->use_result() )
			{
				while( $row = $this->result->fetch_assoc() )
					$this->fetched_rows[] = $row;

				$this->result->free();
			}

			while( self::$_instance->more_results() )
				self::$_instance->next_result();

		}

		return $this->fetched_rows;		
	}




    protected function callInsertSP($query)
    {
        self::$_instance->multi_query($query);

        while( self::$_instance->more_results() )
            self::$_instance->next_result();
		
        return self::$_instance->affected_rows;
    }



/*************************/
/* Functions to consider */
/*************************/
	function add($table_name, $data_array)
	{

	}

	function delete($table_name, $condition)
	{

	}

	function selectAll($table_name, $condition = '')
	{
		$sql = "SELECT * FROM " . $table_name . ' ' . $condition;

		//return $result->num_rows;
		return $this->db_query($sql);
	}

	function __select($cols, $table_name, $condition) // old query func above renamed to select
	{
		
	}

	function update($table_name, $condition, $data_array)
	{
		
	}
}
?>
