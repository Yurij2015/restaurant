<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 4:16
 */

class RegistrationForm {
	private $email;
	private $login;
	private $password;
	private $passwordConfirm;


	/**
	 * @param array $data
	 */
	function __construct( Array $data ) {
		$this->email           = isset( $data['email'] ) ? $data['email'] : null;
		$this->login        = isset( $data['login'] ) ? $data['login'] : null;
		$this->password        = isset( $data['password'] ) ? $data['password'] : null;
		$this->passwordConfirm = isset( $data['passwordConfirm'] ) ? $data['passwordConfirm'] : null;
	}

	public function validate() {
		return ! empty( $this->email ) && ! empty( $this->login ) && ! empty( $this->password ) && ! empty( $this->passwordConfirm ) && $this->passwordsMatch();
	}

	public function passwordsMatch() {
		return $this->password == $this->passwordConfirm;
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
	public function getPasswordConfirm() {
		return $this->passwordConfirm;
	}

	/**
	 * @param mixed $passwordConfirm
	 */
	public function setPasswordConfirm( $passwordConfirm ) {
		$this->passwordConfirm = $passwordConfirm;
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

	/**
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @param mixed $login
	 */
	public function setLogin( $login ) {
		$this->login = $login;
	}


}