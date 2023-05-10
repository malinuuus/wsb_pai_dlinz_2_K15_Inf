<?php
session_start();
// sprawdzenie, czy formularz jest wysłany metodą POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $errors = [];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[] = "Pole $key musi być wypełnione!";
        }
    }

    if (sizeof($errors) > 0) {
        $_SESSION["error"] = $errors;
        echo "<script>history.back()</script>";
        exit();
    }

    echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); // usuwa niedozwolone znaki
    echo $email;
} else {
    header("location: ../pages");
}