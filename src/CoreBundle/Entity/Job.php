<?php

namespace CoreBundle\Entity;

use CoreBundle\Entity\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\JobRepository")
 */
class Job extends Timestampable
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
     * @ORM\Column(name="type", type="string", length=15)
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     * @Assert\NotBlank
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=100)
     * @Assert\NotBlank
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=100)
     * @Assert\NotBlank
     */
    private $company;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="jobs")
     * @Assert\NotBlank
     */
    private $category;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     *
     */
    private $url;

    /**
     * @var string
     *
     *@ORM\Column(name="description", type="string", length=120, nullable=true)
     *@Assert\Length(
     *      min = 20,
     *      max = 120,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=120)
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="jobs")
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(name="how_to_apply", type="string", length=120)
     * @Assert\Length(
     *      min = 20,
     *      max = 120,
     *      minMessage = "The 'How To Apply' field must be at least {{ limit }} characters long",
     *      maxMessage = "The 'How To Apply' field cannot be longer than {{ limit }} characters"
     * )
     */
    private $howToApply;




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
     * Set location
     *
     * @param string $location
     *
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }


    /**
     * Set type
     *
     * @param string $type
     *
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Job
     */
    public function setUser(\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


    /**
     * Set category
     *
     * @param \CoreBundle\Entity\Category $category
     *
     * @return Job
     */
    public function setCategory(\CoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CoreBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Job
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
     * Set howToApply
     *
     * @param string $howToApply
     *
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->howToApply = $howToApply;

        return $this;
    }

    /**
     * Get howToApply
     *
     * @return string
     */
    public function getHowToApply()
    {
        return $this->howToApply;
    }
}
