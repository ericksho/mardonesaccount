<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AccountL1
 *
 * @ORM\Table(name="account_l1")
 * @ORM\Entity(repositoryClass="BooksBundle\Repository\AccountL1Repository")
 */
class AccountL1
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
     * Many Accounts have One Enterprise.
     * @ORM\ManyToOne(targetEntity="Enterprise", inversedBy="accounts")
     * @ORM\JoinColumn(name="enterprise_id", referencedColumnName="id")
     */
    private $enterprise;

    /**
     * One AccountL1 has Many AccountsL2.
     * @ORM\OneToMany(targetEntity="AccountL2", mappedBy="accountL1")
     */
    private $accountsL2;

    public function __construct() {
        $this->accountsL2 = new ArrayCollection();
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
     * @return AccountL1
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
     * @return AccountL1
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
     * Get code string
     *
     * @return integer 
     */
    public function getCodeString()
    {
        return str_pad($this->code, 2, "0", STR_PAD_LEFT);;
    }

    /**
     * Set enterprise
     *
     * @param \BooksBundle\Entity\Enterprise $enterprise
     * @return AccountL1
     */
    public function setEnterprise(\BooksBundle\Entity\Enterprise $enterprise = null)
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    /**
     * Get enterprise
     *
     * @return \BooksBundle\Entity\Enterprise 
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * Add accountsL2
     *
     * @param \BooksBundle\Entity\AccountL2 $accountsL2
     * @return AccountL1
     */
    public function addAccountsL2(\BooksBundle\Entity\AccountL2 $accountsL2)
    {
        $this->accountsL2[] = $accountsL2;

        return $this;
    }

    /**
     * Remove accountsL2
     *
     * @param \BooksBundle\Entity\AccountL2 $accountsL2
     */
    public function removeAccountsL2(\BooksBundle\Entity\AccountL2 $accountsL2)
    {
        $this->accountsL2->removeElement($accountsL2);
    }

    /**
     * Get accountsL2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccountsL2()
    {
        return $this->accountsL2;
    }

    public function fitMinorFilter($state, $date1, $date2, $enterprise)
    {
        if($enterprise->getId() != $this->enterprise->getId())
            return false;
        
        foreach ($this->accountsL2 as $accountL2)
        {
            if($accountL2->fitMinorFilter($state, $date1, $date2))
                return true;
        }
        return false;
    }
}
