<?php

namespace citysites\okwidget\config;

use yii\base\InvalidConfigException;
use yii\validators\UrlValidator;

class ShareConfig extends AbstractConfig
{
    const MIN_SIZE = 12;
    const MAX_SIZE = 150;

    const FORM_OVAL = 'oval';
    const FORM_ROUNDED = 'rounded';
    const FORM_STRAIGHT = 'straight';

    const COUNTER_PLACE_TOP = 1;
    const COUNTER_PLACE_RIGHT = 0;

    const TEXT_LABEL_COOL = 1;
    const TEXT_LABEL_SHARE = 2;
    const TEXT_LABEL_LIKE = 3;
    const TEXT_LABEL_I_LIKE_IT = 4;
    const TEXT_LABEL_INTERESTING = 5;
    const TEXT_LABEL_THIS_IS_INTERESTING = 6;

    private $link = 'document.URL';
    private $title = '';
    private $description = '';
    private $imageUrl = '';
    private $size = 75;
    private $formType = self::FORM_OVAL;
    private $counterType = self::COUNTER_PLACE_RIGHT;
    private $textType = self::TEXT_LABEL_COOL;

    protected function getParams()
    {
        return [
            'sz' => $this->size,
            'st' => $this->formType,
            'vt' => $this->counterType,
            'ck' => $this->textType
        ];
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @throws InvalidConfigException
     */
    public function setLink($link)
    {
        if (!is_string($link)) {
            throw new InvalidConfigException('Invalid link type');
        }
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @throws InvalidConfigException
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            throw new InvalidConfigException('Title must be a string');
        }
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @throws InvalidConfigException
     */
    public function setDescription($description)
    {
        if (!is_string($description)) {
            throw new InvalidConfigException('Description must be a string');
        }
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @throws InvalidConfigException
     */
    public function setImageUrl($imageUrl)
    {
        if (!is_string($imageUrl)) {
            throw new InvalidConfigException('Image url must be a string');
        }
        $urlValidator = new UrlValidator();
        if (!$urlValidator->validate($imageUrl)) {
            throw new InvalidConfigException('Invalid url');
        }
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param int $size
     * @throws InvalidConfigException
     */
    public function setSize($size)
    {
        if (!is_int($size) || $size < self::MIN_SIZE || $size > self::MAX_SIZE) {
            throw new InvalidConfigException('Invalid size value');
        }
        $this->size = $size;
    }

    /**
     * @param string $formType
     * @throws InvalidConfigException
     */
    public function setFormType($formType)
    {
        if (!in_array($formType, [self::FORM_OVAL, self::FORM_ROUNDED, self::FORM_STRAIGHT], true)) {
            throw new InvalidConfigException('Invalid button form type');
        }
        $this->formType = $formType;
    }

    /**
     * @param int $counterType
     * @throws InvalidConfigException
     */
    public function setCounterType($counterType)
    {
        if (!in_array($counterType, [self::COUNTER_PLACE_RIGHT, self::COUNTER_PLACE_TOP], true)) {
            throw new InvalidConfigException('Invalid counter place type');
        }
        $this->counterType = $counterType;
    }

    /**
     * @param int $textType
     * @throws InvalidConfigException
     */
    public function setTextType($textType)
    {
        if ($textType < self::TEXT_LABEL_COOL || $textType > self::TEXT_LABEL_THIS_IS_INTERESTING) {
            throw new InvalidConfigException('Invalid text type');
        }
        $this->textType = $textType;
    }
}
