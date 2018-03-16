<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AccountL3
 *
 * @ORM\Table(name="account_l3")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\AccountL3Repository")
 */
class AccountL3
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * Many AccountsL3 have One AccountL2.
     * @ORM\ManyToOne(targetEntity="AccountL2", inversedBy="accountsL3")
     * @ORM\JoinColumn(name="accountL2_id", referencedColumnName="id")
     */
    private $accountL2;

    /**
     * One AccountL3 has Many Vouchers
     * @ORM\OneToMany(targetEntity="Voucher", mappedBy="accountL3")
     */
    private $vouchers;

    public function __construct() {
        $this->vouchers = new ArrayCollection();
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
     * @return AccountL3
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
     * Set code
     *
     * @param integer $code
     * @return AccountL3
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set accountL2
     *
     * @param \BooksBundle\Entity\AccountL2 $accountL2
     * @return AccountL3
     */
    public function setAccountL2(\BooksBundle\Entity\AccountL2 $accountL2 = null)
    {
        $this->accountL2 = $accountL2;

        return $this;
    }

    /**
     * Get accountL2
     *
     * @return \BooksBundle\Entity\AccountL2 
     */
    public function getAccountL2()
    {
        return $this->accountL2;
    }

    /**
     * Add vouchers
     *
     * @param \BooksBundle\Entity\Voucher $vouchers
     * @return AccountL3
     */
    public function addVoucher(\BooksBundle\Entity\Voucher $vouchers)
    {
        $this->vouchers[] = $vouchers;

        return $this;
    }

    /**
     * Remove vouchers
     *
     * @param \BooksBundle\Entity\Voucher $vouchers
     */
    public function removeVoucher(\BooksBundle\Entity\Voucher $vouchers)
    {
        $this->vouchers->removeElement($vouchers);
    }

    /**
     * Get vouchers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVouchers()
    {
        return $this->vouchers;
    }
}
