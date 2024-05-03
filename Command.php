<?php

/**
 * Classe qui permet de gérer les commandes tapées par l'utilisateur. 
 */
class Command
{
    private ContactManager $contactManager;

    /**
     * Le constructeur de la classe. Il permet d'initialiser le manager de Contact.
     */
    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    /**
     * Commande "help" : affiche l'aide.
     * @return void
     */
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

    /**
     * Commande "list" : affiche la liste des contacts.
     * @return void
     */
    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode.
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    /**
     * Commande "detail" : affiche le détail d'un contact.
     * @param int $contactId : id du contact à afficher.
     * @return void
     */
    public function detail(int $contactId): void
    {
        $contact = $this->contactManager->findById($contactId);

        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }

        echo $contact . "\n";
    }

    /**
     * Commande "create" : crée un contact.
     * @param array $newContact : un tableau associatif avec les informations d'un contact. 
     * @return void
     */
    public function create(array $newContact): void
    {
        $contact = $this->contactManager->create($newContact);

        echo "Contact créé : " . $contact . "\n";
    }

    /**
     * Commande "delete" : supprime un contact.
     * @param int $contactId : l'id du contact à supprimer.
     * @return void
     */
    public function delete(int $contactId): void
    {
        $contactToDelete = $this->contactManager->findById($contactId);

        if ($contactToDelete) {
            $this->contactManager->delete($contactId);

            echo "Contact supprimé : " . $contactToDelete . "\n";
        } else {
            echo "Contact non trouvé\n";
        }
    }

    /**
     * Commande "modify" : met à jour un contact.
     * @param array $updatedContact : un tableau associatif avec les informations d'un contact mises à jour.
     * @return void
     */
    public function modify(array $updatedContact): void
    {
        $updatedContact = $this->contactManager->modify($updatedContact);

        echo "Contact mis à jour : " . $updatedContact . "\n";
    }
}
