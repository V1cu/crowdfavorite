<?php

namespace CF\Core;

/**
 * Class Config
 */
class Config
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->loadConfigData(
            CF_THEME_DIR . 'inc/Config/Common.php',
            'common'
        );
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function load($fileName)
    {
        $fileName = rtrim(strtolower($fileName), '.php');
        $filePath = CF_THEME_DIR . 'inc/Config/' . ucfirst($fileName) . '.php';

        $this->loadConfigData(
            $filePath,
            $fileName
        );

        return $this;
    }

    /**
     * @param string $container
     * @param string|null $key
     * @param mixed $default
     * @return mixed|null
     */
    public function item($container, $key = null, $default = null)
    {
        return empty($key) ? $this->items[$container] ?? $default : $this->items[$container][$key] ?? $default;
    }

    /**
     * @param string $filePath
     * @param string $container
     */
    private function loadConfigData($filePath, $container)
    {
        if (file_exists($filePath)) {
            $configData = require_once $filePath;

            if (is_array($configData)) {
                $this->items[$container] = $configData;
            }
        }
    }
}
