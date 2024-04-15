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
    }
}
