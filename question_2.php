<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Class Customer
 */
abstract class Customer {
	protected $id;
	protected $balance = 0;

	public function __construct($id) {
		$this->id = $id;
	}

	public function get_balance() {
		return $this->balance;
	}
}


// Write your code below
class Database {
    protected $DB_HOST;
    protected $DB_NAME;
    protected $DB_USER;
    protected $DB_PASS;
    private $mysqli;

    /**
     * database constructor.
     */
    public function __construct() {
        $this->DB_HOST = 'localhost';
        $this->DB_NAME = 'test';
        $this->DB_USER = 'test';
        $this->DB_PASS = 'test';
        $this->mysqli = new \mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function check_username($username){
        $username = mysqli_real_escape_string($this->mysqli, $username);
        $sql = 'SELECT first_name FROM customer WHERE username = "'.$username.'"';
        $result = $this->mysqli->query($sql);
        return ($result->num_rows > 0) ? $result : false;
    }

    /**
     * Close database connection
     * @return bool
     */
    public function close(){
        return mysqli_close($this->mysqli);
    }


    /**
     * Generate Random string
     * @param int $length maximum string generate
     * @param int $min minimum string generate
     * @return string
     */
    public function randomString($length = 30, $min=8) {
        $str = "";
        $characters = array_merge(range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        $randomLength = mt_rand($min, $length);
        for ($i = 0; $i < $randomLength; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}


/**
 * Class Bronze_Customer
 * @package SoftwareEngineerTest
 */
class Bronze_Customer extends Customer {

	/**
	 * Bronze customers do not receive any extra credits
	 * @param $amount
	 */
	public function deposit($amount){
		$this->balance = $this->get_balance() + $amount;
	}

	/**
	 * Instantiate the correct object for customer ID
	 * @return bool
	 */
	public function get_instance(){
		$id= $this->id;
		if (strlen($id) <=10 && substr($id,0,1) == 'B') {
			return true;
		}
		else {
			throw new \InvalidArgumentException('Invalid customer ID');
		}
	}

    /**
     *  Generate unique random username
     * @return string
     */
    public function generate_username(){
        $flag = true;
        $db = new Database();
        $username = '';
        while($flag){
            $username = 'B'.$db->randomString();
            $result = $db->check_username($username);
            if (!$result){
                //username is unique now
                $flag = false;
            }
        }
        $db->close();
        return $username;
    }
}

/**
 * Class Silver_Customer
 * @package SoftwareEngineerTest
 */
class Silver_Customer extends Customer {

	/**
	 * Silver customers get 5% extra credit added their account balance
	 * @param $amount
	 */
	public function deposit($amount){
		$this->balance = $this->get_balance() + $amount * (1.05);
	}

    /**
     * Instantiate the correct object for customer ID
     * @return bool
     */
    public function get_instance(){
        $id= $this->id;
        if (strlen($id) <=10 && substr($id,0,1) == 'S') {
            return true;
        }
        else {
            throw new \InvalidArgumentException('Invalid customer ID');
        }
    }

    /**
     *  Generate unique random username
     * @return string
     */
    public function generate_username(){
        $flag = true;
        $db = new Database();
        $username = '';
        while($flag){
            $username = 'S'.$db->randomString();
            $result = $db->check_username($username);
            if (!$result){
                //username is unique now
                $flag = false;
            }
        }
        $db->close();
        return $username;
    }

}

/**
 * Class Gold_Customer
 * @package SoftwareEngineerTest
 */
class Gold_Customer extends Customer {

	/**
	 * Gold customers get 10% extra credit added to their account balance
	 * @param $amount
	 */
	public function deposit($amount){
		$this->balance = $this->get_balance() + $amount * (1.1);
	}

    /**
     * Instantiate the correct object for customer ID
     * @return bool
     */
    public function get_instance(){
        $id= $this->id;
        if (strlen($id) <=10 && substr($id,0,1) == 'G') {
            return true;
        }
        else {
            throw new \InvalidArgumentException('Invalid customer ID');
        }
    }

    /**
     *  Generate unique random username
     * @return string
     */
    public function generate_username(){
        $flag = true;
        $db = new Database();
        $username = '';
        while($flag){
            $username = 'G'.$db->randomString();
            $result = $db->check_username($username);
            if (!$result){
                //username is unique now
                $flag = false;
            }
        }
        $db->close();
        return $username;
    }

}