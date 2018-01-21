<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChannelRepository")
 */
class Channel
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="text", nullable=true)
     */
    private $thumbnail;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Movie", mappedBy="channel", orphanRemoval=true)
     */
    private $movies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }


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
     * get movies
     *
     * @return Collection|Movie[]
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * Add Movie
     *
     * @param Movie $movie
     *
     * @return Channel
     */
    public function addMovie(Movie $movie)
    {
        $movie->setChannel($this);

        $this->movies[] = $movie;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Channel
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
     * Set description
     *
     * @param string $description
     *
     * @return Channel
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
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return Channel
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Channel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Channel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

