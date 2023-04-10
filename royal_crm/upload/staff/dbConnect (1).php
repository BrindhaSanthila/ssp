<?php 
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
class DatabaseConnection {
    //put your code here
    private static $instance;   
    // the actual connection resource
    private $conn;
    // the hostname for the database server
    private $hostname;
    // the name of the database to use
    private $database;
    // the username to use to access the database
    private $username;
    // the password to use to access the database
    private $password;

    function __construct() {		
		
		
		if(($_SERVER['HTTP_HOST']=="192.168.1.110")||($_SERVER['HTTP_HOST']=="sd4-6"))
		{
			$this->database = "thiraviam_hotel";
			$this->hostname = "localhost";
			$this->username = "thiravia_SWETlkdfUYIRFfff";
			$this->password = "WERIUGJG1NVGXkd*rSj0";
			
			define( DBHOST, "localhost",true );
			define( DBUSER, "root",true );
			define( DBPASS, "",true );
			define( DBNAME, "thiraviam_hotel",true );
		}
		else
		{
			$this->database = "womensho_hostel";
			$this->hostname = "localhost";
			$this->username = "womensho_stelin";
			$this->password = "0]!=K;2ox4h_"; 
			
			define( DBHOST, "localhost",true );
			define( DBUSER, "womensho_stelin",true );
			define( DBPASS, "0]!=K;2ox4h_",true );
			define( DBNAME, "womensho_hostel",true );

		}
    }	    

    function serverConnection()
	{
        if (is_null($this->database))
        die("MySQL database not selected");
        if (is_null($this->hostname))
        die("MySQL hostname not set");
        $this->conn = @mysql_connect($this->hostname, $this->username, $this->password);        		
        if ($this->conn === false)
        die("Could not connect to database. Check your username and password then try again.\n");
        if (!mysql_select_db($this->database, $this->conn)) {
            die("Could not select database");
        }
    }

	function close_connection() 
	{   		
	   mysql_close($this->conn); 
    }
}
$db =new DatabaseConnection;
$db->serverConnection();
?>