<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tag\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tag\Models;

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Tag mapper class.
 *
 * @package Modules\Tag\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class TagMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static array $columns = [
        'tag_id'         => ['name' => 'tag_id',         'type' => 'int',    'internal' => 'id'],
        'tag_title'      => ['name' => 'tag_title',      'type' => 'string', 'internal' => 'title'],
        'tag_color'      => ['name' => 'tag_color',      'type' => 'string', 'internal' => 'color'],
        'tag_type'       => ['name' => 'tag_type',       'type' => 'int',    'internal' => 'type'],
        'tag_color'      => ['name' => 'tag_color',      'type' => 'string', 'internal' => 'color'],
        'tag_owner'      => ['name' => 'tag_owner',      'type' => 'int',    'internal' => 'owner'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array<string, string>>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'owner' => [
            'mapper' => AccountMapper::class,
            'src'    => 'tag_owner',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'tag';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'tag_id';
}
