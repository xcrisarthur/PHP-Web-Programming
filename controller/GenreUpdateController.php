<?php

namespace controller;

use dao\GenreDaoImpl;

class GenreUpdateController
{
    private $genreDao;

    public function __construct()
    {
        $this->genreDao = new GenreDaoImpl();
    }

    public function index() {
        $gid = filter_input(INPUT_GET, 'gid');
        if (isset($gid)) {
            $genre = $this->genreDao->fetchOneGenre($gid);

        }

        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitPressed)) {
            $name = filter_input(INPUT_POST, 'txtName');
            $updatedGenre = new \entity\Genre();
            $updatedGenre->setId($genre->getId());
            $updatedGenre->setName($name);
            $result = $this->genreDao->updateGenre($updatedGenre);
            if ($result){
                header("location:index.php?menu=genre");
            } else {
                echo 'Error update genre data';
            }
        }
        include_once 'pages/genre_update_page.php';
    }
}