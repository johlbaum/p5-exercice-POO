<?php

/**
 * Classe qui représente un contact.
 */
class Contact
{
    private int $contactId;
    private string $name;
    private string $email;
    private string $phoneNumber;

    /**
     * Constructeur de la classe Contact.
     * @param int contactId : id du contact.
     * @param string $name : nom du contact.
     * @param string $email : email du contact.
     * @param string $phoneNumber : téléphone du contact.
     */
    public function __construct(int $contactId, string $name, string $email, string $phoneNumber)
    {
        $this->contactId = $contactId;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Getter pour l'id du contact.
     * @return int
     */
    public function getContactId(): int
    {
        return $this->contactId;
    }

    /**
     * Setter pour l'id du contact.
     * @param int $id : l'id du contact. 
     * @return void
     */
    public function setContactId(int $id): void
    {
        $this->contactId = $id;
    }

    /**
     * Getter pour le nom du contact.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Setter pour le nom du contact.
     * @param string $name : le nom du contact. 
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Getter pour l'email du contact.
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Setter l'email du contact.
     * @param string $email : l'email du contact. 
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Getter pour le téléphone du contact.
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Setter pour le téléphone du contact.
     * @param string $phoneNumber : le téléphone du contact. 
     * @return void
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Méthode pour convertir l'objet Contact en une représentation sous forme de chaîne de caractères.
     * @return string
     */
    public function __toString(): string
    {
        return $this->contactId . ' ' . $this->name . ' ' . $this->email . ' ' . $this->phoneNumber;
    }
}
