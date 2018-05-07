<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $client_id;
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $gln;
    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="create_user", referencedColumnName="id",nullable=false)
     */
    private $create_user;
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $juridical_address;
    /**
     * @ORM\Column(type="string", length=60)
     */
    private $physical_address;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id): void
    {
        $this->client_id = $client_id;
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
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGln()
    {
        return $this->gln;
    }

    /**
     * @param mixed $gln
     */
    public function setGln($gln): void
    {
        $this->gln = $gln;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp=null): void
    {
        if(is_null($timestamp)) $timestamp = new \DateTime();

        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getCreateUser()
    {
        return $this->create_user;
    }

    /**
     * @param mixed $responsible_id
     */
    public function setCreateUser($create_user): void
    {
        $this->create_user = $create_user;
    }

    /**
     * @return mixed
     */
    public function getJuridicalAddress()
    {
        return $this->juridical_address;
    }

    /**
     * @param mixed $juridical_address
     */
    public function setJuridicalAddress($juridical_address): void
    {
        $this->juridical_address = $juridical_address;
    }

    /**
     * @return mixed
     */
    public function getPhysicalAddress()
    {
        return $this->physical_address;
    }

    /**
     * @param mixed $physical_address
     */
    public function setPhysicalAddress($physical_address): void
    {
        $this->physical_address = $physical_address;
    }
}