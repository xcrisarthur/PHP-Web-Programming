<?php

function fetchBookData() {
    $link = createConnection();
    $query = "SELECT * FROM book";
    $result = $link->query($query);
    closeConnection($link);
    return $result;
}

function fetchOneBookData($id) {
    $link = createConnection();
    $query = "SELECT * FROM book WHERE isbn = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    closeConnection($link);
    return $stmt->fetch();
}

function addBook($isbn, $title, $author, $publisher, $publish_year, $description, $cover, $genre_id) {
    $result = 0;
    $link = createConnection();
    $query = "INSERT INTO book(isbn, title, author, publisher, publish_year, description, cover, genre_id) values(?,?,?,?,?,?,?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $isbn);
    $stmt->bindParam(2, $title);
    $stmt->bindParam(3, $author);
    $stmt->bindParam(4, $publisher);
    $stmt->bindParam(5, $publish_year);
    $stmt->bindParam(6, $description);
    $stmt->bindParam(7, $cover);
    $stmt->bindParam(8, $genre_id);
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