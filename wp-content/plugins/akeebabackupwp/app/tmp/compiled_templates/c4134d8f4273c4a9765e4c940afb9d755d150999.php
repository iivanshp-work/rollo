<?php /* /home/rollo/rollo.net.ua/www/wp-content/plugins/akeebabackupwp/app/Solo/ViewTemplates/Backup/script.blade.php */ ?>
<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

// Protect from unauthorized access
use Awf\Text\Text;
use Awf\Uri\Uri;
use Solo\Helper\Escape;

defined('_AKEEBA') or die();

/** @var \Solo\View\Backup\Html $this */
$router = $this->getContainer()->router;

$strings['UI-LASTRESPONSE'] = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_LASTRESPONSE'));
$strings['UI-STW-CONTINUE'] = Escape::escapeJS(Text::_('STW_MSG_CONTINUE'));

$strings['UI-BACKUPSTARTED']   = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPSTARTED'));
$strings['UI-BACKUPFINISHED']  = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPFINISHED'));
$strings['UI-BACKUPHALT']      = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPHALT'));
$strings['UI-BACKUPRESUME']    = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPRESUME'));
$strings['UI-BACKUPHALT_DESC'] = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPHALT_DESC'));
$strings['UI-BACKUPFAILED']    = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPFAILED'));
$strings['UI-BACKUPWARNING']   = Escape::escapeJS(Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPWARNING'));

$escapedDefaultDescription = addslashes($this->defaultDescription);
$escapedDescription        = addslashes(empty($this->description) ? $this->defaultDescription : $this->description);
$escapedComment            = addslashes($this->comment);
$escapedAngiePassword      = addslashes($this->ANGIEPassword);
$escapedJpsKey             = $this->showJPSPassword ? addslashes($this->jpsPassword) : '';
$autoResume                = (int) $this->autoResume;
$autoResumeTimeout         = (int) $this->autoResumeTimeout;
$autoResumeRetries         = (int) $this->autoResumeRetries;
$maxExecTime               = (int) $this->maxExecutionTime;
$runtimeBias               = (int) $this->runtimeBias;
$ajaxURL				   = $router->route('index.php?view=backup&task=ajax');
$logURL           		   = $router->route('index.php?view=log');
$aliceURL         		   = $router->route('index.php?view=alices');
$escapedJuriBase           = addslashes(Uri::base());
$escapedDomains            = addcslashes($this->domains, "'\\");
$escapedReturnURL          = addcslashes($this->returnURL, "'\\");
$returnForm				   = $this->returnForm? 'true' : 'false';
$iconURL				   = Uri::base(false, $this->getContainer()) . '/media/logo/' . $this->getContainer()->iconBaseName . '-96.png';
$innerJS = <<< JS
	// Initialization
	akeeba.Backup.defaultDescription = "$escapedDefaultDescription";
	akeeba.Backup.currentDescription = "$escapedDescription";
	akeeba.Backup.currentComment     = "$escapedComment";
	akeeba.Backup.config_angiekey    = "$escapedAngiePassword";
	akeeba.Backup.jpsKey             = "$escapedJpsKey";

	// Auto-resume setup
	akeeba.Backup.resume.enabled = $autoResume;
	akeeba.Backup.resume.timeout = $autoResumeTimeout;
	akeeba.Backup.resume.maxRetries = $autoResumeRetries;

	// The return URL
	akeeba.Backup.returnUrl = '{$escapedReturnURL}';

	// Used as parameters to start_timeout_bar()
	akeeba.Backup.maxExecutionTime = $maxExecTime;
	akeeba.Backup.runtimeBias = $runtimeBias;

	// Create a function for saving the editor's contents
	akeeba.Backup.commentEditorSave = function() {
	};

	akeeba.System.notification.iconURL = '{$iconURL}';

	//Parse the domain keys
	akeeba.Backup.domains = JSON.parse('$escapedDomains');

	// Setup AJAX proxy URL
	akeeba.System.params.AjaxURL = '{$ajaxURL}';

	// Setup return form for POST redirects
	akeeba.Backup.returnForm = $returnForm;

	// Setup base View Log URL
	akeeba.Backup.URLs.LogURL = '{$logURL}';
	akeeba.Backup.URLs.AliceURL = '{$aliceURL}';

	// Push translations
	akeeba.Backup.translations['UI-LASTRESPONSE'] = '{$strings['UI-LASTRESPONSE']}';
	akeeba.Backup.translations['UI-STW-CONTINUE'] = '{$strings['UI-STW-CONTINUE']}';

	akeeba.Backup.translations['UI-BACKUPSTARTED']  = '{$strings['UI-BACKUPSTARTED']}';
	akeeba.Backup.translations['UI-BACKUPFINISHED']  = '{$strings['UI-BACKUPFINISHED']}';
	akeeba.Backup.translations['UI-BACKUPHALT'] = '{$strings['UI-BACKUPHALT']}';
	akeeba.Backup.translations['UI-BACKUPRESUME']  = '{$strings['UI-BACKUPRESUME']}';
	akeeba.Backup.translations['UI-BACKUPHALT_DESC']  = '{$strings['UI-BACKUPHALT_DESC']}';
	akeeba.Backup.translations['UI-BACKUPFAILED']  = '{$strings['UI-BACKUPFAILED']}';
	akeeba.Backup.translations['UI-BACKUPWARNING']  = '{$strings['UI-BACKUPWARNING']}';
JS;

if ($this->desktopNotifications)
{
	$innerJS .= <<< JS
	akeeba.System.notification.askPermission();

JS;
}

if (!$this->unwriteableOutput && $this->autoStart)
{
	$innerJS .= <<< JS

	akeeba.Backup.start();

JS;
}
else
{
	$innerJS .= <<< JS
	
	// Bind start button's click event
	akeeba.System.addEventListener(document.getElementById('backup-start'), 'click', function(e){
		akeeba.Backup.start();
	});

	akeeba.System.addEventListener(document.getElementById('backup-default'), 'click', akeeba.Backup.restoreDefaultOptions);

	// Work around Safari which ignores autocomplete=off (FOR CRYING OUT LOUD!)
	setTimeout(akeeba.Backup.restoreCurrentOptions, 500);

JS;
}

$js = <<< JS

;// This comment is intentionally put here to prevent badly written plugins from causing a Javascript error
// due to missing trailing semicolon and/or newline in their code.
akeeba.System.documentReady(function(){
	$innerJS
});

JS;

?>
<?php $this->container->application->getDocument()->addScriptDeclaration($js); ?>