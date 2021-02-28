<?php

namespace WpifyPlugin\Managers;

use WpifyPlugin\Plugin;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractManager;
use WpifyPluginDeps\Wpify\Tools\CopyrightShortcode;
use WpifyPluginDeps\Wpify\Tools\CustomSMTP;
use WpifyPluginDeps\Wpify\Tools\DeferScripts;
use WpifyPluginDeps\Wpify\Tools\DisableEmbeds;
use WpifyPluginDeps\Wpify\Tools\DisableEmojis;
use WpifyPluginDeps\Wpify\Tools\DisableXmlRpc;
use WpifyPluginDeps\Wpify\Tools\RemoveAccentInFilenames;
use WpifyPluginDeps\Wpify\Tools\RemoveScriptVersion;

/**
 * Class ToolsManager
 *
 * @package WpifyPlugin\Managers
 * @property Plugin $plugin
 */
class ToolsManager extends AbstractManager {
  protected $modules = array(
  	//CopyrightShortcode::class,
    //CustomSMTP::class,
    //DeferScripts::class,
    //DisableEmbeds::class,
    //DisableEmojis::class,
    //DisableXmlRpc::class,
    //RemoveAccentInFilenames::class,
    //RemoveScriptVersion::class,
  );
}
