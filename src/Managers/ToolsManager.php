<?php

namespace WpifyPlugin\Managers;

use Wpify\Core_2_0\Abstracts\AbstractManager;
use WpifyPlugin\Plugin;
use Wpify\Tools\CopyrightShortcode;
use Wpify\Tools\CustomSMTP;
use Wpify\Tools\DeferScripts;
use Wpify\Tools\DisableEmbeds;
use Wpify\Tools\DisableEmojis;
use Wpify\Tools\DisableXmlRpc;
use Wpify\Tools\RemoveAccentInFilenames;
use Wpify\Tools\RemoveScriptVersion;

/**
 * Class ToolsManager
 * @package WpifyPlugin\Managers
 * @property Plugin $plugin
 */
class ToolsManager extends AbstractManager
{
  protected $modules = [
    CopyrightShortcode::class,
    CustomSMTP::class,
    DeferScripts::class,
    DisableEmbeds::class,
    DisableEmojis::class,
    DisableXmlRpc::class,
    RemoveAccentInFilenames::class,
    RemoveScriptVersion::class,
  ];
}
