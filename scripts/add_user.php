<?php
// trzeba rozpocząć sesję, żeby korzystać ze zmiennych sesyjnych
// w pliku php.ini można włączyć automatyczne włączanie sesji
session_start();
// print_r($_POST);

$error = 0;

foreach ($_POST as $key => $value) {
    // echo "$key: $value<br>";
    // zwraca true jeśli wartość jest pusta lub nie istnieje
    if (empty($value)) {
        $_SESSION['error'] = 'Wypełnij wszystkie pola w formularzu';
        $error++;
    }
}

if (!isset($_POST["term"])) {
    $_SESSION["error"] = "Zatwierdź regulamin!";
    $error++;
}

if ($error != 0) {
    // header("location: ..") wyczyściłoby formularz
    echo "<script>history.back()</script>";
    // bez exit skrypt wykonywałby się dalej mimo pustej wartości
    exit();
}

require_once './connect.php';
$sql = "INSERT INTO users (id, city_id, firstName, lastName, birthday)
        VALUES (NULL, $_POST[city_id], '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]')";
$conn->query($sql);

if ($conn->affected_rows == 1) {
    $_SESSION['error'] = "Prawidłowo dodano rekord";
} else {
    $_SESSION['error'] = "Nie dodano rekordu!";
}

header("location: ../4_db/5_db_table_update.php");