<?php

namespace Service\ClickUp\Entity;

class ListEntity extends BaseEntity
{
    /** @var string|mixed @openToSerialize */
    protected string $id = '';
    /** @var string|mixed @openToSerialize */
    protected string $name = '';
    protected ?int $orderIndex;
    /** @var array|mixed|null @openToSerialize */
    protected ?array $status;
    protected ?array $priority;
    /** @var string|mixed|null @openToSerialize */
    protected ?string $assignee;
    protected ?string $taskCount;
    /** @var Statuses @openToSerialize */
    protected Statuses $statuses;

    public function __construct(?array $arData)
    {
        if (!$arData) {
            return;
        }

        $this->id = $arData['id'];
        $this->name = $arData['name'];
        $this->orderIndex = $arData['orderindex'];
        $this->priority = $arData['priority'];
        $this->assignee = $arData['assignee'];
        $this->taskCount = $arData['task_count'];
        $this->status = $arData['status'];
        $this->statuses = new Statuses($arData['statuses']);
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getOrderIndex() : ?int
    {
        return $this->orderIndex;
    }

    public function getStatus() : ?array
    {
        return $this->status;
    }

    public function getPriority() : ?array
    {
        return $this->priority;
    }

    public function getAssignee() : ?array
    {
        return $this->assignee;
    }

    public function getTaskCount() : ?string
    {
        return $this->taskCount;
    }

    public function getStatuses() : Statuses
    {
        return $this->statuses;
    }
}