<?php //falsch man musste ein formular machen
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
    $datei = fopen($dateipfad, "r");
    if (!$datei) {
        return "Fehler beim Öffnen der Datei.";
    }

    // Suchwort suchen
    while (($zeile = fgets($datei)) !== false) {
        $teile = explode(";", $zeile);
        if (count($teile) >= 2 && trim($teile[0]) === $suchwort) {
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
} else {
    // wenn nicht gefunden
    echo "Bitte geben Sie ein Suchwort über den GET-Parameter 'suche' an.";
}
