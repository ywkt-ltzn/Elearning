<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 */
class Content
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $cId;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $lId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $cNote;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cImg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cVideo;

    /**
     * @ORM\Column(type="integer")
     */
    private $cCreateuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $cCreatedate;

    /**
     * @ORM\Column(type="integer")
     */
    private $cModifyuid;

    /**
     * @ORM\Column(type="DateTime")
     */
    private $cModifydate;


    /**
     * Set cId
     *
     * @param integer $cId
     *
     * @return Content
     */
    public function setCId($cId)
    {
        $this->cId = $cId;

        return $this;
    }

    /**
     * Get cId
     *
     * @return int
     */
    public function getCId()
    {
        return $this->cId;
    }
    
    /**
     * Set lId
     *
     * @param integer $lId
     *
     * @return Content
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
     * Set cTitle
     *
     * @param string $cTitle
     *
     * @return Content
     */
    public function setCTitle($cTitle)
    {
        $this->cTitle = $cTitle;

        return $this;
    }

    /**
     * Get cTitle
     *
     * @return string
     */
    public function getCTitle()
    {
        return $this->cTitle;
    }

    /**
     * Set cNote
     *
     * @param string $cNote
     *
     * @return Content
     */
    public function setCNote($cNote)
    {
        $this->cNote = $cNote;

        return $this;
    }

    /**
     * Get cNote
     *
     * @return string
     */
    public function getCNote()
    {
        return $this->cNote;
    }

    /**
     * Set cImg
     *
     * @param string $cImg
     *
     * @return Content
     */
    public function setCImg($cImg)
    {
        $this->cImg = $cImg;

        return $this;
    }

    /**
     * Get cImg
     *
     * @return string
     */
    public function getCImg()
    {
        return $this->cImg;
    }

    /**
     * Set cVideo
     *
     * @param string $cVideo
     *
     * @return Content
     */
    public function setCVideo($cVideo)
    {
        $this->cVideo = $cVideo;

        return $this;
    }

    /**
     * Get cVideo
     *
     * @return string
     */
    public function getCVideo()
    {
        return $this->cVideo;
    }

    /**
     * Set cCreateuid
     *
     * @param integer $cCreateuid
     *
     * @return Content
     */
    public function setCCreateuid($cCreateuid)
    {
        $this->cCreateuid = $cCreateuid;

        return $this;
    }

    /**
     * Get cCreateuid
     *
     * @return int
     */
    public function getCCreateuid()
    {
        return $this->cCreateuid;
    }

    /**
     * Set cCreatedate
     *
     * @param \DateTime $cCreatedate
     *
     * @return Content
     */
    public function setCCreatedate($cCreatedate)
    {
        $this->cCreatedate = $cCreatedate;

        return $this;
    }

    /**
     * Get cCreatedate
     *
     * @return \DateTime
     */
    public function getCCreatedate()
    {
        return $this->cCreatedate;
    }

    /**
     * Set cModifyuid
     *
     * @param integer $cModifyuid
     *
     * @return Content
     */
    public function setCModifyuid($cModifyuid)
    {
        $this->cModifyuid = $cModifyuid;

        return $this;
    }

    /**
     * Get cModifyuid
     *
     * @return int
     */
    public function getCModifyuid()
    {
        return $this->cModifyuid;
    }

    /**
     * Set cModifydate
     *
     * @param \DateTime $cModifydate
     *
     * @return Content
     */
    public function setCModifydate($cModifydate)
    {
        $this->cModifydate = $cModifydate;

        return $this;
    }

    /**
     * Get cModifydate
     *
     * @return \DateTime
     */
    public function getCModifydate()
    {
        return $this->cModifydate;
    }
}

