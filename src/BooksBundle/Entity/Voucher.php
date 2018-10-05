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
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=15)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15)
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
     * One Voucher has Many Items
     * @ORM\OneToMany(targetEntity="Item", mappedBy="voucher",cascade={"persist"})
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
     * @param string $state
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
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set type
     *
     * @param string $type
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
     * @return string 
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
     * Add items
     *
     * @param \BooksBundle\Entity\Item $items
     * @return Voucher
     */
    public function addItem(\BooksBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        $items->setVoucher($this);

        return $this;
    }

    /**
     * Remove items
     *
     * @param \BooksBundle\Entity\Item $items
     */
    public function removeItem(\BooksBundle\Entity\Item $items)
    {
        $items->setVoucher(null);
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

    public function getDebit()
    {
        $debit = 0;
        foreach ($this->items as $item) 
        {
            $debit += $item->getDebit();
        }

        return $debit;
    }

    public function getCredit()
    {
        $credit = 0;
        foreach ($this->items as $item) 
        {
            $credit += $item->getCredit();
        }

        return $credit;
    }

    public function fitMinorFilter($state, $date1, $date2)
    {
        if($this->state == $state && $this->date >= $date1 && $this->date <= $date2)
        {
            return true;
        }
        return false;
    }

    public function getRowspan()
    {
        return count($this->getItems()) + 1;
    }
}
