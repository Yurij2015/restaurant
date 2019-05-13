<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 7:06
 */

abstract class Session {
	/**
	 * @param $key
	 * @param $value
	 */
	public static function set( $key, $value ) {
		$_SESSION[ $key ] = $value;
	}

	/**
	 * @param $key
	 *
	 * @return null
	 */
	public static function get( $key ) {
		if ( self::has( $key ) ) {
			return $_SESSION[ $key ];
		}

		return null;
	}

	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public static function has( $key ) {
		return isset( $_SESSION[ $key ] );
	}

	/**
	 * @param $key
	 */
	public static function delete( $key ) {
		unset( $_SESSION[ $key ] );
	}

	/**
	 * destroy
	 */
	public static function destroy() {
		session_destroy();
	}
}