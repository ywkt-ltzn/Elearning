<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $lId;

    /**
     * @ORM\Column(type="integer")
     */
    private $couId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lTitle;

    /**
     * @ORM\Column(type="integer")
     */
    private $lCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $lCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $lModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $lModifydate;



    /**
     * Set lId
     *
     * @param integer $lId
     *
     * @return Lesson
     */
    public function setLId($lId)
    {
        $this->lId = $lId;

        return $this;
    }

    /**
     * Get lId
     *
     * @return int
     */
    public function getLId()
    {
        return $this->lId;
    }

    /**
     * Set couId
     *
     * @param integer $couId
     *
     * @return Lesson
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
     * Set lTitle
     *
     * @param string $lTitle
     *
     * @return Lesson
     */
    public function setLTitle($lTitle)
    {
        $this->lTitle = $lTitle;

        return $this;
    }

    /**
     * Get lTitle
     *
     * @return string
     */
    public function getLTitle()
    {
        return $this->lTitle;
    }

    /**
     * Set lCreateuid
     *
     * @param integer $lCreateuid
     *
     * @return Lesson
     */
    public function setLCreateuid($lCreateuid)
    {
        $this->lCreateuid = $lCreateuid;

        return $this;
    }

    /**
     * Get lCreateuid
     *
     * @return int
     */
    public function getLCreateuid()
    {
        return $this->lCreateuid;
    }

    /**
     * Set lCreatedate
     *
     * @param \DateTime $lCreatedate
     *
     * @return Lesson
     */
    public function setLCreatedate($lCreatedate)
    {
        $this->lCreatedate = $lCreatedate;

        return $this;
    }

    /**
     * Get lCreatedate
     *
     * @return \DateTime
     */
    public function getLCreatedate()
    {
        return $this->lCreatedate;
    }

    /**
     * Set lModifyuid
     *
     * @param integer $lModifyuid
     *
     * @return Lesson
     */
    public function setLModifyuid($lModifyuid)
    {
        $this->lModifyuid = $lModifyuid;

        return $this;
    }

    /**
     * Get lModifyuid
     *
     * @return int
     */
    public function getLModifyuid()
    {
        return $this->lModifyuid;
    }

    /**
     * Set lModifydate
     *
     * @param \DateTime $lModifydate
     *
     * @return Lesson
     */
    public function setLModifydate($lModifydate)
    {
        $this->lModifydate = $lModifydate;

        return $this;
    }

    /**
     * Get lModifydate
     *
     * @return \DateTime
     */
    public function getLModifydate()
    {
        return $this->lModifydate;
    }
}

