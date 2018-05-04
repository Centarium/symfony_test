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
}