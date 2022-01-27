<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $qId;

    /**
     * @ORM\Column(type="integer")
     */
    private $lId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qQuestion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qOption1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qOption2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qOption3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qOption4;

    /**
     * @ORM\Column(type="integer")
     */
    private $qRightNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $qCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $qCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $qModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $qModifydate;

    /**
     * Set qId
     *
     * @param integer $qId
     *
     * @return Question
     */
    public function setqId($qId)
    {
        $this->qId = $qId;

        return $this;
    }

    /**
     * Get qId
     *
     * @return int
     */
    public function getqId()
    {
        return $this->qId;
    }

    /**
     * Set lId
     *
     * @param integer $lId
     *
     * @return Question
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
     * Set qQuestion
     *
     * @param string $qQuestion
     *
     * @return Question
     */
    public function setQQuestion($qQuestion)
    {
        $this->qQuestion = $qQuestion;

        return $this;
    }

    /**
     * Get qQuestion
     *
     * @return string
     */
    public function getQQuestion()
    {
        return $this->qQuestion;
    }

    /**
     * Set qOption1
     *
     * @param string $qOption1
     *
     * @return Question
     */
    public function setQOption1($qOption1)
    {
        $this->qOption1 = $qOption1;

        return $this;
    }

    /**
     * Get qOption1
     *
     * @return string
     */
    public function getQOption1()
    {
        return $this->qOption1;
    }

    /**
     * Set qOption2
     *
     * @param string $qOption2
     *
     * @return Question
     */
    public function setQOption2($qOption2)
    {
        $this->qOption2 = $qOption2;

        return $this;
    }

    /**
     * Get qOption2
     *
     * @return string
     */
    public function getQOption2()
    {
        return $this->qOption2;
    }

    /**
     * Set qOption3
     *
     * @param string $qOption3
     *
     * @return Question
     */
    public function setQOption3($qOption3)
    {
        $this->qOption3 = $qOption3;

        return $this;
    }

    /**
     * Get qOption3
     *
     * @return string
     */
    public function getQOption3()
    {
        return $this->qOption3;
    }

    /**
     * Set qOption4
     *
     * @param string $qOption4
     *
     * @return Question
     */
    public function setQOption4($qOption4)
    {
        $this->qOption4 = $qOption4;

        return $this;
    }

    /**
     * Get qOption4
     *
     * @return string
     */
    public function getQOption4()
    {
        return $this->qOption4;
    }

    /**
     * Set qRightNumber
     *
     * @param integer $qRightNumber
     *
     * @return Question
     */
    public function setQRightNumber($qRightNumber)
    {
        $this->qRightNumber = $qRightNumber;

        return $this;
    }

    /**
     * Get qRightNumber
     *
     * @return int
     */
    public function getQRightNumber()
    {
        return $this->qRightNumber;
    }

    /**
     * Set qCreateuid
     *
     * @param integer $qCreateuid
     *
     * @return Question
     */
    public function setQCreateuid($qCreateuid)
    {
        $this->qCreateuid = $qCreateuid;

        return $this;
    }

    /**
     * Get qCreateuid
     *
     * @return int
     */
    public function getQCreateuid()
    {
        return $this->qCreateuid;
    }

    /**
     * Set qCreatedate
     *
     * @param \DateTime $qCreatedate
     *
     * @return Question
     */
    public function setQCreatedate($qCreatedate)
    {
        $this->qCreatedate = $qCreatedate;

        return $this;
    }

    /**
     * Get qCreatedate
     *
     * @return \DateTime
     */
    public function getQCreatedate()
    {
        return $this->qCreatedate;
    }

    /**
     * Set qModifyuid
     *
     * @param integer $qModifyuid
     *
     * @return Question
     */
    public function setQModifyuid($qModifyuid)
    {
        $this->qModifyuid = $qModifyuid;

        return $this;
    }

    /**
     * Get qModifyuid
     *
     * @return int
     */
    public function getQModifyuid()
    {
        return $this->qModifyuid;
    }

    /**
     * Set qModifydate
     *
     * @param \DateTime $qModifydate
     *
     * @return Question
     */
    public function setQModifydate($qModifydate)
    {
        $this->qModifydate = $qModifydate;

        return $this;
    }

    /**
     * Get qModifydate
     *
     * @return \DateTime
     */
    public function getQModifydate()
    {
        return $this->qModifydate;
    }
}

