<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Ekyna\Bundle\AgendaBundle\Model\CategoryInterface;
use Ekyna\Bundle\AgendaBundle\Model\EventInterface;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class Event
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Event implements EventInterface
{
    use Core\TimestampableTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var bool
     */
    protected $private = false;

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var string
     */
    protected $slug;


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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrivate($private)
    {
        $this->private = $private;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
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
