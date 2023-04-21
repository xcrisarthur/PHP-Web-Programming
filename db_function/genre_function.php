<?php

function fetchGenreData() {
    $link = createConnection();
    $query = "SELECT * FROM genre";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function addGenre($name) {
    $result = 0;
    $link = createConnection();
    $query = "INSERT INTO genre(name) values(?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
        $result=1;
    } else {
        $link->rollBack();
    }
    closeConnection($link);
    return $result;
}


?>