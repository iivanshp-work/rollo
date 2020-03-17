<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Solo\View\Main;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Mvc\Model;
use Awf\Utils\Template;
use Solo\Helper\Status;
use Solo\Model\Main;
use Solo\Model\Stats;

class Html extends \Solo\View\Html
{
	public $profile;
	public $profileList;
	public $quickIconProfiles;
	public $configUrl;
	public $backupOutputUrl;
	public $needsDownloadId;
	public $warnCoreDownloadId;
	public $frontEndSecretWordIssue;
	public $newSecretWord;
	public $desktop_notifications;
	public $statsIframe;
	public $checkMbstring = true;
	public $aclChecks = array();

	/**
	 * The HTML for the backup status cell
	 *
	 * @var   string
	 */
	public $statusCell = '';

	/**
	 * HTML for the warnings (status details)
	 *
	 * @var   string
	 */
	public $detailsCell = '';

	/**
	 * Details of the latest backup as HTML
	 *
	 * @var   string
	 */
	public $latestBackupCell = '';

	/**
	 * Do I have stuck updates pending?
	 *
	 * @var  bool
	 */
	public $stuckUpdates = false;

	/**
	 * Should I prompt the user ot run the configuration wizard?
	 *
	 * @var  bool
	 */
	public $promptForConfigurationWizard = false;

	/**
	 * How many warnings do I have to display?
	 *
	 * @var  int
	 */
	public $countWarnings = 0;

	/**
	 * The fancy formatted changelog of the component
	 *
	 * @var  string
	 */
	public $formattedChangelog = '';

	/** @var int Timestamp when the Core user last dismissed the upsell to Pro */
	public $lastUpsellDismiss = 0;

	public function onBeforeMain()
	{
		/** @var Main $model */
		$model   = $this->getModel();

		$statusHelper      = Status::getInstance();

		$session = $this->container->segment;

		$this->profile             = Platform::getInstance()->get_active_profile();
		$this->profileList         = $model->getProfileList();
		$this->quickIconProfiles   = $model->getQuickIconProfiles();
		$this->statusCell          = $statusHelper->getStatusCell();
		$this->detailsCell         = $statusHelper->getQuirksCell();
		$this->latestBackupCell    = $statusHelper->getLatestBackupDetails();

		if (!$this->container->segment->get('insideCMS', false))
		{
			$this->configUrl = $model->getConfigUrl();
		}

		$this->backupOutputUrl = $model->getBackupOutputUrl();

		$this->needsDownloadId    = $model->needsDownloadID();
		$this->warnCoreDownloadId = $model->mustWarnAboutDownloadIdInCore();

		$this->checkMbstring           = $model->checkMbstring();
		$this->frontEndSecretWordIssue = $model->getFrontendSecretWordError();
		$this->newSecretWord           = $session->get('newSecretWord', null);
		$this->stuckUpdates            = ($this->container->appConfig->get('updatedb', 0) == 1);
		$this->promptForConfigurationWizard = Factory::getConfiguration()->get('akeeba.flag.confwiz', 0) == 0;
		$this->countWarnings           = count(Factory::getConfigurationChecks()->getDetailedStatus());

		$this->desktop_notifications  = Platform::getInstance()->get_platform_configuration_option('desktop_notifications', '0') ? 1 : 0;
		$this->formattedChangelog     = $this->formatChangelog();

		$this->lastUpsellDismiss = $this->container->appConfig->get('lastUpsellDismiss', 0);

		/** @var Stats $statsModel */
		$statsModel        = Model::getTmpInstance($this->container->application_name, 'Stats', $this->container);
		$this->statsIframe = $statsModel->collectStatistics(true);

		// Load the Javascript for this page
		Template::addJs('media://js/solo/main.js', $this->container->application);

		$cloudFlareTestURN  = 'CLOUDFLARE::'. \Awf\Utils\Template::parsePath('media://js/solo/system.js', false, $this->getContainer()->application);
		$updateInformationUrl = $this->getContainer()->router->route('index.php?view=main&format=raw&task=getUpdateInformation&' . $this->getContainer()->session->getCsrfToken()->getValue() . '=1');
		$js                    = <<< JS
akeeba.loadScripts.push(function() {
			akeeba.ControlPanel.displayCloudFlareWarning('$cloudFlareTestURN');
			akeeba.System.addEventListener(document.getElementById('btnchangelog'), 'click', akeeba.ControlPanel.showChangelog);
			akeeba.ControlPanel.showReadableFileWarnings('$this->configUrl', '$this->backupOutputUrl');
			akeeba.ControlPanel.getUpdateInformation("$updateInformationUrl");
			
			if ($this->desktop_notifications)
			{
				akeeba.System.notification.askPermission();
			}  
});

JS;

		$document = $this->container->application->getDocument();
		$document->addScriptDeclaration($js);

		return true;
	}

