<?php

/**
 * Classe qui permet de gérer les interactions avec la table contact.
 */
class ContactManager
{
    // L'instance de PDO.
    private $db;

    /**
     * Le constructeur de la classe. Il permet d'initialiser la propriété $db.
     */
    public function __construct()
    {
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Méthode qui permet de récupérer tous les contacts de la base de données.
     * @return array : un tableau d'objets Contact.
     */
    public function findAll(): array
    {
        $sqlQuery = "SELECT * FROM contact";
        $contactStatement = $this->db->prepare($sqlQuery);
        $contactStatement->execute();
        $contacts = [];

        while ($contact = $contactStatement->fetch()) {
            $contacts[] = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
        }

        return $contacts;
    }

    /**
     * Méthode qui permet de récupérer un contact par son id.
     * @param int $contactId : l'id du contact à récupérer.
     * @return Contact|null : le contact correspondant à l'id, ou null si aucun contact n'est trouvé.
     */
    public function findById(int $contactId): ?Contact
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

    /**
     * Méthode qui permet de créer un contact dans la base de données.
     * @param array $newContact : un tableau associatif avec les informations d'un contact. 
     * @return Contact : le contact qui vient d'être créé.
     */
    public function create(array $newContact): Contact
    {
        $sqlQuery = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $createContactStatement = $this->db->prepare($sqlQuery);
        $createContactStatement->execute([
            'name' => $newContact['name'],
            'email' => $newContact['email'],
            'phone_number' => $newContact['phone_number']
        ]);

        // Récupération du dernier id inséré. 
        $contactId = $this->db->lastInsertId();

        return $this->findById($contactId);
    }

    /**
     * Méthode qui permet de supprimer un contact de la base de données.
     * @param int $contactId : l'id du contact à supprimer.
     * @return void
     */
    public function delete(int $contactId): void
    {
        $sqlQuery = "DELETE FROM contact WHERE id = ?";
        $deleteContactStatement = $this->db->prepare($sqlQuery);
        $deleteContactStatement->execute([$contactId]);
    }

    /**
     * Méthode qui permet de mettre à jour un contact de la base de données.
     * @param array $updatedContact : un tableau associatif avec les informations d'un contact mises à jour.
     * @return Contact : le contact qui vient d'être mis à jour.
     */
    public function modify(array $updatedContact): Contact
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
