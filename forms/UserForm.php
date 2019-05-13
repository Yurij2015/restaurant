<?php
/**
 * Создано в PhpStorm.
 */

class UserForm
{
    private $email;
    private $username;
    private $usersecondname;
    private $role_idrole;
    private $status;


    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->username = isset($data['username']) ? $data['username'] : null;
        $this->usersecondname = isset($data['usersecondname']) ? $data['usersecondname'] : null;
        $this->role_idrole = isset($data['role_idrole']) ? $data['role_idrole'] : null;
        $this->status = isset($data['status']) ? $data['status'] : null;
    }

    public function validate()
    {
        return !empty($this->email) && !empty($this->username) && !empty($this->usersecondname) && !empty($this->role_idrole) && !empty($this->status);
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRoleIdRole()
    {
        return $this->role_idrole;
    }

    /**
     * @param mixed $role_idrole
     */
    public function setRoleIdRole($role_idrole)
    {
        $this->role_idrole = $role_idrole;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUserName($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUserSecondName()
    {
        return $this->usersecondname;
    }

    /**
     * @param mixed $usersecondname
     */
    public function setUserSecondName($usersecondname)
    {
        $this->usersecondname = $usersecondname;
    }

}