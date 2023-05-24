<?php
// sanityzacja
// poszukać czemu trim nie działa
function sanitizeInput(&$input) {
    $input = htmlspecialchars(strip_tags(trim($input)));
    return $input;
}
//
//echo strlen(sanitizeInput($_POST["firstName"]))."<br>";
//echo sanitizeInput($_POST["firstName"]);
//exit();

//echo $_POST["firstName"].", długość: ".strlen($_POST["firstName"])."<br>";
//sanitizeInput($_POST["firstName"]);
//echo $_POST["firstName"].", długość: ".strlen($_POST["firstName"])."<br>";
//exit();

// działa też, jeśli ktoś próbuje zmienić method na post w dev toolsach
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // tablica z nazwami wymaganych pól
    $required_fields = ["firstName", "lastName", "email1", "email2", "pass1", "pass2", "birthday", "city_id", "gender"];
    session_start();
    $error = 0;
    $errors = [];

    foreach ($required_fields as $value) {
        if (empty($_POST[$value])) {
            $errors[] = "Pole <b>$value</b> jest wymagane!";
            $error++;
        }
    }

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

    if ($_POST["email1"] !== $_POST["email2"])
        $errors[] = "Adres email musi być taki sam!";

    if ($_POST["additional_email1"] !== $_POST["additional_email2"]) {
        $errors[] = "Adres email musi być taki sam!";
    } else {
        if (empty($_POST["additional_email1"]))
            $_POST["additional_email1"] = null;
    }

    if ($_POST["pass1"] !== $_POST["pass2"])
        $errors[] = "Hasło musi być takie samo w obu polach!";

    if (!isset($_POST["gender"]))
        $errors[] = "Zaznacz płeć!";

    if (!isset($_POST["terms"]))
        $errors[] = "Zatwierdź regulamin!";

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back();</script>";
        exit();
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
        $_SESSION["error"] = "Hasło nie spełnia wymagań!";
        echo "<script>history.back();</script>";
        exit();
    }

    // sprawdzenie, czy email już istnieje
    require_once "connect.php";
    if ($error == 0) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $_POST["email1"]);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $errors = "Podany e-mail jest zajęty!";
            $error++;
        }
    }

    if ($error != 0) {
        echo "<script>history.back()</script>";
        exit();
    }

    // sanityzacja - dokończyć
//    foreach ($_POST as $key => $value) {
//        if (!$_POST["pass1"] && !$_POST["pass2"]) {
//            sanitizeInput($_POST["$key"]);
//        }
//    }

    $hashedPassword = password_hash($_POST["pass1"], PASSWORD_ARGON2I);
    $avatarPath = $_POST["gender"] == "w" ? "./img/woman-avatar.jpg" : "./img/man-avatar.jpg";

    // zabezpieczenie przed sql injection
    $stmt = $conn->prepare("INSERT INTO users (email, additional_email, city_id, firstName, lastName, birthday, gender, avatar, password, created_at) VALUES (?, ?, ?, ? ,?, ?, ?, ?, ?, CURRENT_TIMESTAMP());");
    $stmt->bind_param("ssissssss", $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatarPath, $hashedPassword);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $_SESSION["success"] = "Zarejestrowano użytkownika";
        header("location: ../pages");
        exit();
    } else {
        $errors[] = "Nie udało się zarejestrować użytkownika!";
    }
}

header("location: ../pages/register.php");