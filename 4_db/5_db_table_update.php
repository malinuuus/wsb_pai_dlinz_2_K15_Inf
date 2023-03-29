<?php
// dane w sesji istnieją, dopóki nie zostaną usunięte pliki cookies
// dobrą praktyką jest rozpoczynanie sesji na początku pliku
session_start();
?>
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
    <?php
        // echo $_SESSION["error"]; - błędnie
        if (isset($_SESSION["error"])) {
            echo $_SESSION["error"];
            unset($_SESSION["error"]); // usunięcie zmiennej sesyjnej
        }

        require_once "../scripts/connect.php";
        if (isset($_GET["table"]) && $_GET["table"] == "cities") {
            echo "<h4>Miasta</h4>";

            // tabela z miastami
            $sql = "SELECT c.id, s.state, c.city
                    FROM cities c
                    INNER JOIN states s on c.state_id = s.id";

            $result = $conn->query($sql);

            echo <<< USERSTABLE
                <table>
                    <tr>
                        <th>Id miasta</th>
                        <th>Województwo</th>
                        <th>Miasto</th>
                    </tr>
            USERSTABLE;

            if ($result->num_rows > 0) {
                while($city = $result->fetch_assoc()) {
                    echo <<< USERS
                        <tr>
                            <td>$city[id]</td>
                            <td>$city[state]</td>
                            <td>$city[city]</td>
                            <td><a href="../scripts/delete_city.php?deleteCityId=$city[id]">usuń</a></td>
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
            echo "<a href='../scripts/switch_table.php?table=users'>przełącz tabelę</a>";
        } else {
            echo "<h4>Użytkownicy</h4>";

            // tabela z użytkownikami
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
                            <td><a href="./5_db_table_update.php?updateUserId=$user[id]">edytuj</a></td>
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
            echo "<a href='../scripts/switch_table.php?table=cities'>przełącz tabelę</a>";
        }

        function showMessage(string $urlParam, string $whatDeleted) {
            if (isset($_GET[$urlParam])) {
                echo "<hr>";
                if ($_GET[$urlParam] != 0) {
                    echo "$whatDeleted o id = $_GET[$urlParam] został usunięty";
                } else {
                    echo "$whatDeleted nie został usunięty";
                }
            }
        }

        showMessage("deleteUser", "użytkownik");
        showMessage("deleteCity", "miasto");

        // formularz dla dodawania i edycji
        if (isset($_GET['addUserForm']) || isset($_GET['updateUserId'])) {
            if (isset($_GET['updateUserId'])) {
                $sql = "SELECT * FROM users WHERE id = $_GET[updateUserId]";
                // pobranie danych do edycji
                $user = $conn->query($sql)->fetch_assoc();
                $firstName = $user['firstName'];
                $lastName = $user['lastName'];
                $city_id = $user['city_id'];
                $birthday = $user['birthday'];
                $actionPath = "../scripts/update_user.php?updateUserId=$_GET[updateUserId]";
                $submitName = "Zaktualizuj użytkownika";

                echo "<hr><h4>Aktualizacja użytkownika</h4>";
            } else {
                $actionPath = "../scripts/add_user.php";
                $submitName = "Dodaj użytkownika";
                echo "<hr><h4>Dodawanie użytkownika</h4>";
            }

            echo <<< ADDUSERFORM
                <form action="$actionPath" method="post">
                    <!-- autofocus - automatyczny focus na to pole -->
                    <input type="text" name="firstName" value="$firstName" placeholder="Podaj imię" autofocus><br><br>
                    <input type="text" name="lastName" value="$lastName" placeholder="Podaj nazwisko"><br><br>
                    <select name="city_id">
            ADDUSERFORM;

            $sql = "SELECT id, city FROM cities";
            $result = $conn->query($sql);

            while ($city = $result->fetch_assoc()) {
                if (isset($_GET['updateUserId']) && $city_id == $city['id']) {
                    // zaznaczona opcja w przypadku edycji
                    echo "<option selected value='$city[id]'>$city[city]</option>";
                } else {
                    echo "<option value='$city[id]'>$city[city]</option>";
                }
            }

            echo <<< ADDUSERFORM
                    </select><br><br>
                    <!-- value - wartość inputa -->
                    <!-- <input type="text" name="city_id" placeholder="Podaj miasto" value="1"><br><br> -->
                    <input type="date" name="birthday" value="$birthday">Data urodzenia<br><br>
                    <input type="submit" value="$submitName">
                </form>
            ADDUSERFORM;
        } else {
            echo '<hr><a href="./4_db_table_add.php?addUserForm=1">Dodaj użytkownika</a>';
        }
    ?>
</body>
</html>