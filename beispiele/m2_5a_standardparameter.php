<!--
 - Praktikum DBWT. Autoren:
 - Lara, Devos, 3649406
 - Kyra, Becker, 3594605
 -->
<?php
function addieren($a, $b = 0)
{
    return $a + $b;
}

$beispiel1 = addieren(7, 2); // beispiele
$beispiel2 = addieren(15);

// Ergebnisse ausgeben
echo "Ergebnis 1: " . $beispiel1 . "<br>";
echo "Ergebnis 2: " . $beispiel2 . "<br>";


