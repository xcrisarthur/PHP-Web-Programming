<?php

use dao\BookDaoImpl;

$bookDao = new BookDaoImpl();

$bid = filter_input(INPUT_GET, 'bid');
if (isset($bid)) {
    $link = new PDO('mysql:host=localhost; dbname=pwl20222', 'root', '');
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM book WHERE isbn = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $bid);
    $stmt->execute();
    $result = $stmt->fetch();
    $link = null;
}

$submitPressed = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitPressed)) {
    $isbn = filter_input(INPUT_POST, 'bookIsbn');
    $title = filter_input(INPUT_POST, 'bookTitle');
    $author = filter_input(INPUT_POST, 'bookAuthor');
    $publisher = filter_input(INPUT_POST, 'bookPublisher');
    $publish_year = filter_input(INPUT_POST, 'bookPublish_year');
    $description = filter_input(INPUT_POST, 'bookDescription');
//    $cover = filter_input(INPUT_POST, 'bookCover');
    $genre_id = filter_input(INPUT_POST, 'bookGenre_id');

//    if (isset($_FILES['bookCover']['name'])) {
//        $targetDir = 'uploads/';
//        $fileExt = pathinfo($_FILES['bookCover']['name'],PATHINFO_EXTENSION);
//        $newFileName = $isbn . '.' . $fileExt;
//        $targetFile = $targetDir . $newFileName;
//        if ($_FILES['bookCover']['size'] > 1024 * 2048) {
//            echo '<div> Upload Error. File Size Exceed 2 MB </div>';
//        } else {
//            move_uploaded_file($_FILES['bookCover']['tmp_name'], $targetFile);
//        }
//    }

    $book = new \entity\Book();
    $book->setIsbn($isbn);
    $book->setTitle($title);
    $book->setAuthor($author);
    $book->setPublisher($publisher);
    $book->setPublishYear($publish_year);
    $book->setDescription($description);
//    $book->setCover($newFileName);
    $book->setGenreId($genre_id);

    $result = $bookDao->updateBook($book);
    if ($result) {
        echo '<div class="bg-success">Data Successfully Updated (ISBN: ' . $isbn . ') </div>';
    } else {
        echo '<div class="bg-error">Error Adding Data </div>';
    }
    header("location:index.php?menu=book");
}
?>

<div class="container">
    <form class="row g-3" action="" method="post">
        <div class="col-md-6">
            <label for="bookIsbn" class="form-label">isbn</label>
            <input type="text" class="form-control" id="bookIsbn" name="bookIsbn" value="<?php echo $result['isbn']; ?>">
        </div>
        <div class="col-md-6">
            <label for="bookTitle" class="form-label">title</label>
            <input type="text" class="form-control" id="bookTitle" name="bookTitle" value="<?php echo $result['title']; ?>">
        </div>
        <div class="col-md-6">
            <label for="bookAuthor" class="form-label">author</label>
            <input type="text" class="form-control" id="bookAuthor" name="bookAuthor" value="<?php echo $result['author']; ?>">
        </div>
        <div class="col-md-6">
            <label for="bookPublisher" class="form-label">publisher</label>
            <input type="text" class="form-control" id="bookPublisher" name="bookPublisher" value="<?php echo $result['publisher']; ?>">
        </div>
        <div class="col-md-6">
            <label for="bookPublish_year" class="form-label">publish_year</label>
            <input type="text" class="form-control" id="bookPublish_year" name="bookPublish_year" value="<?php echo $result['publish_year']; ?>">
        </div>
        <div class="col-md-6">
            <label for="bookDescription" class="form-label">description</label>
            <input type="text" class="form-control" id="bookDescription" name="bookDescription" value="<?php echo $result['description']; ?>">
        </div>

<!--        <div class="col-md-6">-->
<!--            <label for="bookCover" class="form-label">change cover</label>-->
<!--            <input type="file" class="form-control" id="bookCover" name="bookCover" accept="image/png, image/jpg, image/jepg">-->
<!--        </div>-->
        <div class="col-md-6">
            <label for="bookGenre_id" class="form-label">genre</label>

            <select class="form-select" aria-label="Default select example" id="bookGenre_id" name="bookGenre_id">
                <option selected><?php echo $result['genre_id']; ?></option>
                <?php
                $result = fetchGenreData();
                foreach ($result as $row) {
                    echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
                }
                $link = null;
                ?>
            </select>
        </div>
<!--        <div class="col-md-6">-->
<!--            <label for="bookCover" class="form-label">preview of the previous cover</label>-->
<!--            --><?php
//            $books = $bookDao->fetchOneBookData($bid);
//            echo '<img class="w-100" src="uploads/' . $books->getCover() .'">';
//            ?>
<!--        </div>-->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
        </div>
    </form>
</div>