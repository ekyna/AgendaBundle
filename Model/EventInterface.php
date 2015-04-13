<?php

namespace Ekyna\Bundle\AgendaBundle\Model;

use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Interface EventInterface|$thisInterface
 * @package Ekyna\Bundle\AgendaBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface EventInterface extends Core\TimestampableInterface, Core\TaggedEntityInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the category.
     *
     * @param CategoryInterface $category
     * @return EventInterface|$this
     */
    public function setCategory(CategoryInterface $category);

    /**
     * Returns the category.
     *
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * Set name
     *
     * @param string $name
     * @return EventInterface|$this
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set title
     *
     * @param string $title
     * @return EventInterface|$this
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets the content.
     *
     * @param string $content
     * @return EventInterface|$this
     */
    public function setContent($content);

    /**
     * Sets the startDate.
     *
     * @param \DateTime $startDate
     * @return EventInterface|$this
     */
    public function setStartDate(\DateTime $startDate);

    /**
     * Returns the startDate.
     *
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * Sets the endDate.
     *
     * @param \DateTime $endDate
     * @return EventInterface|$this
     */
    public function setEndDate(\DateTime $endDate);

    /**
     * Returns the endDate.
     *
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * Returns the private.
     *
     * @return boolean
     */
    public function getPrivate();

    /**
     * Sets the private.
     *
     * @param boolean $private
     * @return EventInterface|$this
     */
    public function setPrivate($private);

    /**
     * Returns the enabled.
     *
     * @return boolean
     */
    public function getEnabled();

    /**
     * Sets the enabled.
     *
     * @param boolean $enabled
     * @return EventInterface|$this
     */
    public function setEnabled($enabled);

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return EventInterface|$this
     */
    public function setSlug($slug);
}