<?php

require('DBConnect.php');
require('ContactManager.php');
require('Contact.php');
require('Command.php');

while (true) {
    $line = readline("Entrez votre commande : ");
    //Afficher la liste des contacts.
    if ($line === "list") {
        $command = new Command;
        $command->list();
        //Afficher un contact à partir de son id.
    } elseif (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command = new Command;
        $command->detail($contactId);
        //Création d'un nouveau contact.
    } elseif (preg_match('/^create ([a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+)?), (.*), (\d+)$/', $line, $matches)) {
        if (filter_var($matches[2], FILTER_VALIDATE_EMAIL)) {
            $newContact = [
                "name" => $matches[1],
                "email" => $matches[2],
                "phone_number" => $matches[3]
            ];
            $command = new Command;
            $command->create($newContact);
        } else {
            echo "Le format de l'email est non valide.\n";
        }
        //Suppression d'un contact.
    } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command = new Command;
        $command->delete($contactId);
        //Si la commande n'est pas valide, afficher un message d'erreur.
    } else {
        echo "Commande non valide.\n";
    }
}
