<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
echo "<h1>Übung mit Zeichenketten</h1>";

echo "<h2>str_replace</h2>";
$text = "Ich mag Datenbanken.";
$neu = str_replace("Datenbanken", "Bananen", $text);
echo "Original: $text<br>";
echo "Ersetzt: $neu<br>";


echo "<h2>str_repeat</h2>";
$zeichen = "<3";
$linie = str_repeat($zeichen, 10);
echo "10 Herzchen von Lara: $linie<br>";


echo "<h2>substr</h2>";
$string = "Hallo Welt!";
$teil = substr($string, 6, 4); // Start bei Index 6, Länge 4
echo "Original: $string<br>";
echo "Ausschnitt: $teil<br>";


echo "<h2>trim / ltrim / rtrim</h2>";
$roh = "   Hallo Welt!   ";
echo "Original mit Leerzeichen: '$roh'<br>";
echo "trim(): '" . trim($roh) . "'<br>";
echo "ltrim(): '" . ltrim($roh) . "'<br>";
echo "rtrim(): '" . rtrim($roh) . "'<br>";


echo "<h2>String-Konkatenation</h2>";
$vorname = "Lennox";
$nachname = "Bäcker";
$vollerName = $vorname . " " . $nachname;
echo "Vorname: $vorname<br>";
echo "Nachname: $nachname<br>";
echo "Voller Name: $vollerName<br>";

