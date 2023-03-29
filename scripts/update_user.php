<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo "<script>history.back();</script>";
        $_SESSION['error'] = 'Wypełnij wszystkie pola w formularzu';
        exit();
    }
}

require_once './connect.php';
$sql = "UPDATE users
        SET city_id = $_POST[city_id],
        firstName = '$_POST[firstName]',
        lastName = '$_POST[lastName]',
        birthday = '$_POST[birthday]'
        WHERE id = $_GET[updateUserId]";
$conn->query($sql);

if ($conn->affected_rows == 1) {
    $_SESSION['error'] = "Prawidłowo zaktualizowano rekord";
} else {
    $_SESSION['error'] = "Nie zaktualizowano rekordu!";
}

header("location: ../4_db/5_db_table_update.php");