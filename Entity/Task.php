<?php

namespace Service\ClickUp\Entity;

class Task extends BaseEntity
{
    /** @var string|mixed @openToSerialize  */
    protected string $id;
    protected ?string $customId;
    protected ?string $textContent;
    /** @var string|mixed @openToSerialize */
    protected string $name;
    /** @var string|mixed|null @openToSerialize */
    protected ?string $description;
    protected array $status; // TODO сделать в виде обьекта
    protected ?string $orderIndex;
    /** @var string|mixed @openToSerialize */
    protected ?string $dateCreatedUnixTimestamp;
    /** @var string|mixed @openToSerialize */
    protected ?string $dateUpdatedUnixTimestamp;
    protected array $creator; // TODO сделать в виде обьекта
    /** @var array|mixed @openToSerialize */
    protected array $assignees;
    /** @var array|mixed @openToSerialize */
    protected array $tags;
    /** @var array|mixed @openToSerialize */
    protected array $customFields;
    /** @var ListEntity @openToSerialize */
    protected ListEntity $list;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->customId = $arData['custom_id'];
        $this->name = $arData['name'];
        $this->textContent = $arData['text_content'];
        $this->description = $arData['description'];
        $this->status = $arData['status'];
        $this->orderIndex = $arData['orderindex'];
        $this->dateCreatedUnixTimestamp = $arData['date_created'];
        $this->dateUpdatedUnixTimestamp = $arData['date_updated'];
        $this->creator = $arData['creator'] ?: [];
        $this->assignees = $arData['assignees'] ?: [];
        $this->tags = $arData['tags'] ?: [];
        $this->customFields = $arData['custom_fields'] ?: [];
        $this->list = new ListEntity($arData['list']);
    }

    public function getList() : ListEntity
    {
        return $this->list;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCustomId() : ?string
    {
        return $this->customId;
    }

    public function getStatus() : array
    {
        return $this->status;
    }

    public function getOrderIndex() : string
    {
        return $this->orderIndex;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getDateCreatedUnixTimestamp() : string
    {
        return $this->dateCreatedUnixTimestamp;
    }

    public function getDateUpdatedUnixTimestamp() : string
    {
        return $this->dateUpdatedUnixTimestamp;
    }

    public function getCreator() : string
    {
        return $this->creator;
    }

    public function getAssignees() : array
    {
        return $this->assignees;
    }

    public function getTags() : array
    {
        return $this->tags;
    }

    public function getCustomFields() : array
    {
        return $this->customFields;
    }

    public function getTextContent() : string
    {
        return $this->textContent;
    }
}