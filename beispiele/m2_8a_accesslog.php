<?php //Jedes mal wenn die Seite im Browser aufgerufen wird kommt ein neuer Eintrag
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
date_default_timezone_set('Europe/Berlin');

function aktuellesDatum() {
    return date('Y-m-d H:i:s');
}

function ClientInformationen() {
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    return "Browser: $browser - IP: $ip";
}


$logFile = 'accesslog.txt'; // Datei wo reingeschrieben wird
$logEntry = aktuellesDatum() . " - " . ClientInformationen() . "\n";

// hängt Inhalt in die datei an
file_put_contents($logFile, $logEntry, FILE_APPEND);

$logContent = file_get_contents($logFile); //Liest den gesamten Inhalt der Logdatei

//Bestätigung
echo "Der Logdatei-Eintrag wurde erfolgreich erstellt.<br><pre>$logContent</pre>";
