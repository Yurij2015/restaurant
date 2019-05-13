<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 5:42
 */

class Password {
	const SALT_TEXT = 'This is salt text to security this website';

	private $password;
	private $hashedPassword;
	private $salt;

	function __construct( $password, $saltText = null ) {
		$this->password       = $password;
		$this->salt           = md5( is_null( $saltText ) ? self::SALT_TEXT : $saltText );
		$this->hashedPassword = md5( $this->salt . $password );
	}

	public function __toString() {
		return $this->hashedPassword;
	}

}