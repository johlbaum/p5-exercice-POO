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
}
