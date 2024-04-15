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
}
