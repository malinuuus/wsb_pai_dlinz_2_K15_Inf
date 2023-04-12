<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

require_once "connect.php";
// zabezpieczenie przed sql injection
$stmt = $conn->prepare("INSERT INTO users (email, city_id, firstName, lastName, birthday, password, created_at) VALUES (?, ?, ? ,?, ?, ?, CURRENT_TIMESTAMP());");
$stmt->bind_param("sissss", $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["pass1"]);
$stmt->execute();

echo $stmt->affected_rows;