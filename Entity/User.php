<?php

namespace Service\ClickUp\Entity;

class User extends BaseEntity
{
    /**
     * @openToSerialize
     * @var string
     */
    protected string $id;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $userName;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $email;

    /**
     * @openToSerialize
     * @var string|mixed
     */
    protected string $color;

    /**
     * @openToSerialize
     * @var string|mixed|null
     */
    protected ?string $profilePicture = null;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->userName = $arData['username'];
        $this->email = $arData['email'];
        $this->color = $arData['color'];
        $this->profilePicture = $arData['profilePicture'];
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->userName;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    public function getPicture() : ?string
    {
        return $this->profilePicture;
    }
}