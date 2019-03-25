<?php

namespace citysites\okwidget;

use citysites\okwidget\config\AbstractConfig;
use citysites\okwidget\config\GroupConfig;
use citysites\okwidget\config\ShareConfig;
use yii\base\InvalidConfigException;

class ConfigFactory
{
    /**
     * @param array $config
     * @return AbstractConfig
     * @throws InvalidConfigException
     */
    public static function build(array $config)
    {
        $type = $config['type'];
        unset($config['type']);
        switch($type) {
            case OKWidget::TYPE_SHARE:
                return new ShareConfig($config);
            case OKWidget::TYPE_GROUP:
                return new GroupConfig($config);
            default:
                throw new InvalidConfigException('Unknown config type');
        }
    }
}
