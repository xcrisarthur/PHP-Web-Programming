<?php

namespace dao;

use entity\Genre;
use PDO;
use PDOUtil;

class GenreDaoImpl
{
    public function fetchGenreData() {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM genre";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Genre::class);
        closeConnection($link);
        return $result;
    }

    public function addGenre(Genre $genre) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "INSERT INTO genre(name) VALUES (?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $genre->getName());
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
     * @return Genre|false|object|\stdClass|null
     */
    public function fetchOneGenre($id) {
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM genre WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject(Genre::class);
    }

    public function updateGenre(Genre $genre) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "UPDATE genre SET name = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $genre->getName());
        $stmt->bindValue(2, $genre->getId());
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

    public function deleteGenre($id) {
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'DELETE FROM genre WHERE id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
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
}