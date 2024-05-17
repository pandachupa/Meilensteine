<?php
// Pfad zur Datei mit den Besucherzählungen
$visitorCountFilePath = 'besucher_zaehler.txt';

// Pfad zur Datei mit den Gerichtsdaten
$mealDataFilePath = 'meal_data.txt';

// Pfad zur Datei mit den Newsletter-Anmeldungen
$newsletterSubscribersFilePath = 'newsletter_anmeldungen.txt';

// Funktion zur Erhöhung des Besucherzählers
function incrementVisitorCount($filePath) {
    if (file_exists($filePath) && is_writable($filePath)) {
        // Lesen der aktuellen Besucherzahl
        $count = (int)file_get_contents($filePath);
        // Inkrementieren der Besucherzahl um eins
        $count++;
        // Schreiben der neuen Besucherzahl in die Datei
        file_put_contents($filePath, $count);
    }
}

// Funktion zur Anzeige der Besucherzahl
function displayVisitorCount($filePath) {
    if (file_exists($filePath)) {
        // Lesen der aktuellen Besucherzahl
        $count = (int)file_get_contents($filePath);
        // Ausgabe der Besucherzahl
        echo "<p>Anzahl Besucher: $count</p>";
    }
}

// Funktion zur Anzeige der Anzahl der gespeicherten Gerichte
function displayMealCount($filePath) {
    if (file_exists($filePath)) {
        // Lesen der Gerichtsdaten und Zählen der Zeilen
        $count = count(file($filePath, FILE_SKIP_EMPTY_LINES));
        // Ausgabe der Anzahl der Gerichte
        echo "<p>Anzahl Gerichte: $count</p>";
    }
}

// Funktion zur Anzeige der Anzahl der Newsletter-Anmeldungen
function displayNewsletterSubscribersCount($filePath) {
    if (file_exists($filePath)) {
        // Lesen der Anmeldungen zum Newsletter und Zählen der Zeilen
        $count = count(file($filePath, FILE_SKIP_EMPTY_LINES));
        // Ausgabe der Anzahl der Newsletter-Anmeldungen
        echo "<p>Anzahl Newsletter-Anmeldungen: $count</p>";
    }
}

// Inkrementieren des Besucherzählers bei jedem Seitenaufruf
incrementVisitorCount($visitorCountFilePath);
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Werbeseite</title>
    </head>
    <body>
    <h1>Werbeseite</h1>
    <h2>Zahlen</h2>
    <?php
    // Anzeige der Besucherzahl
    displayVisitorCount($visitorCountFilePath);
    // Anzeige der Anzahl der gespeicherten Gerichte
    displayMealCount($mealDataFilePath);
    // Anzeige der Anzahl der Newsletter-Anmeldungen
    displayNewsletterSubscribersCount($newsletterSubscribersFilePath);
    ?>
    </body>
    </html>
<?php
