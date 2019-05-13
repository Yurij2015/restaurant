<?php
/**
 * Создано в PhpStorm.
 */

class EmployeeUnitForm
{

    private $employee_idemployee;
    private $unit_idunit;

    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->employee_idemployee = isset($data['employee_idemployee']) ? $data['employee_idemployee'] : null;
        $this->unit_idunit = isset($data['unit_idunit']) ? $data['unit_idunit'] : null;
    }

    public function validate()
    {
        return !empty($this->employee_idemployee) && !empty($this->unit_idunit);
    }

    /**
     * @return mixed
     */
    public function getUnitIdUnit()
    {
        return $this->unit_idunit;
    }

    /**
     * @param mixed $unit_idunit
     */
    public function setUnitIdUnit($unit_idunit)
    {
        $this->unit_idunit = $unit_idunit;
    }

    /**
     * @return mixed
     */
    public function getEmployeeIdEmployee()
    {
        return $this->employee_idemployee;
    }

    /**
     * @param mixed $employee_idemployee
     */
    public function setEmployeeIdEmployee($employee_idemployee)
    {
        $this->employee_idemployee = $employee_idemployee;
    }


}