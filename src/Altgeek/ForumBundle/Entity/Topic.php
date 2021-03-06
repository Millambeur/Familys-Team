<?php

namespace Altgeek\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="Altgeek\ForumBundle\Repository\TopicRepository")
 */
class Topic
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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Altgeek\ForumBundle\Entity\UberTopic")
     */
    private $uberTopic;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Altgeek\ForumBundle\Entity\Post", mappedBy="topic", cascade={"persist"})
     */
    private $posts;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Altgeek\UserBundle\Entity\User")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="date")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set uberTopic
     *
     * @param \Altgeek\ForumBundle\Entity\UberTopic $uberTopic
     *
     * @return Topic
     */
    public function setUberTopic(\Altgeek\ForumBundle\Entity\UberTopic $uberTopic = null)
    {
        $this->uberTopic = $uberTopic;

        return $this;
    }

    /**
     * Get uberTopic
     *
     * @return \Altgeek\ForumBundle\Entity\UberTopic
     */
    public function getUberTopic()
    {
        return $this->uberTopic;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add post
     *
     * @param \Altgeek\ForumBundle\Entity\Post $post
     *
     * @return Topic
     */
    public function addPost(\Altgeek\ForumBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Altgeek\ForumBundle\Entity\Post $post
     */
    public function removePost(\Altgeek\ForumBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set author
     *
     * @param \Altgeek\UserBundle\Entity\User $author
     *
     * @return Topic
     */
    public function setAuthor(\Altgeek\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Altgeek\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Topic
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Topic
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
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
     * @return Topic
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
}
