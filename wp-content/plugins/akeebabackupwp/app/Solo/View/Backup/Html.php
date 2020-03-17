<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Backup;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Date\Date;
use Awf\Mvc\Model;
use Awf\Text\Text;
use Awf\Uri\Uri;
use Awf\Utils\Template;
use Solo\Helper\Escape;
use Solo\Helper\Status;
use Solo\Helper\Utils;
use Solo\Model\Main;

/**
 * The view class for the Backup view
 */
class Html extends \Solo\View\Html
{
	public $defaultDescription;

	public $description;

	public $comment;

	public $returnURL;

	public $returnForm;

	public $profileId;

	public $profileName;

	public $domains;

	public $maxExecutionTime;

	public $runtimeBias;

	public $showJPSPassword = 0;

	public $jpsPassword;

	public $showANGIEPassword;

	public $ANGIEPassword;

	public $autoStart;

	public $unwriteableOutput;

	public $hasQuirks;

	public $hasErrors = false;

	/**
	 * Do we have warnings which may affect –but do not prevent– the backup from running?
	 *
	 * @var  bool
	 */
	public $hasWarnings = false;

	/**
	 * The HTML of the warnings cell
	 *
	 * @var  string
	 */
	public $warningsCell = '';

	public $hasCriticalErrors = false;

	public $quirks;

	public $subtitle;

	public $profileList;

	public $desktopNotifications;

	public $backupOnUpdate = false;

	/**
	 * Should I try to automatically resume the backup in case of an error? 0/1
	 *
	 * @var  int
	 */
	public $autoResume = 0;

	/**
	 * After how many seconds should I try to automatically resume the backup?
	 *
	 * @var  int
	 */
	public $autoResumeTimeout = 10;

	/**
	 * How many times in total should I try to automatically resume the backup?
	 *
	 * @var  int
	 */
	public $autoResumeRetries = 3;

	/**
	 * Should I prompt the user to run the Configuration Wizard?
	 *
	 * @var  bool
	 */
	public $promptForConfigurationWizard = false;

	public function onBeforeMain()
	{
		// Load the necessary Javascript
		Template::addJs('media://js/solo/backup.js', $this->container->application);

		/** @var \Solo\Model\Backup $model */
		$model = $this->getModel();

		// Load the Status Helper
		$helper = Status::getInstance();

		// Determine default description
		$default_description = $this->getDefaultDescription();

		// Load data from the model state
		$backup_description  = $model->getState('description', $default_description, 'string');
		$comment             = $model->getState('comment', '', 'html');
		$returnurl           = Utils::safeDecodeReturnUrl($model->getState('returnurl', ''));

		// Get the maximum execution time and bias
		$engineConfiguration = Factory::getConfiguration();
		$maxexec             = $engineConfiguration->get('akeeba.tuning.max_exec_time', 14) * 1000;
		$bias                = $engineConfiguration->get('akeeba.tuning.run_time_bias', 75);

		// Check if the output directory is writable
		$warnings         = Factory::getConfigurationChecks()->getDetailedStatus();
		$unwritableOutput = array_key_exists('001', $warnings);

		$this->hasErrors                    = !$helper->status;
		$this->hasWarnings                  = $helper->hasQuirks();
		$this->warningsCell                 = $helper->getQuirksCell(!$helper->status);
		$this->defaultDescription           = $default_description;
		$this->description                  = $backup_description;
		$this->comment                      = $comment;
		$this->domains                      = json_encode($this->getDomains());
		$this->maxExecutionTime             = $maxexec;
		$this->runtimeBias                  = $bias;
		$this->returnURL                    = $returnurl;
		$this->unwriteableOutput            = $unwritableOutput;
		$this->autoStart                    = $model->getState('autostart', 0, 'boolean');
		$this->desktopNotifications         =  Platform::getInstance()->get_platform_configuration_option('desktop_notifications', '0') ? 1 : 0;
		$this->autoResume                   = $engineConfiguration->get('akeeba.advanced.autoresume', 1);
		$this->autoResumeTimeout            = $engineConfiguration->get('akeeba.advanced.autoresume_timeout', 10);
		$this->autoResumeRetries            = $engineConfiguration->get('akeeba.advanced.autoresume_maxretries', 3);
		$this->promptForConfigurationWizard = $engineConfiguration->get('akeeba.flag.confwiz', 0) == 0;

		if ($engineConfiguration->get('akeeba.advanced.archiver_engine', 'jpa') == 'jps')
		{
			$this->showJPSPassword = 1;
			$this->jpsPassword     = $engineConfiguration->get('engine.archiver.jps.key', '');
		}

		// Always show ANGIE password: we add that feature to the Core version as well
		$this->showANGIEPassword = 1;
		$this->ANGIEPassword     = $engineConfiguration->get('engine.installer.angie.key', '');

		// Push the return URL for POST redirects
		$this->returnForm = $model->getState('returnform', '');

		// Push the profile ID and name
		$this->profileId   = Platform::getInstance()->get_active_profile();
		$this->profileName = $this->escape(Platform::getInstance()->get_profile_name($this->profileId));

		// Should we display the notice about backup on update?
		$inCMS = $this->container->segment->get('insideCMS', false);
		$backupOnUpdate = $this->input->getInt('backuponupdate', 0);

		if ($inCMS && $backupOnUpdate)
		{
			$this->backupOnUpdate = true;
		}

		// Set the toolbar title
		$this->subtitle = Text::_('COM_AKEEBA_BACKUP');

		// Push the list of profiles
		/** @var Main $cpanelModel */
		$cpanelModel       = Model::getInstance($this->container->application_name, 'Main', $this->container);
		$this->profileList = $cpanelModel->getProfileList();

		if (!$this->hasCriticalErrors)
		{
			$this->container->application->getDocument()->getMenu()->disableMenu('main');
		}

		// All done, show the page!
		return true;
	}

	/**
	 * Get the default description for this backup attempt
	 *
	 * @return  string
	 */
	private function getDefaultDescription()
	{
		// Get the backup description and comment
		$tz      = $this->container->appConfig->get('timezone', 'UTC');
		$user    = $this->container->userManager->getUser();
		$user_tz = $user->getParameters()->get('timezone', null);

		if (!empty($user_tz))
		{
			$tz = $user_tz;
		}

		$date = new Date('now', $tz);

		$default_description = Text::_('COM_AKEEBA_BACKUP_DEFAULT_DESCRIPTION') . ' ' . $date->format(Text::_('DATE_FORMAT_LC2'), true);

		return $default_description;
	}

	/**
	 * Get a list of backup domain keys and titles
	 *
	 * @return  array
	 */
	private function getDomains()
	{
		$engineConfiguration = Factory::getConfiguration();
		$script              = $engineConfiguration->get('akeeba.basic.backup_type', 'full');
		$scripting           = Factory::getEngineParamsProvider()->loadScripting();
		$domains             = array();

		if (empty($scripting))
		{
			return $domains;
		}

		foreach ($scripting['scripts'][ $script ]['chain'] as $domain)
		{
			$description = Text::_($scripting['domains'][ $domain ]['text']);
			$domain_key  = $scripting['domains'][ $domain ]['domain'];
			$domains[]   = array($domain_key, $description);
		}

		return $domains;
	}
}
