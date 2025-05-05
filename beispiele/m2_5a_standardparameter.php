<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
function addieren($a, $b = 0)
{
    return $a + $b;
}

$beispiel1 = addieren(7, 2); // beispiele
$beispiel2 = addieren(15);

// Ergebnisse ausgeben
echo "Ergebnis 1: " . $beispiel1 . "<br>";
echo "Ergebnis 2: " . $beispiel2 . "<br>";


