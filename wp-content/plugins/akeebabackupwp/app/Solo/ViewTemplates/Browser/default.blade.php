<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2020 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Text\Text;use Solo\Helper\Escape;

defined('_AKEEBA') or die();

/** @var \Solo\View\Browser\Html $this */

$rootDirWarning = Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_UI_ROOTDIR'));

$script =
	<<<JS
	function akeeba_browser_useThis()
	{
		var rawFolder = document.forms.adminForm.folderraw.value;
		if( rawFolder == '[SITEROOT]' )
		{
			alert('$rootDirWarning');
			rawFolder = '[SITETMP]';
		}
		window.parent.akeeba.Configuration.onBrowserCallback( rawFolder );
	}

JS;

$router = $this->getContainer()->router;
?>
@inlineJs($script, 'text/javascript')

@if (empty($this->folder))
	<form action="@route('index.php?view=browser&tmpl=component&processfolder=0')" method="post"
		  name="adminForm" id="adminForm">
		<input type="hidden" name="folder" id="folder" value=""/>
		<input type="hidden" name="token"
			   value="@token()"/>
	</form>
@endif

@if(!(empty($this->folder)))
    <div class="akeeba-panel--100 akeeba-panel--primary">
        <div>
            <form action="@route('index.php?view=browser&tmpl=component')" method="post"
                  name="adminForm" id="adminForm" class="akeeba-form--inline--with-hidden--no-margins">

                <div class="akeeba-form-group">
                    <span title="@lang($this->writable ? 'COM_AKEEBA_CPANEL_LBL_WRITABLE' : 'COM_AKEEBA_CPANEL_LBL_UNWRITABLE')"
                          class="{{ $this->writable ? 'akeeba-label--green' : 'akeeba-label--red' }}"
                    >
                        <span class="{{ $this->writable ? 'akion-checkmark-circled' : 'akion-ios-close' }}"></span>
                    </span>
                </div>

                <div class="akeeba-form-group">
                    <input type="text" name="folder" id="folder" size="40"  value="{{{ $this->folder }}}" />
                </div>

                <div class="akeeba-form-group--action">
                    <button class="akeeba-btn--primary" onclick="this.form.submit(); return false;">
                        <span class="akion-folder"></span>
                        @lang('COM_AKEEBA_BROWSER_LBL_GO')
                    </button>

                    <button class="akeeba-btn--green" onclick="akeeba_browser_useThis(); return false;">
                        <span class="akion-share"></span>
                        @lang('COM_AKEEBA_BROWSER_LBL_USE')
                    </button>
                </div>

                <div class="akeeba-hidden-fields-container">
                    <input type="hidden" name="token" value="@token()"/>
                    <input type="hidden" name="folderraw" id="folderraw" value="<?php echo $this->folder_raw ?>"/>
                </div>
            </form>
        </div>
    </div>

    @if (count($this->breadcrumbs))
    <div class="akeeba-panel--100 akeeba-panel--information">
        <div>
            <ul class="akeeba-breadcrumb">
	            <?php $i = 0 ?>
                @foreach($this->breadcrumbs as $crumb)
		            <?php $i++; ?>
                    <li class="{{ ($i < count($this->breadcrumbs)) ? '' : 'active' }}">
                        @if($i < count($this->breadcrumbs))
                            <a href="{{{ $router->route("index.php?view=browser&tmpl=component&folder=" . urlencode($crumb['folder'])) }}}">
                                {{{ $crumb['label'] }}}
                            </a>
                            <span class="divider">&bull;</span>
                        @else
                            {{{ $crumb['label'] }}}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="akeeba-panel--100 akeeba-panel">
        <div>
            @if (count($this->subfolders))
                <table class="akeeba-table akeeba-table--striped">
                    <tr>
                        <td>
                            <?php $linkbase = $router->route("index.php?&view=browser&tmpl=component&folder="); ?>
                            <a class="akeeba-btn--dark--small"
                               href="<?php echo $linkbase . urlencode($this->parent); ?>">
                                <span class="akion-arrow-up-a"></span>
                                @lang('COM_AKEEBA_BROWSER_LBL_GOPARENT')
                            </a>
                        </td>
                    </tr>
                    @foreach ($this->subfolders as $subfolder)
                        <tr>
                            <td>
                                <a href="<?php echo $linkbase . urlencode($this->folder . '/' . $subfolder); ?>"><?php echo htmlentities($subfolder) ?></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                @if (!$this->exists)
                    <div class="akeeba-block--failure">
                        @lang('COM_AKEEBA_BROWSER_ERR_NOTEXISTS')
                    </div>
                @elseif (!$this->inRoot)
                    <div class="akeeba-block--warning">
                        @lang('COM_AKEEBA_BROWSER_ERR_NONROOT')
                    </div>
                @elseif ($this->openbasedirRestricted)
                    <div class="akeeba-block--failure">
                        @lang('COM_AKEEBA_BROWSER_ERR_BASEDIR')
                    </div>
                @else
                    <table class="akeeba-table--striped">
                        <tr>
                            <td>
                                <?php $linkbase = $router->route("index.php?&view=browser&tmpl=component&folder="); ?>
                                <a class="akeeba-btn--dark--small"
                                   href="<?php echo $linkbase . urlencode($this->parent); ?>">
                                    <span class="akion-arrow-up-a"></span>
                                    @lang('COM_AKEEBA_BROWSER_LBL_GOPARENT')
                                </a>
                            </td>
                        </tr>
                    </table>
                @endif {{-- secondary block --}}
            @endif {{-- count($this->subfolders) --}}
        </div>
    </div>
@endif