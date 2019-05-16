<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 6:14
 */

class LoginForm {
	private $login;
	private $password;

	/**
	 * @param array $data
	 */
	public function __construct( Array $data ) {
		$this->login = isset( $data['login'] ) ? $data['login'] : null;
		$this->password = isset( $data['password'] ) ? $data['password'] : null;
	}

	/**
	 * @return bool
	 */
	public function validate() {
		return ! empty( $this->login ) && ! empty( $this->password );
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->login;
	}

	/**
	 * @param mixed $login
	 */
	public function setEmail( $login ) {
		$this->login = $login;
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