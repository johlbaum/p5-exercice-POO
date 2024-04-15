<?php

class Command
{
    public function list(): void
    {
        $contactManager = new ContactManager;
        $contacts = $contactManager->findAll();

        foreach ($contacts as $contact) {
            $contact->toString();
        }
    }

    public function detail($contactId): void
    {
        $contactManager = new ContactManager;
        $contact = $contactManager->findById($contactId);

        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }

        $contact->toString();
    }

    public function create($newContact): void
    {
        $contactManager = new ContactManager;
        $contact = $contactManager->create($newContact);

        echo "Contact créé : ";
        $contact->toString();
    }
}
