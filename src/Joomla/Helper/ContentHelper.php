<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Helper;

use \Joomla\CMS\Categories\Categories;
use \Joomla\Registry\Registry;


/**
 * Helper/utility class for working with joomla articles and categories
 */
class ContentHelper
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
        $result = $model->getItem($id);
        return $result;
    }

}
