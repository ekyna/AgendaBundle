<?php

namespace Ekyna\Bundle\AgendaBundle\Model;

/**
 * Interface CategoryInterface
 * @package Ekyna\Bundle\AgendaBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface CategoryInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     * @return CategoryInterface|$this
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the backgroundColor.
     *
     * @return string
     */
    public function getBackgroundColor();

    /**
     * Sets the backgroundColor.
     *
     * @param string $backgroundColor
     * @return CategoryInterface|$this
     */
    public function setBackgroundColor($backgroundColor);

    /**
     * Returns the textColor.
     *
     * @return string
     */
    public function getTextColor();

    /**
     * Sets the textColor.
     *
     * @param string $textColor
     * @return CategoryInterface|$this
     */
    public function setTextColor($textColor);
}
