<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Entity\TinymceBlock;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class Event
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Event implements Core\TimestampableInterface, Core\TaggedEntityInterface, Cms\SeoSubjectInterface
{
    use Core\TimestampableTrait,
        Cms\SeoSubjectTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var TinymceBlock
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var bool
     */
    private $private = false;

    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @var string
     */
    private $slug;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->content = new TinymceBlock();
        $this->seo = new Seo();
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Serializes the event.
     *
     * @return array
     */
    public function serialize()
    {
        $data =  array(
            'id'              => $this->id,
            'title'           => $this->title,
            'allDay'          => false,
            'start'           => $this->startDate->format('Y-m-d\TH:i:sP'),
            'backgroundColor' => $this->category->getBackgroundColor(),
            'borderColor'     => $this->category->getBackgroundColor(),
            'textColor'       => $this->category->getTextColor(),
            'private'         => $this->private,
            'enabled'         => $this->enabled,
        );

        if (null !== $this->endDate) {
            $data['end'] = $this->endDate->format('Y-m-d\TH:i:sP');
        }

        return $data;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the category.
     *
     * @param Category $category
     * @return Event
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Returns the category.
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
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
     * Set title
     *
     * @param string $title
     * @return Event
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
     * Sets the content.
     *
     * @param TinymceBlock $content
     * @return Event
     */
    public function setContent(TinymceBlock $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Returns the content.
     *
     * @return TinymceBlock
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the startDate.
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Returns the startDate.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the endDate.
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Returns the endDate.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Returns the private.
     *
     * @return boolean
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Sets the private.
     *
     * @param boolean $private
     * @return Event
     */
    public function setPrivate($private)
    {
        $this->private = $private;
        return $this;
    }

    /**
     * Returns the enabled.
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Sets the enabled.
     *
     * @param boolean $enabled
     * @return Event
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTag()
    {
        if (null === $this->getId()) {
            throw new \RuntimeException('Unable to generate entity tag, as the id property is undefined.');
        }
        return sprintf('ekyna_agenda.event[id:%s]', $this->getId());
    }
}
