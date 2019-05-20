<?php
require_once ('scripts/database.php');

if(isset($_GET['idsong'])) {
    //ophalen waarde idsong
    $id = $_GET['idsong'];
    
    //voorbereiden query
    $sql = "INSERT INTO savedsongs(songid) VALUES (?)";

    $stmt = $mysqli->prepare($sql);
    
    //parameter koppelen
    $stmt->bind_param("i", $id);

    //query uitvoeren
    $stmt->execute();
}

header("location:song.php");

?>