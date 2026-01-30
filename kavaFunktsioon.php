<?php
require ('2conf.php');
function kuvaSyndmuseid(){
    global $yhendus;
    $paring = $yhendus->prepare(
        "SELECT id, syndmus, kellaaeg FROM peokava
            ORDER BY id DESC"
    );

    $paring->bind_result($id, $syndmus, $kellaaeg);

    $paring->execute();
    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($syndmus) . "</td>";
        echo "<td>" . htmlspecialchars($kellaaeg) . "</td>";
        echo "<td><a href='?kustuta=$id'>Eemalda</a></td>";
        echo "</tr>";
    }
}

function lisaSyndmus($syndmus, $kellaaeg){
    global $yhendus;
    $paring = $yhendus->prepare(
        "INSERT INTO peokava (syndmus, kellaaeg)
         VALUES (?, ?)"
    );
    $paring->bind_param(
        'ss', $syndmus, $kellaaeg
    );
    $paring->execute();

}

function kustutaSyndmus($id){
    global $yhendus;
    $paring = $yhendus->prepare(
        "delete from peokava where id = ?"
    );
    $paring->bind_param('i', $id);
    $paring->execute();
}