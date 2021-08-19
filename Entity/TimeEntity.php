<?php

namespace Service\ClickUp\Entity;

class TimeEntity extends BaseEntity
{
    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $id;

    /**
     * @openToSerialize
     * @var Task
     */
    protected Task $task;

    // TODO поменять на обьект
    /**
     * @openToSerialize
     * @var User
     */
    protected User $user;

    /**
     * @openToSerialize
     * @var Status
     */
    protected Status $status;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $startTime;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $endTime;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $duration;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->task = new Task($arData['task']);
        $this->status = new Status($arData['task']['status']);
        $this->startTime = $arData['start'];
        $this->endTime = $arData['end'];
        $this->duration = $arData['duration'];
        $this->user = new User($arData['user']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function getDuration() : string
    {
        return $this->duration;
    }
}