<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Model\Admin;


/**
 * Base class for creating nested item based back-end models
 */
class NestedItemModel extends ItemModel
{

    /**
     * Method to save the form data
     * -------------------------------------------------------------------------
     * @param   array    $data  The form data
     *
     * @return  bool
     */
    public function save($data)
    {
        // Initialise some local variables
        $table      = $this->getTable();
        $pk         = (!empty($data['id'])) ? $data['id'] : (int) $this->getState($this->getName() . '.id');
		$isNew      = true;

        // Load the row if saving an existing category.
		if ($pk > 0) {
			$table->load($pk);
			$isNew = false;
		}

        // Revert parent_id if tring to make the item a child of itself.
        if ($data['parent_id'] == $pk) {
            $data['parent_id'] = $table->parent_id;
        }

        // Set the new parent id if parent id has changed or the item is new.
		if ($table->parent_id != $data['parent_id'] || $isNew) {
			$table->setLocation($data['parent_id'], 'last-child');
		}

        // Bind the data.
		if (!$table->bind($data)) {
			$this->setError($table->getError());
			return false;
		}

        // Check the data.
		if (!$table->check()) {
			$this->setError($table->getError());
			return false;
		}

        // Store the data.
		if (!$table->store()) {
			$this->setError($table->getError());
			return false;
		}

        // Rebuild the path for the category:
		if (!$table->rebuildPath($table->id)) {
			$this->setError($table->getError());
			return false;
		}

        // Rebuild the paths of the category's children:
		if (!$table->rebuild($table->id, $table->lft,
            $table->level, $table->path)) {

			$this->setError($table->getError());
			return false;
		}

        $this->setState($this->getName() . '.id', $table->id);

        // Clear the cache
		$this->cleanCache();

        // Return true to indicate success
        return true;
    }

}
