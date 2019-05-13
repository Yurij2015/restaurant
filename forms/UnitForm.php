<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 11:12
 */

class UnitForm {
	private $unitname;

	/**
	 * @param array $data
	 */
	function __construct( Array $data ) {
		$this->unitname = isset( $data['unitname'] ) ? $data['unitname'] : null;
	}

	public function validate() {
		return ! empty( $this->unitname );
	}

	/**
	 * @return mixed
	 */
	public function getUnitname() {
		return $this->unitname;
	}

	/**
	 * @param mixed $unitname
	 */
	public function setUnitname( $unitname ) {
		$this->unitname = $unitname;
	}

}