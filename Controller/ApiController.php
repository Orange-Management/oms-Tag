<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Tag
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Tag\Controller;

use Modules\Tag\Models\Tag;

use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;

/**
 * Tag controller class.
 *
 * @package    Modules\Tag
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Validate tag create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since  1.0.0
     */
    private function validateTagCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['color'] = (!empty($request->getData('color')) && !\ctype_xdigit($request->getData('color'))))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create tag
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTagUpdate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $old = clone TagMapper::get((int) $request->getData('id'));
        $new = $this->updateTagFromRequest($request);
        $this->updateModel($request, $old, $new, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully updated', $new);
    }

    /**
     * Method to update tag from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Tag
     *
     * @since  1.0.0
     */
    private function updateTagFromRequest(RequestAbstract $request) : Tag
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $tag->setTitle((string) ($request->getData('title') ?? $tag->getTitle()));
        $tag->setColor($request->getData('color') ?? $tag->getColor());

        return $tag;
    }

    /**
     * Api method to create tag
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTagCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateTagCreate($request))) {
            $response->set('tag_create', new FormValidation($val));

            return;
        }

        $tag = $this->createTagFromRequest($request);
        $this->createModel($request->getHeader()->getAccount(), $tag, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully created', $tag);
    }

    /**
     * Method to create tag from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Tag
     *
     * @since  1.0.0
     */
    private function createTagFromRequest(RequestAbstract $request) : Tag
    {
        $tag = new Tag();
        $tag->setTitle((string) ($request->getData('title') ?? ''));
        $tag->setColor($request->getData('color') ?? '00000000');

        return $tag;
    }

    /**
     * Api method to get a tag
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTagGet(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully returned', $tag);
    }

    /**
     * Api method to delete tag
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since  1.0.0
     */
    public function apiTagDelete(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        $tag = TagMapper::get((int) $request->getData('id'));
        $this->deleteModel($request, $tag, TagMapper::class, 'tag');
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Tag', 'Tag successfully deleted', $tag);
    }
}
