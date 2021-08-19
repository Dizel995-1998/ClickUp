<?php

namespace Service\ClickUp\Entity;

class Interval extends BaseEntity
{
    /**
     * @openToSerialize
     * @var string
     */
    protected string $id;

    /**
     * @openToSerialize
     * @var string
     */
    protected string $startTimestamp;

    /**
     * @openToSerialize
     * @var string
     */
    protected string $endTimestamp;

    /**
     * @openToSerialize
     * @var string
     */
    protected string $duringTime;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->startTimestamp = $arData['start'];
        $this->endTimestamp = $arData['end'];
        $this->duringTime = $arData['time'];
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getStartTimestamp() : string
    {
        return $this->startTimestamp;
    }

    public function getEndTimestamp() : string
    {
        return $this->endTimestamp;
    }

    public function getCommonTime() : string
    {
        return $this->duringTime;
    }
}