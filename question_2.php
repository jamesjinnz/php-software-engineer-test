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
}