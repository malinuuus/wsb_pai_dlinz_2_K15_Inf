<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
session_start();
$error = 0;

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola w formularzu!";
        $error++;
        break;
    }
}

if ($error == 0 && $_POST["email1"] !== $_POST["email2"]) {
    $_SESSION["error"] = "Adres email musi być taki sam!";
    $error++;
}

if ($error == 0 && $_POST["pass1"] !== $_POST["pass2"]) {
    $_SESSION["error"] = "Hasło musi być takie samo w obu polach!";
    $error++;
}

if ($error == 0 && !isset($_POST["terms"])) {
    $_SESSION["error"] = "Zatwierdź regulamin!";
    $error++;
}

if ($error != 0) {
    echo "<script>history.back()</script>";
    exit();
}

$hashedPassword = password_hash($_POST["pass1"], PASSWORD_ARGON2I);

require_once "connect.php";
// zabezpieczenie przed sql injection
$stmt = $conn->prepare("INSERT INTO users (email, city_id, firstName, lastName, birthday, password, created_at) VALUES (?, ?, ? ,?, ?, ?, CURRENT_TIMESTAMP());");
$stmt->bind_param("sissss", $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $hashedPassword);
$stmt->execute();

echo $stmt->affected_rows;
$_SESSION["error"] = "Zarejestrowano użytkownika";
header("location: ../pages/register.php");