<?php
// powinno być sprawdzenie, czy istnieje zmienna sesyjna
session_start();
unset($_SESSION["logged"]);
$_SESSION["success"] = "Prawidłowo wylogowano użytkownika!";
header("location: ../pages/index.php");