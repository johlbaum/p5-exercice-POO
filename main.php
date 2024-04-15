<?php

require('DBConnect.php');
require('ContactManager.php');
require('Contact.php');
require('Command.php');

while (true) {
    $line = readline("Entrez votre commande : ");

    if ($line === "list") {
        $command = new Command;
        $command->list();
    } elseif (preg_match('/detail\s+(\d+)/', $line, $matches)) {
        $contactId = $matches[1];
        $command = new Command;
        $command->detail($contactId);
    }
}
