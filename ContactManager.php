<?php

class ContactManager
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnect::getInstance()->getPDO();
    }

    public function findAll(): array
    {
        $sqlQuery = "SELECT * FROM contact";
        $contactStatement = $this->db->query($sqlQuery);
        $contacts = [];

        while ($contact = $contactStatement->fetch()) {
            $contacts[] = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
        }

        return $contacts;
    }

    public function findById($contactId): ?Contact
    {
        $sqlQuery = "SELECT * FROM contact WHERE id = ?";
        $contactStatement = $this->db->prepare($sqlQuery);
        $contactStatement->execute([$contactId]);
        $contact = $contactStatement->fetch();

        if (!$contact) {
            return null;
        }

        return new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
    }

    public function create($newContact): Contact
    {
        $sqlQuery = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $createContactStatement = $this->db->prepare($sqlQuery);
        $createContactStatement->execute([
            'name' => $newContact['name'],
            'email' => $newContact['email'],
            'phone_number' => $newContact['phone_number']
        ]);

        $contactId = $this->db->lastInsertId();

        return $this->findById($contactId);
    }

    public function delete($contactId): void
    {
        $sqlQuery = "DELETE FROM contact WHERE id = ?";
        $deleteContactStatement = $this->db->prepare($sqlQuery);
        $deleteContactStatement->execute([$contactId]);
    }

    public function modify($updatedContact): Contact
    {
        $sqlQuery = "UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id";
        $updatedContactStatement = $this->db->prepare($sqlQuery);
        $updatedContactStatement->execute([
            'id' => $updatedContact['id'],
            'name' => $updatedContact['name'],
            'email' => $updatedContact['email'],
            'phone_number' => $updatedContact['phone_number']
        ]);

        return $this->findById($updatedContact['id']);
    }
}
