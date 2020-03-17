<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Log;

use Akeeba\Engine\Factory;
use Awf\Utils\Template;
use Solo\Model\Log;
use Solo\View\ViewTraits\ProfileIdAndName;

class Html extends \Solo\View\Html
{
	use ProfileIdAndName;

	/**
	 * List of available log files
	 *
	 * @var  array
	 */
	public $logs = array();

	/**
	 * Currently selected log file tag
	 *
	 * @var  string
	 */
	public $tag;

	/**
	 * Is the select log too big for being
	 *
	 * @var bool
	 */
	public $logTooBig = false;

	/**
	 * Size of the log file
	 *
	 * @var int
	 */
	public $logSize = 0;

	/**
	 * Big log file threshold: 2Mb
	 */
	const bigLogSize = 2097152;

	/**
	 * Setup the main log page
	 *
	 * @return  boolean
	 */
	public function onBeforeMain()
	{
		/** @var Log $model */
		$model = $this->getModel();
		$this->logs = $model->getLogList();

		$tag = $model->getState('tag', '', 'string');

		if (empty($tag))
		{
			$tag = null;
		}

		$this->tag = $tag;

		// Let's check if the file is too big to display
		if ($this->tag)
		{
			$file = Factory::getLog()->getLogFilename($this->tag);

			if (@file_exists($file))
			{
				$this->logSize   = filesize($file);
				$this->logTooBig = ($this->logSize >= self::bigLogSize);
			}
		}

		// Load the Javascript
		if ($this->logTooBig)
		{
			$src = $this->container->router->route('index.php?view=Log&task=iframe&format=raw&tag=' . urlencode($this->tag));

			$js = <<< JS
akeeba.loadScripts.push(function() {
	akeeba.System.addEventListener(document.getElementById('showlog'), 'click', function(){
		var iFrameHolder = document.getElementById('iframe-holder');
		iFrameHolder.style.display = 'block';
		iFrameHolder.insertAdjacentHTML('beforeend', '<iframe width="99%" src="$src" height="400px"/>');
		this.parentNode.style.display = 'none';
    });
});

JS;

			$document = $this->container->application->getDocument();
			$document->addScriptDeclaration($js);
		}

		$this->getProfileIdAndName();

		return true;
	}

	/**
	 * Setup the iframe display
	 *
	 * @return  boolean
	 */
	public function onBeforeIframe()
	{
		/** @var Log $model */
		$model = $this->getModel();
		$tag = $model->getState('tag', '', 'string');

		if (empty($tag))
		{
			$tag = null;
		}

		$this->tag = $tag;

		$this->setLayout('raw');

		$this->container->application->getDocument()->setMimeType('text/html');

		return true;
	}
}
