<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Configuration;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Uri\Uri;
use Awf\Utils\Template;
use Solo\Application;
use Solo\Helper\Escape;
use Solo\View\ViewTraits\ProfileIdAndName;

/**
 * The view class for the Configuration view
 */
class Html extends \Solo\View\Html
{
	use ProfileIdAndName;

	/**
	 * The configuration definition and values in JSON format, for use by the configuration GUI renderer
	 *
	 * @var  string
	 */
	public $json;

	/**
	 * Status of the settings encryption: -1 disabled by user, 0 not available, 1 enabled and active
	 *
	 * @var  int
	 */
	public $securesettings = 0;

	public $mediadir;

	/**
	 * Should I show the Configuration Wizard popup prompt?
	 *
	 * @var  bool
	 */
	public $promptForConfigurationWizard = false;

	public function onBeforeMain()
	{
		$document = $this->container->application->getDocument();

		// Load the necessary Javascript
		Template::addJs('media://js/solo/configuration.js', $this->container->application);

		// Push configuration in JSON format
		$this->json = Factory::getEngineParamsProvider()->getJsonGuiDefinition();

		$this->getProfileIdAndName();

		// Are the settings secured?
		$this->securesettings = $this->getSecureSettingsOption();

		// Should I show the Configuration Wizard popup prompt?
		$this->promptForConfigurationWizard = Factory::getConfiguration()->get('akeeba.flag.confwiz', 0) != 1;

		// Push the media folder name @todo Do we really use it?
		$media_folder   = URI::base(false, $this->container) . '/media/';
		$this->mediadir = Escape::escapeJS($media_folder . 'theme/');

		// Append buttons to the toolbar
		$buttons = [
			[
				'title'   => 'SOLO_BTN_SAVECLOSE',
				'class'   => 'akeeba-btn--green',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'save\')',
				'icon'    => 'akion-checkmark-circled',
			],
			[
				'title'   => 'SOLO_BTN_SAVE',
				'class'   => 'akeeba-btn--grey',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'apply\')',
				'icon'    => 'akion-checkmark',
			],
			[
				'title'   => 'SOLO_BTN_SAVENEW',
				'class'   => 'akeeba-btn--grey',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'savenew\')',
				'icon'    => 'akion-ios-copy',
			],
			[
				'title'   => 'SOLO_BTN_CANCEL',
				'class'   => 'akeeba-btn--orange',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'cancel\')',
				'icon'    => 'akion-close-circled',
			],
			[
				'title' => 'COM_AKEEBA_CONFWIZ',
				'class' => 'akeeba-btn--teal',
				'url'   => $this->container->router->route('index.php?view=wizard'),
				'icon'  => 'akion-flash',
			],
		];

		if (AKEEBABACKUP_PRO)
		{
			$buttons[] = [
				'title' => 'COM_AKEEBA_SCHEDULE',
				'class' => 'akeeba-btn--grey',
				'url'   => $this->container->router->route('index.php?view=schedule'),
				'icon'  => 'akion-android-calendar',
			];
		}


		$toolbar = $document->getToolbar();
		foreach ($buttons as $button)
		{
			$toolbar->addButtonFromDefinition($button);
		}

		// All done, show the page!
		return true;
	}

	/**
	 * Returns the support status of settings encryption. The possible values are:
	 * -1 Disabled by the user
	 *  0 Enabled by inactive (not supported by the server)
	 *  1 Enabled and active
	 *
	 * @return  int
	 */
	private function getSecureSettingsOption()
	{
		// Encryption is disabled by the user
		if (Platform::getInstance()->get_platform_configuration_option('useencryption', -1) == 0)
		{
			return -1;
		}

		// Encryption is not supported by this server
		if (!Factory::getSecureSettings()->supportsEncryption())
		{
			return 0;
		}

		$filename = $this->container->basePath . Application::secretKeyRelativePath;

		// Encryption enabled, supported and a key file is present: encryption enabled
		if (is_file($filename))
		{
			return 1;
		}

		// Encryption enabled, supported but and a key file is NOT present: encryption not available
		return 0;
	}
}
