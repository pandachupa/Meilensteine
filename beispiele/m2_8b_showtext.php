<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Unser Übersetzer</title>
</head>
<body>
<h1>Deutsch-Englisch Übersetzung</h1>

<form method="get">
    <label for="suche">Suchwort (Englisch):</label>
    <input type="text" name="suche" id="suche" required>
    <input type="submit" value="Übersetzung suchen">
</form>

<hr>

<?php
// Funktion zur Suche nach dem Suchwort in der Datei
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
function findeUebersetzung($suchwort, $dateipfad) {
    // gibt es die Datei?
    if (!file_exists($dateipfad)) {
        return "Die Datei '$dateipfad' existiert nicht.";
    }

    // Datei öffnen
    $datei = fopen($dateipfad, "r"); // Pfad zur en.txt
    if (!$datei) {
        return "Fehler beim Öffnen der Datei.";
    }

    // Suchwort suchen
    while (($zeile = fgets($datei)) !== false) {
        $teile = explode(";", $zeile); //prüft, ob die Zeile korrekt formatiert ist (mindestens 2 Teile).
        if (count($teile) >= 2 && trim($teile[0]) === $suchwort) { // teil 0 englisch teil 1 deutsch
            fclose($datei);
            return "Die Übersetzung von '$suchwort' lautet: " . trim($teile[1]);
        }
    }

    fclose($datei);
    return "Das gesuchte Wort '$suchwort' ist nicht enthalten.";
}

if (isset($_GET['suche'])) {
    $suchwort = trim($_GET['suche']);

    // Pfad zur Datei
    $datei = "en.txt";

    // Funktion aufrufen und Ergebnis ausgeben
    $ergebnis = findeUebersetzung($suchwort, $datei);
    echo $ergebnis;
}
