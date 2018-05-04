<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;
    /**
     * @ORM\Column( type="string", columnDefinition="price_types")
     */
    private $type;
    /**
     * @ORM\Column(type="text")
     */
    private $description;


    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}
