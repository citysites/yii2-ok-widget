<?php

namespace citysites\okwidget\config;

use yii\base\InvalidConfigException;

class GroupConfig extends AbstractConfig
{

    const MIN_WIDTH = 200;
    const MAX_WIDTH = 525;

    const MIN_HEIGHT = 135;
    const MAX_HEIGHT = 400;

    const VIEW_TYPE_PARTICIPANT = '';
    const VIEW_TYPE_FEED = 'feed';

    private $width = self::MIN_WIDTH;
    private $height = self::MIN_HEIGHT;
    private $viewType = self::VIEW_TYPE_PARTICIPANT;
    private $groupId;

    /**
     * @param array $config
     * @throws InvalidConfigException
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['groupId'])) {
            throw new InvalidConfigException('Groupid is required');
        }
        parent::__construct($config);
    }

    /**
     * @param int $width
     * @throws InvalidConfigException
     */
    public function setWidth($width)
    {
        if ($width < self::MIN_WIDTH || $width > self::MAX_WIDTH) {
            throw new InvalidConfigException('Invalid width value');
        }
        $this->width = $width;
    }

    /**
     * @param int $height
     * @throws InvalidConfigException
     */
    public function setHeight($height)
    {
        if ($height < self::MIN_HEIGHT || $height > self::MAX_HEIGHT) {
            throw new InvalidConfigException('Invalid width value');
        }
        $this->height = $height;
    }

    /**
     * @param string $viewType
     * @throws InvalidConfigException
     */
    public function setViewType($viewType)
    {
        if (!in_array($viewType, [self::VIEW_TYPE_FEED, self::VIEW_TYPE_PARTICIPANT], true)) {
            throw new InvalidConfigException('Invalid type');
        }
        $this->viewType = $viewType;
    }

    /**
     * @param string $groupId
     * @throws InvalidConfigException
     */
    public function setGroupId($groupId)
    {
        if (!is_string($groupId)) {
            throw new InvalidConfigException('Invalid group id value');
        }
        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return array
     */
    protected function getParams()
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'type' => $this->viewType
        ];
    }
}
