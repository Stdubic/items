<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="Invoice", indexes={@ORM\Index(name="fk_Invoice_2_idx", columns={"salesRep_id"}), @ORM\Index(name="fk_Invoice_1_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="totalAmount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $totalamount;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Salesrep
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Salesrep")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="salesRep_id", referencedColumnName="id")
     * })
     */
    private $salesrep;

    /**
     * @var \AppBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set totalamount
     *
     * @param string $totalamount
     *
     * @return Invoice
     */
    public function setTotalamount($totalamount)
    {
        $this->totalamount = $totalamount;

        return $this;
    }

    /**
     * Get totalamount
     *
     * @return string
     */
    public function getTotalamount()
    {
        return $this->totalamount;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set salesrep
     *
     * @param \AppBundle\Entity\Salesrep $salesrep
     *
     * @return Invoice
     */
    public function setSalesrep(\AppBundle\Entity\Salesrep $salesrep = null)
    {
        $this->salesrep = $salesrep;

        return $this;
    }

    /**
     * Get salesrep
     *
     * @return \AppBundle\Entity\Salesrep
     */
    public function getSalesrep()
    {
        return $this->salesrep;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Invoice
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function __toString() {
        return $this->totalamount;
    }


}
