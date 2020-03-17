<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Html;
use Awf\Text\Text;

defined('_AKEEBA') or die();

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

$router   = $this->container->router;
$inCMS    = $this->container->segment->get('insideCMS', false);
$token    = $this->container->session->getCsrfToken()->getValue();
?>

{{-- Configuration Wizard pop-up --}}
@if($this->promptForConfigurationWizard)
    @include('Configuration/confwiz_modal')
@endif

{{-- AdBlock warning --}}
@include('Main/warning_adblock')

{{-- Stuck database updates warning --}}
@if ($this->stuckUpdates)
	<?php $resetUrl = $router->route('index.php?view=Main&task=forceUpdateDb');	?>
    <div class="akeeba-block--failure">
        <p>
			<?php
			echo Text::sprintf('COM_AKEEBA_CPANEL_ERR_UPDATE_STUCK',
				$this->getContainer()->appConfig->get('prefix', 'solo_'),
				$resetUrl
			) ?>
        </p>
    </div>
@endif

{{-- mbstring warning --}}
@unless($this->checkMbstring)
    <div class="akeeba-block--failure">
		@sprintf('COM_AKEEBA_CPANEL_ERR_MBSTRING_' . ($inCMS ? 'WORDPRESS' : 'SOLO'), PHP_VERSION)
    </div>
@endunless

{{-- Front-end backup secret word reminder --}}
@unless(empty($this->frontEndSecretWordIssue))
    <div class="akeeba-block--warning">
        <h3>@lang('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_HEADER')</h3>
        <p>@lang('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_INTRO')</p>
        <p>{{ $this->frontEndSecretWordIssue }}</p>
        <p>
            @lang('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_WHATTODO_SOLO')
			@sprintf('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_WHATTODO_COMMON', $this->newSecretWord)
        </p>
        <p>
            <a class="akeeba-btn--green--large"
               href="@route('index.php?view=Main&task=resetSecretWord&' . $token . '=1')">
                <span class="akion-android-refresh"></span>
                @lang('COM_AKEEBA_CPANEL_BTN_FESECRETWORD_RESET')
            </a>
        </p>
    </div>
@endunless

{{-- Old PHP version reminder --}}
@include('Main/warning_phpversion')

@unless(empty($this->configUrl))
    <div class="akeeba-block--failure" id="config-readable-error" style="display: none">
        <h3>
			@lang('SOLO_MAIN_ERR_CONFIGREADABLE_HEAD')
        </h3>
        <p>
			@sprintf('SOLO_MAIN_ERR_CONFIGREADABLE_BODY', ($this->configUrl))
        </p>
    </div>
@endunless

@unless(empty($this->backupOutputUrl))
    <div class="akeeba-block--failure" id="output-readable-error" style="display:none">
        <h3>
			@lang('SOLO_MAIN_ERR_OUTPUTREADABLE_HEAD')
        </h3>
        <p>
			@sprintf('SOLO_MAIN_ERR_OUTPUTREADABLE_BODY', $this->backupOutputUrl)
        </p>
    </div>
@endunless

{{-- You need to enter your Download ID --}}
@if ($this->needsDownloadId)
    <div class="akeeba-block--success">
        <h3>
            @lang('COM_AKEEBA_CPANEL_MSG_MUSTENTERDLID')
        </h3>
        <p>
			@if($inCMS)
				@sprintf('COM_AKEEBA_LBL_CPANEL_NEEDSDLID', 'https://www.akeebabackup.com/instructions/1557-akeeba-solo-download-id-2.html')
			@else
				@sprintf('COM_AKEEBA_LBL_CPANEL_NEEDSDLID', 'https://www.akeebabackup.com/instructions/1539-akeeba-solo-download-id.html')
			@endif
        </p>
        <form name="dlidform" action="@route('index.php?view=main')" method="post"
              class="akeeba-form--inline">
            <input type="hidden" name="task" value="applyDownloadId"/>
            <input type="hidden" name="token"
                   value="@token()">

            <div class="akeeba-form-group">
                <label for="dlid">
					@lang('COM_AKEEBA_CPANEL_MSG_PASTEDLID')
                </label>
                <input type="text" id="dlid" name="dlid"
                       placeholder="@lang('COM_AKEEBA_CONFIG_DOWNLOADID_LABEL')" class="form-control">
            </div>
            <div class="akeeba-form-group--actions">
                <button type="submit" class="akeeba-btn--green">
                    <span class="akion-checkmark"></span>
					@lang('COM_AKEEBA_CPANEL_MSG_APPLYDLID')
                </button>
            </div>
        </form>
    </div>
@endif

{{-- You have CORE; you need to upgrade, not just enter a Download ID --}}
@if ($this->warnCoreDownloadId)
    <div class="akeeba-block--failure">
		@lang('SOLO_MAIN_LBL_NEEDSUPGRADE')
    </div>
@endif

<div class="akeeba-block--failure" style="display: none;" id="cloudFlareWarn">
    <h3>@lang('COM_AKEEBA_CPANEL_MSG_CLOUDFLARE_WARN')</h3>
    <p>@sprintf('COM_AKEEBA_CPANEL_MSG_CLOUDFLARE_WARN1', 'https://support.cloudflare.com/hc/en-us/articles/200169456-Why-is-JavaScript-or-jQuery-not-working-on-my-site-')</p>
</div>