	/**
	 * Performs automatic access control checks
	 *
	 * @param   string  $view  The view being considered
	 * @param   string  $task  The task being considered
	 *
	 * @return  bool  True if access is allowed
	 *
	 * @throws \RuntimeException
	 */
	public function canAccess($view, $task)
	{
		$view = strtolower($view);
		$task = strtolower($task);

		if (!isset($this->aclChecks[$view]))
		{
			return true;
		}

		if (!isset($this->aclChecks[$view][$task]))
		{
			if (!isset($this->aclChecks[$view]['*']))
			{
				return true;
			}

			$requiredPrivileges = $this->aclChecks[$view]['*'];
		}
		else
		{
			$requiredPrivileges = $this->aclChecks[$view][$task];
		}

		$user = $this->container->userManager->getUser();

		foreach ($requiredPrivileges as $privilege)
		{
			if (!$user->getPrivilege('akeeba.' . $privilege))
			{
				return false;
			}
		}

		return true;
	}

	protected function formatChangelog($onlyLast = false)
	{
		$container = $this->getContainer();
		$filePath = isset($container['changelogPath']) ? $container['changelogPath'] : null;

		if (empty($filePath))
		{
			$filePath = APATH_BASE . '/CHANGELOG.php';
		}

		$ret   = '';
		$file  = $filePath;
		$lines = @file($file);

		if (empty($lines))
		{
			return $ret;
		}

		array_shift($lines);

		foreach ($lines as $line)
		{
			$line = trim($line);

			if (empty($line))
			{
				continue;
			}

			$type = substr($line, 0, 1);

			switch ($type)
			{
				case '=':
					continue 2;
					break;

				case '+':
					$ret .= "\t" . '<li class="akeeba-changelog-added"><span></span>' . htmlentities(trim(substr($line, 2))) . "</li>\n";
					break;

				case '-':
					$ret .= "\t" . '<li class="akeeba-changelog-removed"><span></span>' . htmlentities(trim(substr($line, 2))) . "</li>\n";
					break;

				case '~':
					$ret .= "\t" . '<li class="akeeba-changelog-changed"><span></span>' . htmlentities(trim(substr($line, 2))) . "</li>\n";
					break;

				case '!':
					$ret .= "\t" . '<li class="akeeba-changelog-important"><span></span>' . htmlentities(trim(substr($line, 2))) . "</li>\n";
					break;

				case '#':
					$ret .= "\t" . '<li class="akeeba-changelog-fixed"><span></span>' . htmlentities(trim(substr($line, 2))) . "</li>\n";
					break;

				default:
					if (!empty($ret))
					{
						$ret .= "</ul>";
						if ($onlyLast)
						{
							return $ret;
						}
					}

					if (!$onlyLast)
					{
						$ret .= "<h3 class=\"akeeba-changelog\">$line</h3>\n";
					}
					$ret .= "<ul class=\"akeeba-changelog\">\n";

					break;
			}
		}

		return $ret;
	}
}
