<?php


class tables
{
    private $name;
    private $description;
    private $status;
    private $image;
    private $customer_name;

    /**
     * tables constructor.
     * @param $name
     * @param $description
     * @param $status
     * @param $image
     * @param $customer_name
     */
    public function __construct($name, $description, $status, $image, $customer_name)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->image = $image;
        $this->customer_name = $customer_name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }


}