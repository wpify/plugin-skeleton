<?php

namespace Wpify\Managers;

use Wpify\Core\AbstractManager;
use Wpify\Tools\CopyrightShortcode;
use Wpify\Tools\CustomSMTP;
use Wpify\Tools\DeferScripts;
use Wpify\Tools\DisableEmbeds;
use Wpify\Tools\DisableEmojis;
use Wpify\Tools\DisableXmlRpc;
use Wpify\Tools\RemoveAccentInFilenames;
use Wpify\Tools\RemoveScriptVersion;

class CptManager extends AbstractManager
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
