<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Information
 *
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\InformationRepository")
 */
class Information extends Timestampable
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
     * @ORM\Column(name="title", type="string", length=50)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=120)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=1)
     * @Assert\NotBlank
     */
    private $positionOnFrontend;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Information
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Information
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set positionOnFrontend
     *
     * @param string $positionOnFrontend
     *
     * @return Information
     */
    public function setPositionOnFrontend($positionOnFrontend)
    {
        $this->positionOnFrontend = $positionOnFrontend;

        return $this;
    }

    /**
     * Get positionOnFrontend
     *
     * @return string
     */
    public function getPositionOnFrontend()
    {
        return $this->positionOnFrontend;
    }
}
