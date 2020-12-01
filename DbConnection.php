<?php
/**
 * The file doc comment
 * php version 7.2.10
 * 
 * @category Class
 * @package  Package
 * @author   Original Author <author@example.com>
 * @license  https://www.cedcoss.com cedcoss 
 * @link     link
 */

/**
 * Template Class Doc Comment
 * 
 * Template Class
 * 
 * @category Template_Class
 * @package  Template_Class
 * @author   Arjun <author@domain.com>
 * @license  https://www.cedcoss.com cedcoss
 * @link     http://localhost/
 */
class DbConnection
{
    public $hostname;
    public $username;
    public $password;
    public $dbname;
    public $conn;

    /**
     * Constructor function
     */
    function __construct() 
    {
        $this->conn = new mysqli('localhost', 'root', '', 'cedcoss');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // echo "Connection Successfully";
            // return $this->conn;
        }
    }
}
$conn= new DbConnection();
?>