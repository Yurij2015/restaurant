<?php
/**
 * Создано в PhpStorm.
 */

class RoleForm
{
    public $role;

    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->role = isset($data['role']) ? $data['role'] : null;
    }

    public function validate()
    {
        return !empty($this->role);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

}