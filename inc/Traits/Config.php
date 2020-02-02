<?php

namespace CF\Traits;

/**
 * Trait Config
 * @package CF\Traits
 */
trait Config
{
    /**
     * @var \CF\Core\Config;
     */
    protected $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = $GLOBALS['CF_Config'];

        if(method_exists($this, '__construct'))
        {
            parent::__construct();
        }
    }
}
