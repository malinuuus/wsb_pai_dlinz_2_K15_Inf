<?php
require_once "connect.php";

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$birthday = $_POST['birthday'];
$city = $_POST['city'];

$sql = "SELECT id FROM cities WHERE city = '$city'";
$result = $conn->query($sql);
$id = $result->fetch_assoc()['id'];

$sql = "INSERT INTO users (city_id, firstName, lastName, birthday)
        VALUES ($id, '$firstName', '$lastName', '$birthday')";
$conn->query($sql);

header("location: ../4_db/3_db_table_delete.php");