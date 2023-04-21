<?php

namespace controller;

use dao\BookDaoImpl;
use dao\GenreDaoImpl;

class BookController
{
    private BookDaoImpl $bookDao;
    private GenreDaoImpl $genreDao;

    public function __construct()
    {
        $this->bookDao = new BookDaoImpl();
        $this->genreDao = new GenreDaoImpl();
    }

    public function index(){
        $command = filter_input(INPUT_GET, 'cmd');
        if (isset($command) && $command == 'del') {
            $bookId = filter_input(INPUT_GET,'bid');
            $result = $this->bookDao->deleteBook($bookId);
            $book = fetchOneBookData($bookId);
            if (isset($book['cover'])) {
                unlink('uploads/' . $book['cover']);
            }
            if ($result){
                echo '<div>Data successfully removed</div>';

            } else {
                echo '<div>Failed to remove data</div>';
            }
        }

        $submitPressed = filter_input(INPUT_POST, 'btnSubmit');
        if (isset($submitPressed)) {
            $isbn = filter_input(INPUT_POST, 'bookIsbn');
            $title = filter_input(INPUT_POST, 'bookTitle');
            $author = filter_input(INPUT_POST, 'bookAuthor');
            $publisher = filter_input(INPUT_POST, 'bookPublisher');
            $publish_year = filter_input(INPUT_POST, 'bookPublish_year');
            $description = filter_input(INPUT_POST, 'bookDescription');
            $genre_id = filter_input(INPUT_POST, 'bookGenre_id');
            if (isset($_FILES['bookCover']['name'])) {
                $targetDir = 'uploads/';
                $fileExt = pathinfo($_FILES['bookCover']['name'],PATHINFO_EXTENSION);
                $newFileName = $isbn . '.' . $fileExt;
                $targetFile = $targetDir . $newFileName;
                if ($_FILES['bookCover']['size'] > 1024 * 2048) {
                    echo '<div> Upload Error. File Size Exceed 2 MB </div>';
                } else {
                    move_uploaded_file($_FILES['bookCover']['tmp_name'], $targetFile);
                }
            }
            $book = new \entity\Book();
            $book->setIsbn($isbn);
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setPublisher($publisher);
            $book->setPublishYear($publish_year);
            $book->setDescription($description);
            $book->setCover($newFileName);
            $book->setGenreId($genre_id);
            $result = $this->bookDao->addBook($book);
            if ($result) {
                echo '<div class="bg-success">Data Successfully Added (ISBN: ' . $isbn . ') </div>';
            } else {
                echo '<div class="bg-error">Error Adding Data </div>';
            }
        }
        $genres = $this->genreDao->fetchGenreData();
        $books = $this->bookDao->fetchBookData();

        include_once 'pages/book_page.php';
    }
}