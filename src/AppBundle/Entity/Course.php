<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Course")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $couId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couName;

    /**
     * @ORM\Column(type="integer")
     */
    private $uId;

    /**
     * @ORM\Column(type="integer")
     */
    private $couCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $couCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $couModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $couModifydate;


    /**
     * Set couId
     *
     * @param integer $couId
     *
     * @return Course
     */
    public function setCouId($couId)
    {
        $this->couId = $couId;

        return $this;
    }

    /**
     * Get couId
     *
     * @return int
     */
    public function getCouId()
    {
        return $this->couId;
    }

    /**
     * Set couName
     *
     * @param string $couName
     *
     * @return Course
     */
    public function setCouName($couName)
    {
        $this->couName = $couName;

        return $this;
    }

    /**
     * Get couName
     *
     * @return string
     */
    public function getCouName()
    {
        return $this->couName;
    }

    /**
     * Set uId
     *
     * @param integer $uId
     *
     * @return Course
     */
    public function setUId($uId)
    {
        $this->uId = $uId;

        return $this;
    }

    /**
     * Get uId
     *
     * @return int
     */
    public function getUId()
    {
        return $this->uId;
    }

    /**
     * Set couCreateuid
     *
     * @param integer $couCreateuid
     *
     * @return Course
     */
    public function setCouCreateuid($couCreateuid)
    {
        $this->couCreateuid = $couCreateuid;

        return $this;
    }

    /**
     * Get couCreateuid
     *
     * @return int
     */
    public function getCouCreateuid()
    {
        return $this->couCreateuid;
    }

    /**
     * Set couCreatedate
     *
     * @param \DateTime $couCreatedate
     *
     * @return Course
     */
    public function setCouCreatedate($couCreatedate)
    {
        $this->couCreatedate = $couCreatedate;

        return $this;
    }

    /**
     * Get couCreatedate
     *
     * @return \DateTime
     */
    public function getCouCreatedate()
    {
        return $this->couCreatedate;
    }

    /**
     * Set couModifyuid
     *
     * @param integer $couModifyuid
     *
     * @return Course
     */
    public function setCouModifyuid($couModifyuid)
    {
        $this->couModifyuid = $couModifyuid;

        return $this;
    }

    /**
     * Get couModifyuid
     *
     * @return int
     */
    public function getCouModifyuid()
    {
        return $this->couModifyuid;
    }

    /**
     * Set couModifydate
     *
     * @param \DateTime $couModifydate
     *
     * @return Course
     */
    public function setCouModifydate($couModifydate)
    {
        $this->couModifydate = $couModifydate;

        return $this;
    }

    /**
     * Get couModifydate
     *
     * @return \DateTime
     */
    public function getCouModifydate()
    {
        return $this->couModifydate;
    }
}

