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
        $sql = "SELECT U.firstName, U.lastName, U.birthday, C.city, S.state
                FROM users U
                INNER JOIN cities C ON c.id = u.city_id
                INNER JOIN states S on S.id = C.state_id;";
        $result = $conn->query($sql);

        echo <<< USERSTABLE
            <table>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Data urodzenia</th>
                    <th>Miasto</th>
                    <th>Województwo</th>
                </tr>
        USERSTABLE;

        while($user = $result->fetch_assoc()) {
            echo <<< USERS
                <tr>
                    <td>$user[firstName]</td>
                    <td>$user[lastName]</td>
                    <td>$user[birthday]</td>
                    <td>$user[city]</td>
                    <td>$user[state]</td>
                </tr>
            USERS;
        }

        echo "</table>";
    ?>
</body>
</html>