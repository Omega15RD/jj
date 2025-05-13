<?php
// Connexió a la base de dades
$mysqli = new mysqli("localhost", "root", "", "gasolinera"); 

if ($mysqli->connect_errno) {
    echo "Error de connexió: " . $mysqli->connect_error;
    exit();
}