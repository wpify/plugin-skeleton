<?php

namespace WpifyPlugin\Managers;

use Wpify\Core_4_0\Abstracts\AbstractManager;
use WpifyPlugin\Plugin;

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
