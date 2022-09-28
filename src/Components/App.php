<?php

namespace Afosto\ShopCtrl\Components;

use Afosto\ShopCtrl\Helpers\Exceptions\AppException;
use GuzzleHttp\Client;
use Psr\Cache\CacheItemPoolInterface;

class App
{

    /**
     * @var Client
     */
    private $_client;

    /**
     * @var App
     */
    private static $_instance;

    /**
     * @var Settings
     */
    private $_settings;

    /**
     * App constructor.
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        if ($settings->validate()) {
            $this->_settings = $settings;
            $this->_client = new Client(
                [
                    'base_uri' => $this->_settings->baseUrl,
                    'auth'     => [
                        $this->_settings->username,
                        $this->_settings->password,
                    ],
                    'timeout'  => 25,
                    'headers'  => [
                        'User-Agent' => 'Afosto/Client/2.0',
                    ],

                ]
            );
        }
    }

    /**
     * @return App
     * @throws AppException
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            throw new AppException('Cannot call app that was not initialized');
        }

        return self::$_instance;
    }

    /**
     * @param Settings $settings
     */
    public static function init(Settings $settings,CacheItemPoolInterface $cache)
    {
        self::$_instance = new self($settings);
        self::getInstance()->getSettings()->init($cache);
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws AppException
     */
    public function getSetting($key)
    {
        if ($this->_settings->{$key} === null) {
            throw new AppException('Setting not found');
        }

        return $this->_settings->{$key};
    }

    /**
     * @return Settings
     */
    public function getSettings()
    {
        return $this->_settings;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSetting($key, $value)
    {
        $this->_settings->{$key} = $value;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }

}