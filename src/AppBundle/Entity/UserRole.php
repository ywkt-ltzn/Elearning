<?php

namespace AppBundle\Entity;

/**
 * @ORM\Table(name="UserRole")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRoleRepository")
 */
class UserRole
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $rId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rName;


    /**
     * Get rId
     *
     * @return int
     */
    public function getRId()
    {
        return $this->rId;
    }

    /**
     * Set rName
     *
     * @param string $rName
     *
     * @return UserRole
     */
    public function setRName($rName)
    {
        $this->rName = $rName;

        return $this;
    }

    /**
     * Get rName
     *
     * @return string
     */
    public function getRName()
    {
        return $this->rName;
    }
}

