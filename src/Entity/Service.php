<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $service_name;
    /**
     * @ORM\Column(columnDefinition="money", type="float")
     */
    private $default_price;
    /**
     * @ORM\Column(type="integer")
     */
    private $period;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * @param mixed $service_name
     */
    public function setServiceName($service_name)
    {
        $this->service_name = $service_name;
    }

    /**
     * @return mixed
     */
    public function getDefaultPrice()
    {
        return $this->default_price;
    }

    /**
     * @param mixed $default_price
     */
    public function setDefaultPrice($default_price)
    {
        $this->default_price = $default_price;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

}