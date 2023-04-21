<?php

namespace dao;

use entity\Book;
use PDO;
use PDOUtil;

class BookDaoImpl
{
    public function fetchBookData() {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM book";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Book::class);
        closeConnection($link);
        return $result;
    }

    public function addBook(Book $book) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "INSERT INTO book(isbn, title, author, publisher, publish_year, description, cover, genre_id) values(?,?,?,?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $book->getIsbn());
        $stmt->bindValue(2, $book->getTitle());
        $stmt->bindValue(3, $book->getAuthor());
        $stmt->bindValue(4, $book->getPublisher());
        $stmt->bindValue(5, $book->getPublishYear());
        $stmt->bindValue(6, $book->getDescription());
        $stmt->bindValue(7, $book->getCover());
        $stmt->bindValue(8, $book->getGenreId());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result=1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }


    /**
     * @param $id
     * @return Book|false|object|\stdClass|null
     */
    public function fetchOneBookData($id) {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM book WHERE isbn = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject(Book::class);
    }

    public function updateBook(Book $book) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "UPDATE book SET isbn = ?, title = ?, author = ?, publisher = ?, publish_year = ?, description = ?, cover = ?, genre_id = ? WHERE isbn = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $book->getIsbn());
        $stmt->bindValue(2, $book->getTitle());
        $stmt->bindValue(3, $book->getAuthor());
        $stmt->bindValue(4, $book->getPublisher());
        $stmt->bindValue(5, $book->getPublishYear());
        $stmt->bindValue(6, $book->getDescription());
        $stmt->bindValue(7, $book->getCover());
        $stmt->bindValue(8, $book->getGenreId());
        $stmt->bindValue(9, $book->getIsbn());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }

    public function deleteBook($id) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'DELETE FROM book WHERE isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }

//$link = null;
//echo '<div class="bg-success">Data Successfully Deleted</div>';
}