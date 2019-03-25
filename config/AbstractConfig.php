<?php

namespace citysites\okwidget\config;

use yii\base\BaseObject;
use yii\helpers\Json;

abstract class AbstractConfig extends BaseObject
{
    /**
     * @return string
     */
    public function getParamsAsJson()
    {
        return Json::encode(array_filter($this->getParams()));
    }

    /**
     * @return array
     */
    abstract protected function getParams();
}
