<?php

namespace citysites\okwidget;

use citysites\okwidget\config\AbstractConfig;
use citysites\okwidget\config\GroupConfig;
use citysites\okwidget\config\ShareConfig;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

class OKWidget extends Widget
{
    const TYPE_SHARE = 'share';
    const TYPE_GROUP = 'group';

    /** @var string */
    public $type;

    /** @var AbstractConfig */
    private $config;

    /**
     * @param array $config
     * @throws InvalidConfigException
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['type'])) {
            throw new InvalidConfigException('Invalid widget type');
        }
        $this->config = ConfigFactory::build($config);
        parent::__construct(['type' => $config['type']]);
    }

    /** @return string */
    public function run()
    {
        $this->registerClientScript();
        return Html::tag('div', '', ['id' => $this->getId()]);
    }

    private function registerClientScript()
    {
        $widget = $this->getWidgetCode();
        $this->getView()->registerJs(/** @lang JavaScript */"
            !function (d) {
                var js = d.createElement('script');
                js.src = 'https://connect.ok.ru/connect.js';
                js.onload = js.onreadystatechange = function () {
                    if (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') {
                        if (!this.executed) {
                            this.executed = true;
                            setTimeout(function () {
                                $widget
                            }, 0);
                        }
                    }
                }
                d.documentElement.appendChild(js);
            }(document);
        ");
    }

    /**
     * @return string
     */
    private function getWidgetCode()
    {
        switch($this->type) {
            case self::TYPE_SHARE:
                /** @var ShareConfig $config */
                $config = $this->config;
                return sprintf('OK.CONNECT.insertShareWidget("%s", "%s", \'%s\', "%s", "%s", "%s");', $this->getId(),
                    $config->getLink(), $config->getParamsAsJson(), $config->getTitle(), $config->getDescription(),
                    $config->getImageUrl());
            case self::TYPE_GROUP:
                /** @var GroupConfig $config */
                $config = $this->config;
                return sprintf('OK.CONNECT.insertGroupWidget("%s", "%s", \'%s\');', $this->getId(),
                    $config->getGroupId(), $config->getParamsAsJson());
        }
    }
}
