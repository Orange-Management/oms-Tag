<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Tag\Models
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tag\Models;

use phpOMS\Contract\ArrayableInterface;

/**
 * Tag article class.
 *
 * @package    Modules\Tag\Models
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Tag implements ArrayableInterface, \JsonSerializable
{

    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    private $title = '';

    /**
     * Color RGBA.
     *
     * @var string
     * @since 1.0.0
     */
    private $color = '00000000';

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    protected $createdBy = 0;

    /**
     * Tag type.
     *
     * @var string
     * @since 1.0.0
     */
    private $type = TagType::SINGLE;

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since  1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param mixed $id Created by
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
    }

    /**
     * Get type.
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set type.
     *
     * @param int $type Tag type
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setType(int $type = TagType::SINGLE) : void
    {
        $this->type = $type;
    }

    /**
     * Get color
     *
     * @return string
     *
     * @since  1.0.0
     */
    public function getColor() : string
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param string $color Tag article color
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setColor(string $color) : void
    {
        $this->color = $color;
    }

    /**
     * Get id
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title Tag article title
     *
     * @return void
     *
     * @since  1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'color' => $this->color,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) \json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}