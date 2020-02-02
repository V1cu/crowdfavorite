<?php

namespace CF;

use CF\Core\Config;

/**
 * Class CrowdFavoriteAbstract
 * @package CF
 */
abstract class CrowdFavoriteAbstract
{
    /**
     * @var Config;
     */
    protected $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = $GLOBALS['CF_Config'];
    }
}
