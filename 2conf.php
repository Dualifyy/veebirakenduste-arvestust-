<?php
$serverinimi='localhost';
$kasutajanimi='enrique';
$parool='12345';
$andmebaasinimi1='syndmused';
$yhendus=new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi1);
$yhendus->set_charset("utf8");