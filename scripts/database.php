<?php


// Hostname: localhost, username: your_user, password: your_pass, db: MyDatabase
$mysqli= new mysqli('localhost', 'mitify', 'mitify', 'mitify');

// Oh no! Wanneer er een connect_errno is, hebben we geen verbinding!
if ($mysqli->connect_errno) {
    // In dit geval laat je de gebruiker best iets weten
    echo "Sorry, this website is experiencing connection problems.";
    // Dit doe je best niet op een publieke website
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    // Je zou de gebruiker naar een mooie foutpagina kunnen brengen, of gewoon
    // stoppen
    exit;
}

?>