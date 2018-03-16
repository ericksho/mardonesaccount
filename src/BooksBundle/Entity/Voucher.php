<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Voucher
 *
 * @ORM\Table(name="voucher")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\VoucherRepository")
 */
class Voucher
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
     * @ORM\Column(name="state", type="integer")
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * Many Vouchers have One AccountL3.
     * @ORM\ManyToOne(targetEntity="AccountL3", inversedBy="vouchers")
     * @ORM\JoinColumn(name="accountL3_id", referencedColumnName="id")
     */
    private $accountL3;

    /**
     * One Voucher has Many Items
     * @ORM\OneToMany(targetEntity="Item", mappedBy="voucher")
     */
    private $items;

    public function __construct() {
        $this->items = new ArrayCollection();
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
     * Set state
     *
     * @param integer $state
     * @return Voucher
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Voucher
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Voucher
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
     * Set date
     *
     * @param \DateTime $date
     * @return Voucher
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
     * Set accountL3
     *
     * @param \BooksBundle\Entity\AccountL3 $accountL3
     * @return Voucher
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

    /**
     * Add items
     *
     * @param \BooksBundle\Entity\Item $items
     * @return Voucher
     */
    public function addItem(\BooksBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \BooksBundle\Entity\Item $items
     */
    public function removeItem(\BooksBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
