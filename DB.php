<?php

class DB
{
    protected $connetion;

    public function __construct($host, $user, $password, $db_name)
    {
        // connecton
        $this->connetion = new mysqli($host, $user, $password, $db_name);

        $this->query("SET NAMES UTF8");

        if (!$this->connetion) {
            throw new Exception('Не могу соединиться с базой данных');
        }
    }

    public function query($sql)
    {
        if (!$this->connetion) {
            return false;
        }

        $result = $this->connetion->query($sql);

        if (mysqli_error($this->connetion)) {
            throw new Exception(mysqli_error($this->connetion));
        }

        if (is_bool($result)) {
            return $result;
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        mysqli_free_result($result);

        return $data;
    }

    public function escape($str)
    {
        return mysqli_escape_string($this->connetion, $str);
    }

}