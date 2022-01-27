<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Answer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $aId;

    /**
     * @ORM\Column(type="integer")
     */
    private $qId;

    /**
     * @ORM\Column(type="integer")
     */
    private $uId;

    /**
     * @ORM\Column(type="integer")
     */
    private $lId;

    /**
     * @ORM\Column(type="integer")
     */
    private $aAnswer;

    /**
     * @ORM\Column(type="integer")
     */
    private $aCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $aCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $aModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $aModifydate;


    /**
     * Set aId
     *
     * @param integer $aId
     *
     * @return Answer
     */
    public function setAId($aId)
    {
        $this->aId = $aId;

        return $this;
    }

    /**
     * Get aId
     *
     * @return int
     */
    public function getAId()
    {
        return $this->aId;
    }

    /**
     * Set qId
     *
     * @param integer $qId
     *
     * @return Answer
     */
    public function setQId($qId)
    {
        $this->qId = $qId;

        return $this;
    }

    /**
     * Get qId
     *
     * @return int
     */
    public function getQId()
    {
        return $this->qId;
    }

    /**
     * Set uId
     *
     * @param integer $uId
     *
     * @return Answer
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
     * Set lId
     *
     * @param integer $lId
     *
     * @return Answer
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
     * Set aAnswer
     *
     * @param integer $aAnswer
     *
     * @return Answer
     */
    public function setAAnswer($aAnswer)
    {
        $this->aAnswer = $aAnswer;

        return $this;
    }

    /**
     * Get aAnswer
     *
     * @return int
     */
    public function getAAnswer()
    {
        return $this->aAnswer;
    }

    /**
     * Set aCreateuid
     *
     * @param integer $aCreateuid
     *
     * @return Answer
     */
    public function setACreateuid($aCreateuid)
    {
        $this->aCreateuid = $aCreateuid;

        return $this;
    }

    /**
     * Get aCreateuid
     *
     * @return int
     */
    public function getACreateuid()
    {
        return $this->aCreateuid;
    }

    /**
     * Set aCreatedate
     *
     * @param \DateTime $aCreatedate
     *
     * @return Answer
     */
    public function setACreatedate($aCreatedate)
    {
        $this->aCreatedate = $aCreatedate;

        return $this;
    }

    /**
     * Get aCreatedate
     *
     * @return \DateTime
     */
    public function getACreatedate()
    {
        return $this->aCreatedate;
    }

    /**
     * Set aModifyuid
     *
     * @param integer $aModifyuid
     *
     * @return Answer
     */
    public function setAModifyuid($aModifyuid)
    {
        $this->aModifyuid = $aModifyuid;

        return $this;
    }

    /**
     * Get aModifyuid
     *
     * @return int
     */
    public function getAModifyuid()
    {
        return $this->aModifyuid;
    }

    /**
     * Set aModifydate
     *
     * @param \DateTime $aModifydate
     *
     * @return Answer
     */
    public function setAModifydate($aModifydate)
    {
        $this->aModifydate = $aModifydate;

        return $this;
    }

    /**
     * Get aModifydate
     *
     * @return \DateTime
     */
    public function getAModifydate()
    {
        return $this->aModifydate;
    }
}

