<?php

session_start();

// Löschen aller Session-Variablen
$_SESSION = array();

// Zerstören der Session
session_destroy();

// Weiterleitung zur index.html
header("Location: index.html");

?>
