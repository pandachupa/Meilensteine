<?php

if (!is_dir('beispiele')) {
    mkdir('beispiele');
}


$logFile = 'beispiele/accesslog.txt';


$dateTime = date('Y-m-d H:i:s');
$ipAddress = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];


$logEntry = "$dateTime - IP: $ipAddress - Browser: $userAgent\n";

// Log-Eintrag zur Datei hinzufügen
file_put_contents($logFile, $logEntry, FILE_APPEND);

echo "Eintrag wurde ins Access-Log geschrieben.";

