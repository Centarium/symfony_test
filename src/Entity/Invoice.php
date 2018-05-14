<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id",nullable=false)
     */
    private $client_id;
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $invoice_nr;
    /**
     * @ORM\Column(type="text")
     */
    private $comment;

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
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNr()
    {
        return $this->invoice_nr;
    }

    /**
     * @param mixed $invoice_nr
     */
    public function setInvoiceNr($invoice_nr)
    {
        $this->invoice_nr = $invoice_nr;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param mixed $total_net_amount
     */
    public function setTotalNetAmount($total_net_amount)
    {
        $this->total_net_amount = $total_net_amount;
    }

    /**
     * @param mixed $total_tax_amount
     */
    public function setTotalTaxAmount($total_tax_amount)
    {
        $this->total_tax_amount = $total_tax_amount;
    }

    /**
     * @param mixed $total_gross_amount
     */
    public function setTotalGrossAmount($total_gross_amount)
    {
        $this->total_gross_amount = $total_gross_amount;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        if( is_null($this->timestamp) || !$this->timestamp instanceof \DateTime )
        {
            return '';
        }
        return $this->timestamp->format('Y-m-d');
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return mixed
     */
    public function getCreateUser(): ?User
    {
        return $this->create_user;
    }

    /**
     * @param mixed $create_user_id
     */
    public function setCreateUser(?User $create_user_id): self
    {
        $this->create_user = $create_user_id;

        return $this;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp=null)
    {
        if(is_null($timestamp)) $timestamp = new \DateTime();

        $this->timestamp = $timestamp;
    }

}