<?php

namespace Altgeek\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Altgeek\ForumBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\ManyToOne(targetEntity="Altgeek\ForumBundle\Entity\Topic")
     */
    private $topic;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Altgeek\UserBundle\Entity\User")
     */
    private $author;

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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
    private $previousVersions;


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
     * Set topic
     *
     * @param \Altgeek\ForumBundle\Entity\Topic $topic
     *
     * @return Post
     */
    public function setTopic(\Altgeek\ForumBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Altgeek\ForumBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set author
     *
     * @param \Altgeek\UserBundle\Entity\User $author
     *
     * @return Post
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Post
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
     * @return Post
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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->previousVersions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add previousVersion
     *
     * @param \Altgeek\UserBundle\Entity\Post $previousVersion
     *
     * @return Post
     */
    public function addPreviousVersion(\Altgeek\UserBundle\Entity\Post $previousVersion)
    {
        $this->previousVersions[] = $previousVersion;

        return $this;
    }

    /**
     * Remove previousVersion
     *
     * @param \Altgeek\UserBundle\Entity\Post $previousVersion
     */
    public function removePreviousVersion(\Altgeek\UserBundle\Entity\Post $previousVersion)
    {
        $this->previousVersions->removeElement($previousVersion);
    }

    /**
     * Get previousVersions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPreviousVersions()
    {
        return $this->previousVersions;
    }
}
