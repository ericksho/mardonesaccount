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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * One Enterprise has Many accounts.
     * @ORM\OneToMany(targetEntity="AccountL1", mappedBy="enterprise")
     */
    private $accounts;

    public function __construct() {
        $this->accounts = new ArrayCollection();
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
}
