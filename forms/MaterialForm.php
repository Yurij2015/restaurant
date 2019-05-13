<?php
/**
 * Created by PhpStorm.
 * File: MaterialForm.php
 * Date: 12.02.2019
 * Time: 21:56
 */

class MaterialForm
{
    private $materialname;
    private $notice;
    private $count;
    private $price;
    private $storehouse_idstorehouse;
    private $adoptiondate;
    private $responsible_person;


    /**
     * @param array $data
     */
    function __construct(Array $data)
    {
        $this->materialname = isset($data['materialname']) ? $data['materialname'] : null;
        $this->notice = isset($data['notice']) ? $data['notice'] : null;
        $this->count = isset($data['count']) ? $data['count'] : null;
        $this->price = isset($data['price']) ? $data['price'] : null;
        $this->storehouse_idstorehouse = isset($data['storehouse_idstorehouse']) ? $data['storehouse_idstorehouse'] : null;
        $this->adoptiondate = isset($data['adoptiondate']) ? $data['adoptiondate'] : null;
        $this->responsible_person = isset($data['responsible_person']) ? $data['responsible_person'] : null;


    }

    public function validate()
    {
        return !empty($this->materialname) && !empty($this->notice) && !empty($this->count) && !empty($this->price) && !empty($this->storehouse_idstorehouse) && !empty($this->adoptiondate) && !empty($this->responsible_person);
    }

    /**
     * @return mixed
     */
    public function getMaterialName()
    {
        return $this->materialname;
    }

    /**
     * @param mixed $name
     */
    public function setMaterialName($materialname)
    {
        $this->materialname = $materialname;
    }

    /**
     * @return mixed
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param mixed $secondname
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
    }


    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }




}