<?php
$kassid = simplexml_load_file("kassid.xml");

$sorted_kassid = array();

foreach ($kassid as $kass) {
    array_push($sorted_kassid, $kass);
}
$kassid = $sorted_kassid;

function comparator($kass1, $kass2)
{
    return strcmp($kass1->synniaeg, $kass2->synniaeg);
}

usort($sorted_kassid, 'comparator');

function filter_condition($kass)
{
    return $kass->synniaeg == 2010;
}

$kakstuhat_kassid = array_filter($kassid, 'filter_condition');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kassid XML tabelist</title>
</head>
<body>
<h1>XML PHP Arvestus</h1>
<table>
    <th>Nimi</th>
    <th>Sünniaeg</th>
    <?php
    foreach ($kassid as $kass) {
        echo "<tr>";
        echo "<td>$kass->nimi</td>";
        echo "<td>Sünniaasta: $kass->synniaeg</td>";
        echo "</tr>";
    }
    ?>
</table>
<hr>
<table>
    <th>Kassid kes on sündinud 2010 aastas</th>
    <?php
    foreach ($kakstuhat_kassid as $kass) {
        echo "<tr>";
        echo "<td>$kass->nimi</td>";
        echo "<td>Sünniaasta: $kass->synniaeg</td>";
        echo "</tr>";
    }
    ?>
</table>
<table>
    <h4>Kassid kes nimi algab A tähtega</h4>
    <?php
    foreach ($kassid as $kass) {
        if (substr(strtolower($kass->nimi), 0, 1) == "a") {
            echo "<li>" . ($kass->nimi) ."</li>";
        }
    }

    ?>
</table>
<a href="https://github.com/Roasteg/XML-TTHK">Github</a>
</body>
</html>