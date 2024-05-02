<?php

class Contact
{
    private int $contactId;
    private string $name;
    private string $email;
    private string $phoneNumber;

    public function __construct(int $contactId, string $name, string $email, string $phoneNumber)
    {
        $this->contactId = $contactId;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function getContactId(): int
    {
        return $this->contactId;
    }

    public function setContactId(int $id): void
    {
        $this->contactId = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function __toString(): string
    {
        return $this->contactId . ' ' . $this->name . ' ' . $this->email . ' ' . $this->phoneNumber;
    }
}
