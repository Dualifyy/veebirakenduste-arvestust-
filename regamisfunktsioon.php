<?php
require('conf.php');

function kuvaAndmed()
{
    global $yhendus;

    $paring = $yhendus->prepare(
        "SELECT id, eesnimi, perekonnanimi, epost FROM andmed"
    );

    $paring->bind_result($id, $eesnimi, $perekonnanimi, $epost
    );

    $paring->execute();

    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($eesnimi) . "</td>";
        echo "<td>" . htmlspecialchars($perekonnanimi) . "</td>";
        echo "<td>" . htmlspecialchars($epost) . "</td>";
        echo "<td><a href='?kustuta=$id'>Eemalda</a></td>";
        echo "</tr>";
    }
}

function lisaAndmed($eesnimi, $perekonnanimi, $epost){
    global $yhendus;
    $paring = $yhendus->prepare(
        "INSERT INTO andmed (eesnimi, perekonnanimi, epost)
         VALUES (?, ?, ?)"
    );
    $paring->bind_param(
        'sss', $eesnimi, $perekonnanimi, $epost
    );
    $paring->execute();

}
function kustutaVigane($id){
    global $yhendus;
    $paring = $yhendus->prepare(
        "delete from andmed where id = ?"
    );
    $paring->bind_param('i', $id);
    $paring->execute();
}


