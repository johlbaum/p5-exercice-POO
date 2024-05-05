<?php

require('config.php');
require('DBConnect.php');
require('ContactManager.php');
require('Contact.php');
require('Command.php');

// Cette classe contient l'ensemble des commandes qui pourront être demandées par l'utilisateur.
$command = new Command();

while (true) {
    //Commande de l'utilisateur.
    $line = readline("Entrez votre commande : ");

    //Afficher la liste des commandes.
    if ($line === "help") {
        $command->help();
        continue;
    }

    //Afficher la liste des contacts.
    if ($line === "list") {
        $command->list();
        continue;
    }

    //Afficher un contact à partir de son id. Format : "detail id".
    if (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command->detail($contactId);
        continue;
    }

    //Création d'un nouveau contact. Format : "create name, email, phone_number".
    if (preg_match('/^create ([a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+)?), (.*), (\d+)$/', $line, $matches)) {
        if (filter_var($matches[2], FILTER_VALIDATE_EMAIL)) {
            $newContact = [
                "name" => $matches[1],
                "email" => $matches[2],
                "phone_number" => $matches[3]
            ];
            $command->create($newContact);
            continue;
        } else {
            echo "Le format de l'email est non valide.\n";
            continue;
        }
    }

    //Suppression d'un contact. Format : "delete id".
    if (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $contactId = $matches[1];
        $command->delete($contactId);
        continue;
    }

    //Mis à jour d'un contact. Format : "modify id name, email, phone_number".
    if (preg_match('/^modify (\d+) ([a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+)?), (.*), (\d+)$/', $line, $matches)) {
        if (filter_var($matches[3], FILTER_VALIDATE_EMAIL)) {
            $updatedContact = [
                "id" => $matches[1],
                "name" => $matches[2],
                "email" => $matches[3],
                "phone_number" => $matches[4]
            ];
            $command->modify($updatedContact);
            continue;
        } else {
            echo "Le format de l'email est non valide.\n";
            continue;
        }
    }

    //Quitter le programme.
    if ($line == "quit") {
        break;
    }

    //Si la commande n'est pas valide, afficher un message d'erreur.
    echo "Commande non valide : $line\n";
}
