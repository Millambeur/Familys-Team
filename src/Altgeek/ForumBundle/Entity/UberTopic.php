<?php

namespace Altgeek\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UberTopic
 *
 * @ORM\Table(name="uber_topic")
 * @ORM\Entity(repositoryClass="Altgeek\ForumBundle\Repository\UberTopicRepository")
 */
class UberTopic
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
     * @ORM\OneToMany(targetEntity="Altgeek\ForumBundle\Entity\Topic", mappedBy="uberTopic", cascade={"persist"})
     */
    private $topics;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * Constructor
     */
    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add topic
     *
     * @param \Altgeek\ForumBundle\Entity\Topic $topic
     *
     * @return UberTopic
     */
    public function addTopic(\Altgeek\ForumBundle\Entity\Topic $topic)
    {
        $this->topics[] = $topic;

        return $this;
    }

    /**
     * Remove topic
     *
     * @param \Altgeek\ForumBundle\Entity\Topic $topic
     */
    public function removeTopic(\Altgeek\ForumBundle\Entity\Topic $topic)
    {
        $this->topics->removeElement($topic);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return UberTopic
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
     * Set title
     *
     * @param string $title
     *
     * @return UberTopic
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
}
