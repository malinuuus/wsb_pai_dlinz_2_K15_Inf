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
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back()</script>";
        exit();
    }

//    echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";
//    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL); // usuwa niedozwolone znaki
//    echo $email;
    require_once "connect.php";
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $error = 0;

    if ($result->num_rows != 0) {
        $user = $result->fetch_assoc();
        $userId = $user["id"];
        $addressIp = $_SERVER["REMOTE_ADDR"]; // adres ip

        if (password_verify($_POST["pass"], $user["password"])) {
            $_SESSION["logged"]["firstName"] = $user["firstName"];
            $_SESSION["logged"]["lastName"] = $user["lastName"];
            $_SESSION["logged"]["role_id"] = $user["role_id"];
            $_SESSION["logged"]["session_id"] = session_id(); // identyfikator sesji

            // logs
            $stmt = $conn->prepare("INSERT INTO logs (user_id, status, address_ip) VALUES (?, 1, ?)");
            $stmt->bind_param("is", $userId, $addressIp);
            $stmt->execute();

            header("location: ../pages/logged.php");
            exit();
        } else {
            // logs
            $stmt = $conn->prepare("INSERT INTO logs (user_id, status, address_ip) VALUES (?, 0, ?)");
            $stmt->bind_param("is", $userId, $addressIp);
            $stmt->execute();

            $error = 1;
        }
    } else {
        $error = 1;
    }

    if ($error != 0) {
        $_SESSION["error"] = "Błędny login lub hasło!";
        echo "<script>history.back();</script>";
        exit();
    }
} else {
    header("location: ../pages");
}