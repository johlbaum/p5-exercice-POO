<?php

class Command
{
    private ContactManager $contactManager;

    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    public function detail($contactId): void
    {
        $contact = $this->contactManager->findById($contactId);

        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }

        echo $contact . "\n";
    }

    public function create($newContact): void
    {
        $contact = $this->contactManager->create($newContact);

        echo "Contact créé : " . $contact . "\n";
    }

    public function delete($contactId): void
    {
        $contactToDelete = $this->contactManager->findById($contactId);

        if ($contactToDelete) {
            $this->contactManager->delete($contactId);

            echo "Contact supprimé : " . $contactToDelete . "\n";
        } else {
            echo "Contact non trouvé\n";
        }
    }

    public function modify($updatedContact): void
    {
        $updatedContact = $this->contactManager->modify($updatedContact);

        echo "Contact mis à jour : " . $updatedContact . "\n";
    }

    public function help(): void
    {
        echo "help : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "create [nom], [email], [telephone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "quit : quitte le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces, virgules et majuscules sont importantes.\n";
    }
}
