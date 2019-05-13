<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 11:12
 */

class EmployeeForm
{
    private $name;
    private $secondname;
    private $emailempl;
    private $position_idposition;


    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->secondname = isset($data['secondname']) ? $data['secondname'] : null;
        $this->emailempl = isset($data['emailempl']) ? $data['emailempl'] : null;
        $this->position_idposition = isset($data['position_idposition']) ? $data['position_idposition'] : null;

    }

    public function validate()
    {
        return !empty($this->name) && !empty($this->secondname) && !empty($this->position_idposition) && !empty($this->emailempl);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSecondname()
    {
        return $this->secondname;
    }

    /**
     * @param mixed $secondname
     */
    public function setSecondname($secondname)
    {
        $this->secondname = $secondname;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->emailempl;
    }

    /**
     * @param mixed $emailempl
     */
    public function setEmail($emailempl)
    {
        $this->emailempl = $emailempl;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position_idposition;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position_idposition = $position;
    }

}