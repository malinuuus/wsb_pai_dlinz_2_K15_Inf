<?php
    $firstName = "Janusz";
    $lastName = "Nowak";

    echo "Imię i nazwisko: $firstName $lastName<br>";
    echo 'Imię i nazwisko: $firstName $lastName<br>';

    // heredoc
    // DATA - etykieta
    // W starszych wersjach php nie można dać spacji za etykietą heredoca.
    echo <<< DATA
        <hr>
        Imię: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;

    // nodedoc - do wielokrotnego użytku
    $data = <<< DATA
        <hr>
        Imię: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;

    echo $data;

    // etykieta w '' nie rozpoznaje zmiennych
    $data1 = <<< 'DATA'
        <hr>
        Imię: $firstName<br>
        Nazwisko: $lastName
        <br>
    DATA;

    echo $data1;

    // system binarny
    $bin = 0b1010;
    echo $bin; // automatycznie wyświetla w systemie dziesiętnym

    // system oktalny
    $oct = 0101;
    echo $oct;

    // system szesnastkowy
    $hex = 0x1A;
    echo $hex;

    echo PHP_VERSION; // 7.4.2

    $x = 1;
    $y = 1.0;

    echo gettype($x); // integer
    echo gettype($y); // double

    if ($x == $y) { // true | wartość
        echo "Równe";
    }
    else {
        echo "Różne";
    }

    if ($x === $y) { // false | wartość i typ
        echo "Identyczne";
    }
    else {
        echo "Nieidentyczne";
    }
?>