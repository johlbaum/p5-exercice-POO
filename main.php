<?php

require('DBConnect.php');
require('ContactManager.php');
require('Contact.php');
require('Command.php');

while (true) {
    $line = readline("Entrez votre commande : ");

    //Afficher la liste des commandes.
    if ($line === "help") {
        $command = new Command;
        $command->help();
        //Afficher la liste des contacts.
    } elseif ($line === "list") {
        $command = new Command;
        $command->list();
        //Afficher un contact à partir de son id. Exemple : "detail id".
    } elseif (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command = new Command;
        $command->detail($contactId);
        //Création d'un nouveau contact. Exemple : "create name, email, phone_number".
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
        //Suppression d'un contact. Exemple : "delete id".
    } elseif (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command = new Command;
        $command->delete($contactId);
        //Mis à jour d'un contact. Exemple : "modify id name, email, phone_number".
    } elseif (preg_match('/^modify (\d+) ([a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+)?), (.*), (\d+)$/', $line, $matches)) {
        if (filter_var($matches[3], FILTER_VALIDATE_EMAIL)) {
            $updatedContact = [
                "id" => $matches[1],
                "name" => $matches[2],
                "email" => $matches[3],
                "phone_number" => $matches[4]
            ];
            $command = new Command;
            $command->modify($updatedContact);
        } else {
            echo "Le format de l'email est non valide.\n";
        }
        //Si la commande n'est pas valide, afficher un message d'erreur.
    } else {
        echo "Commande non valide.\n";
    }
}
