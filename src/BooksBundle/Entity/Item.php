<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\ItemRepository")
 */
class Item
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
     * @var int
     *
     * @ORM\Column(name="credit", type="integer")
     */
    private $credit;

    /**
     * @var int
     *
     * @ORM\Column(name="debit", type="integer")
     */
    private $debit;

    /**
     * @var int
     *
     * @ORM\Column(name="documentNumber", type="integer")
     */
    private $documentNumber;

    /**
     * Many Items have One Voucher.
     * @ORM\ManyToOne(targetEntity="Voucher", inversedBy="items")
     * @ORM\JoinColumn(name="voucher_id", referencedColumnName="id")
     */
    private $voucher;

    /**
     * Many Vouchers have One AccountL3.
     * @ORM\ManyToOne(targetEntity="AccountL3", inversedBy="items")
     * @ORM\JoinColumn(name="accountL3_id", referencedColumnName="id")
     */
    private $accountL3;

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
     * Set number
     *
     * @param integer $number
     * @return Item
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set credit
     *
     * @param integer $credit
     * @return Item
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return integer 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set debit
     *
     * @param integer $debit
     * @return Item
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Get debit
     *
     * @return integer 
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Set documentNumber
     *
     * @param integer $documentNumber
     * @return Item
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    /**
     * Get documentNumber
     *
     * @return integer 
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Set voucher
     *
     * @param \BooksBundle\Entity\Voucher $voucher
     * @return Item
     */
    public function setVoucher(\BooksBundle\Entity\Voucher $voucher = null)
    {
        $this->voucher = $voucher;

        return $this;
    }

    /**
     * Get voucher
     *
     * @return \BooksBundle\Entity\Voucher 
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Set accountL3
     *
     * @param \BooksBundle\Entity\AccountL3 $accountL3
     * @return Item
     */
    public function setAccountL3(\BooksBundle\Entity\AccountL3 $accountL3 = null)
    {
        $this->accountL3 = $accountL3;

        return $this;
    }

    /**
     * Get accountL3
     *
     * @return \BooksBundle\Entity\AccountL3 
     */
    public function getAccountL3()
    {
        return $this->accountL3;
    }
}
