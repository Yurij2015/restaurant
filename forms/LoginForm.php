<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 6:14
 */

class LoginForm {
	private $email;
	private $password;

	/**
	 * @param array $data
	 */
	public function __construct( Array $data ) {
		$this->email = isset( $data['email'] ) ? $data['email'] : null;
		$this->password = isset( $data['password'] ) ? $data['password'] : null;
	}

	/**
	 * @return bool
	 */
	public function validate() {
		return ! empty( $this->email ) && ! empty( $this->password );
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword( $password ) {
		$this->password = $password;
	}

}