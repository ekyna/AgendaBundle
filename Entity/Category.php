<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Ekyna\Bundle\AgendaBundle\Model\CategoryInterface;

/**
 * Class Category
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Category implements CategoryInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $backgroundColor;

    /**
     * @var string
     */
    protected $textColor;


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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
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
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * {@inheritdoc}
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * {@inheritdoc}
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
        return $this;
    }
}
