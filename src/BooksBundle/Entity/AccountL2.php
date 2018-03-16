<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AccountL2
 *
 * @ORM\Table(name="account_l2")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\AccountL2Repository")
 */
class AccountL2
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
     * Many AccountsL2 have One AccountL1.
     * @ORM\ManyToOne(targetEntity="AccountL1", inversedBy="accountsL2")
     * @ORM\JoinColumn(name="accountL1_id", referencedColumnName="id")
     */
    private $accountL1;

    /**
     * One AccountL2 has Many AccountsL3.
     * @ORM\OneToMany(targetEntity="AccountL3", mappedBy="accountL2")
     */
    private $accountsL3;

    public function __construct() {
        $this->accountsL3 = new ArrayCollection();
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
     * @return AccountL2
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
     * @return AccountL2
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
     * Set accountL1
     *
     * @param \BooksBundle\Entity\AccountL1 $accountL1
     * @return AccountL2
     */
    public function setAccountL1(\BooksBundle\Entity\AccountL1 $accountL1 = null)
    {
        $this->accountL1 = $accountL1;

        return $this;
    }

    /**
     * Get accountL1
     *
     * @return \BooksBundle\Entity\AccountL1 
     */
    public function getAccountL1()
    {
        return $this->accountL1;
    }

    /**
     * Add accountsL3
     *
     * @param \BooksBundle\Entity\AccountL3 $accountsL3
     * @return AccountL2
     */
    public function addAccountsL3(\BooksBundle\Entity\AccountL3 $accountsL3)
    {
        $this->accountsL3[] = $accountsL3;

        return $this;
    }

    /**
     * Remove accountsL3
     *
     * @param \BooksBundle\Entity\AccountL3 $accountsL3
     */
    public function removeAccountsL3(\BooksBundle\Entity\AccountL3 $accountsL3)
    {
        $this->accountsL3->removeElement($accountsL3);
    }

    /**
     * Get accountsL3
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccountsL3()
    {
        return $this->accountsL3;
    }
}
