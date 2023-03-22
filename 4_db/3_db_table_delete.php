<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/table.css">
    <title>Użytkownicy</title>
</head>
<body>
    <h4>Użytkownicy</h4>
    <?php
        require_once "../scripts/connect.php";
        $sql = "SELECT u.id, u.firstName, u.lastName, u.birthday, c.city, s.state, co.country
                FROM users u
                INNER JOIN cities c ON c.id = u.city_id
                INNER JOIN states s on s.id = c.state_id
                INNER JOIN countries co on co.id = s.country_id";
        $result = $conn->query($sql);

        echo <<< USERSTABLE
            <table>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Data urodzenia</th>
                    <th>Miasto</th>
                    <th>Województwo</th>
                    <th>Kraj</th>
                </tr>
        USERSTABLE;

        if ($result->num_rows > 0) {
            while($user = $result->fetch_assoc()) {
                echo <<< USERS
                <tr>
                    <td>$user[firstName]</td>
                    <td>$user[lastName]</td>
                    <td>$user[birthday]</td>
                    <td>$user[city]</td>
                    <td>$user[state]</td>
                    <td>$user[country]</td>
                    <td><a href="../scripts/delete_user.php?deleteUserId=$user[id]">usuń</a></td>
                </tr>
            USERS;
            }
        } else {
            echo <<< USERS
                <tr>
                    <td colspan="6">Brak rekordów do wyświetlenia</td>
                </tr>
            USERS;
        }

        echo "</table>";

        // jeśli istnieje zmienna deleteUser
        if (isset($_GET["deleteUser"])) {
            echo "<hr>";
            if ($_GET["deleteUser"] != 0) {
                echo "Usunięto użytkownika o id = $_GET[deleteUser]";
            } else {
                echo "Nie usunięto użytkownika";
            }
        }
    ?>
</body>
</html>