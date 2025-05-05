<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Famous Meals</title>
    <style>
        body {
            font-family: Helvetica, sans-serif;
        }
        ol {
            padding-left: 20px;
        }
        li {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<?php
/**
 * Praktikum DBWT. Autoren:
 * Lara, Devos, 3649406
 * Lennox, Bäcker, 3727405
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes', 'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis', 'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese', 'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes', 'winner' => 2019]
];

echo "<ol>";
foreach ($famousMeals as $meal) {
    echo "<li>";
    echo $meal['name'] . ": ";
    if (is_array($meal['winner'])) {
        sort($meal['winner']);
        echo implode(", ", $meal['winner']);
    } else {
        echo $meal['winner'];
    }
    echo "</li>";
}
echo "</ol>";

//gewinner berechnen
function jahreOhneGewinner($meals, $startYear, $endYear) {
    $allYears = range($startYear, $endYear);
    $winnerYears = [];
    foreach ($meals as $meal) {
        if (is_array($meal['winner'])) {
            $winnerYears = array_merge($winnerYears, $meal['winner']);
        } else {
            $winnerYears[] = $meal['winner'];
        }
    }
    $winnerYears = array_unique($winnerYears);
    $yearsWithoutWinners = array_diff($allYears, $winnerYears);
    return $yearsWithoutWinners;
}

// jahre ohne gewinner
$yearsWithoutWinners = jahreOhneGewinner($famousMeals, 2000, date("Y"));
echo "<p>Jahre ohne Gewinner: " . implode(", ", $yearsWithoutWinners) . "</p>";
?>
</body>
</html>
