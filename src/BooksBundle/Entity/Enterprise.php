<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Enterprise
 *
 * @ORM\Table(name="enterprise")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\EnterpriseRepository")
 */
class Enterprise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="rut", type="string", length=12, unique=true)
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, unique=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="order", type="string", length=100, unique=true)
     */
    private $order;

    /**
     * @var int
     *
     * @ORM\Column(name="folio", type="integer")
     */
    private $folio;

    /**
     * One Enterprise has Many accounts.
     * @ORM\OneToMany(targetEntity="AccountL1", mappedBy="enterprise")
     */
    private $accounts;

    public function __construct() {
        $this->accounts = new ArrayCollection();
        $this->folio = 1;
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
     * Set name
     *
     * @param string $name
     * @return Enterprise
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add accounts
     *
     * @param \BooksBundle\Entity\AccountL1 $accounts
     * @return Enterprise
     */
    public function addAccount(\BooksBundle\Entity\AccountL1 $accounts)
    {
        $this->accounts[] = $accounts;

        return $this;
    }

    /**
     * Remove accounts
     *
     * @param \BooksBundle\Entity\AccountL1 $accounts
     */
    public function removeAccount(\BooksBundle\Entity\AccountL1 $accounts)
    {
        $this->accounts->removeElement($accounts);
    }

    /**
     * Get accounts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Set folio
     *
     * @param integer $folio
     * @return Enterprise
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return integer 
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set rut
     *
     * @param string $rut
     * @return Enterprise
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string 
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Enterprise
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set order
     *
     * @param string $order
     * @return Enterprise
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return string 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
