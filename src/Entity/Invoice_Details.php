<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="invoice_details")
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceDetailsRepository")
 */
class Invoice_Details
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Invoice")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id",nullable=false)
     */
    private $invoice_id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id",nullable=false)
     */
    private $service_id;
    /**
     * @ORM\Column(columnDefinition="money", type="float")
     */
    private $net_amount;
    /**
     * @ORM\Column(columnDefinition="money", type="float")
     */
    private $tax_amount;
    /**
     * @ORM\Column(columnDefinition="money", type="float")
     */
    private $gross_amount;
    /**
     * @ORM\Column(type="integer")
     */
    private $qty;
    /**
     * @ORM\Column(type="integer")
     */
    private $tax_rate;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id): void
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return mixed
     */
    public function getNetAmount()
    {
        return $this->net_amount;
    }

    /**
     * @param mixed $net_amount
     */
    public function setNetAmount($net_amount): void
    {
        $this->net_amount = $net_amount;
    }

    /**
     * @return mixed
     */
    public function getTaxAmount()
    {
        return $this->tax_amount;
    }

    /**
     * @param mixed $tax_amount
     */
    public function setTaxAmount($tax_amount): void
    {
        $this->tax_amount = $tax_amount;
    }

    /**
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->gross_amount;
    }

    /**
     * @param mixed $gross_amount
     */
    public function setGrossAmount($gross_amount): void
    {
        $this->gross_amount = $gross_amount;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getTaxRate()
    {
        return $this->tax_rate;
    }

    /**
     * @param mixed $tax_rate
     */
    public function setTaxRate($tax_rate): void
    {
        $this->tax_rate = $tax_rate;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
     * @param mixed $service_id
     */
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }

}