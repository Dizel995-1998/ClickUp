<?php

namespace Service\ClickUp\Entity;

class Team extends BaseEntity
{
    /**
     * @var string
     * @openToSerialize
     */
    protected string $id;

    /**
     * @var string
     * @openToSerialize
     */
    protected string $name;

    /**
     * @var string
     * @openToSerialize
     */
    protected string $color;

    /**
     * @var string|null
     * @openToSerialize
     */
    protected ?string $avatar;

    /**
     * @var Member[]
     * @openToSerialize
     */
    protected array $members = [];

    /**
     * TODO в будущем применить сериалайзер
     * @param array $arData
     */
    public function __construct(array $arData)
    {
        // TODO добавить валидацию
        $this->name = $arData['name'];
        $this->id = $arData['id'];
        $this->color = $arData['color'];
        $this->avatar = $arData['avatar'];

//        foreach (current($arData['members'])['user'] as $member) {
//            $this->addMember($member);
//        }
    }

    protected function addMember(Member $member)
    {
        $this->members[] = $member;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    public function getAvatar() : ?string
    {
        return $this->avatar;
    }
}