<?php

class ContactManager
{
    public function findAll(): array
    {
        $dbConnect = new DBConnect;
        $pdo = $dbConnect->getPDO();

        $sqlQuery = "SELECT * FROM contact";
        $contactStatement = $pdo->query($sqlQuery);
        $contacts = [];

        while ($contact = $contactStatement->fetch()) {
            $contacts[] = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
        }

        return $contacts;
    }

    public function findById($contactId): ?Contact
    {
        $dbConnect = new DBConnect;
        $pdo = $dbConnect->getPDO();

        $sqlQuery = "SELECT * FROM contact WHERE id = ?";
        $contactStatement = $pdo->prepare($sqlQuery);
        $contactStatement->execute([$contactId]);
        $contact = $contactStatement->fetch();

        if (!$contact) {
            return null;
        }

        return new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
    }

    public function create($newContact): Contact
    {
        $dbConnect = new DBConnect;
        $pdo = $dbConnect->getPDO();

        $sqlQuery = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $createContactStatement = $pdo->prepare($sqlQuery);
        $createContactStatement->execute([
            'name' => $newContact['name'],
            'email' => $newContact['email'],
            'phone_number' => $newContact['phone_number']
        ]);

        $contactId = $pdo->lastInsertId();

        return $this->findById($contactId);
    }

    public function delete($contactId): void
    {
        $dbConnect = new DBConnect;
        $pdo = $dbConnect->getPDO();

        $sqlQuery = "DELETE FROM contact WHERE id = ?";
        $deleteContactStatement = $pdo->prepare($sqlQuery);
        $deleteContactStatement->execute([$contactId]);
    }
}
