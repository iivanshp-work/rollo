<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Browser;


use Solo\Model\Browser;

class Html extends \Solo\View\Html
{
	/**
	 * Path to current folder (with variables such as [SITEROOT] replaced)
	 *
	 * @var  string
	 */
	public $folder = '';

	/**
	 * Path to current folder (WITHOUT variables such as [SITEROOT] replaced)
	 *
	 * @var  string
	 */
	public $folder_raw = '';

	/**
	 * Parent folder
	 *
	 * @var  string
	 */
	public $parent = '';

	/**
	 * Does the current folder exist in the filesystem?
	 *
	 * @var  bool
	 */
	public $exists = false;

	/**
	 * Is the current folder under the site's root directory? False means it's an off-site directory.
	 *
	 * @var  bool
	 */
	public $inRoot = false;

	/**
	 * Is the current folder restricted by open_basedir?
	 *
	 * @var  bool
	 */
	public $openbasedirRestricted = false;

	/**
	 * Is the current folder writable?
	 *
	 * @var  bool
	 */
	public $writable = false;

	/**
	 * Subdirectories
	 *
	 * @var  array
	 */
	public $subfolders = [];

	/**
	 * Breadcrumbs to display in the browser view
	 *
	 * @var  array
	 */
	public $breadcrumbs = [];

	/**
	 * Pull the folder browser data from the model
	 *
	 * @return  boolean
	 */
	public function onBeforeMain()
	{
		/** @var Browser $model */
		$model = $this->getModel();

		$this->folder                = $model->getState('folder', '', 'string');
		$this->folder_raw            = $model->getState('folder_raw', '', 'string');
		$this->parent                = $model->getState('parent', '', 'string');
		$this->exists                = $model->getState('exists', 0, 'boolean');
		$this->inRoot                = $model->getState('inRoot', 0, 'boolean');
		$this->openbasedirRestricted = $model->getState('openbasedirRestricted', 0, 'boolean');
		$this->writable              = $model->getState('writable', 0, 'boolean');
		$this->subfolders            = $model->getState('subfolders');
		$this->breadcrumbs           = $model->getState('breadcrumbs');

		return true;
	}
}
