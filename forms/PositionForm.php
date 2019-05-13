<?php
/**
 * Created by PhpStorm.
 * Project: taskshedule.loc.
 * File: PositionForm.php.
 * Date: 19.04.2018
 * Time: 11:32
 */

class PositionForm
{

    public $positionname;

    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->positionname = isset($data['positionname']) ? $data['positionname'] : null;
    }

    public function validate()
    {
        return !empty($this->positionname);
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->positionname;
    }

    /**
     * @param mixed $positionname
     */
    public function setPosition($positionname)
    {
        $this->positionname = $positionname;
    }

}