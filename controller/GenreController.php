<?php

namespace controller;

use dao\GenreDaoImpl;

class GenreController
{
    private GenreDaoImpl $genreDao;

    public function __construct()
    {
        $this->genreDao = new GenreDaoImpl();
    }

    public function index(): void
    {
        $deleteCommand = filter_input(INPUT_GET,'cmd');
        if(isset($deleteCommand) && $deleteCommand = 'del'){
            $genreId = filter_input(INPUT_GET,'gid');
            $results = $this->genreDao->deleteGenre($genreId);
            if ($results) {
                echo '<div>Data successfully removed</div>';
            } else {
                echo '<div>Failed to remove data</div>';
            }
        }

        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitPressed)) {
            $name = filter_input(INPUT_POST, 'txtName');
            $genre = new \entity\Genre();
            $genre->setName($name);
            $result = $this->genreDao->addGenre($genre);
            if ($result) {
                echo '<div class="bg-success">Data Succsessfully added (Genre: ' . $name . ') <div/>';
            } else {
                echo '<div class="bg-error">Error Add Data <div/>';

            }
        }
        $genres = $this->genreDao->fetchGenreData();
        include_once 'pages/genre_page.php';
    }
}