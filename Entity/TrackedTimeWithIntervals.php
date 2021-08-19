<?php

namespace Service\ClickUp\Entity;

class TrackedTimeWithIntervals
{
    /**
     * @openToSerialize
     * @var User
     */
    protected User $user;

    /**
     * @openToSerialize
     * @var int
     */
    protected int $time;
    /**
     * @openToSerialize
     * @var IntervalCollection
     */
    protected IntervalCollection $intervalsCollection;

    public function __construct(array $arData)
    {
        $arData = current($arData);
        $this->user = new User($arData['user']);
        $this->time = $arData['time'];
        $this->intervalsCollection = new IntervalCollection($arData['intervals']);
    }


    public function getUser() : User
    {
        return $this->user;
    }

    public function getIntervalsCollection() : IntervalCollection
    {
        return $this->intervalsCollection;
    }
}