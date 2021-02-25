<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Helper;

use \Joomla\CMS\Categories\Categories;
use \Joomla\Registry\Registry;
use \Joomla\CMS\Factory;


/**
 * Helper/utility class for working with joomla articles and categories
 */
class ContentHelper extends Helper
{

    /**
     * Get a joomla category by Id
     * -------------------------------------------------------------------------
     * @param  int    $id   Id of the Joomla category
     *
     * @return mixed
     */
    public static function getCategoryById(int $id)
    {
        $result = Categories::getInstance('content')->get($id);
        $result->params = new Registry($result->params);
        return $result;
    }


    /**
     * Get a joomla article by Id
     * -------------------------------------------------------------------------
     * @param  int    $id   Id of the Joomla article
     *
     * @return mixed
     */
    public static function getArticleById(int $id)
    {
        $model = ComponentHelper::getModel('com_content', 'Article');
        $model->setState('params', Factory::getApplication()->getParams());
        $result = $model->getItem($id);

        if ($result) {
            $result->images  = new Registry($result->images);
            $result->urls    = new Registry($result->urls);
            $result->attribs = new Registry($result->attribs);
        }

        return $result;
    }

}
