<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        session_start();
        $_SESSION["error"] = "Wypełnij wszystkie pola w formularzu";
        echo "<script>history.back()</script>";
        exit();
    }
}

$hashedPassword = password_hash($_POST["pass1"], PASSWORD_ARGON2I);

require_once "connect.php";
// zabezpieczenie przed sql injection
$stmt = $conn->prepare("INSERT INTO users (email, city_id, firstName, lastName, birthday, password, created_at) VALUES (?, ?, ? ,?, ?, ?, CURRENT_TIMESTAMP());");
$stmt->bind_param("sissss", $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $hashedPassword);
$stmt->execute();

echo $stmt->affected_rows;