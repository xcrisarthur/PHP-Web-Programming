<div class="container">
    <form class="row g-3" action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="bookIsbn" class="form-label">isbn</label>
            <input type="text" class="form-control" id="bookIsbn" name="bookIsbn">
        </div>
        <div class="col-md-6">
            <label for="bookTitle" class="form-label">title</label>
            <input type="text" class="form-control" id="bookTitle" name="bookTitle">
        </div>
        <div class="col-md-6">
            <label for="bookAuthor" class="form-label">author</label>
            <input type="text" class="form-control" id="bookAuthor" name="bookAuthor">
        </div>
        <div class="col-md-6">
            <label for="bookPublisher" class="form-label">publisher</label>
            <input type="text" class="form-control" id="bookPublisher" name="bookPublisher">
        </div>
        <div class="col-md-6">
            <label for="bookPublish_year" class="form-label">publish_year</label>
            <input type="text" class="form-control" id="bookPublish_year" name="bookPublish_year">
        </div>
        <div class="col-md-6">
            <label for="bookDescription" class="form-label">description</label>
            <input type="text" class="form-control" id="bookDescription" name="bookDescription">
        </div>
        <div class="col-md-6">
            <label for="bookCover" class="form-label">cover</label>
            <input type="file" class="form-control" id="bookCover" name="bookCover" accept="image/png, image/jpg, image/jepg">
        </div>
        <div class="col-md-6">
            <label for="bookGenre_id" class="form-label">genre</label>

            <select class="form-select" aria-label="Default select example" id="bookGenre_id" name="bookGenre_id">
                <option>Choose Genre</option>
                <?php

                /* @var $genre \entity\Genre */
                foreach ($genres as $genre) {
                    echo '<option value=' . $genre->getId() . '>' . $genre->getName() . '</option>';
                }
                $link = null;

                ?>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
        </div>
    </form>
</div>

<div class="container mt-5 mb-5">
    <table class="display" id="myTable">
        <thead>
        <tr>
            <th>isbn</th>
            <th>title</th>
            <th>author</th>
            <th>publisher</th>
            <th>publish_year</th>
            <th>description</th>
            <th>cover</th>
            <th>genre id</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        /* @var $book \entity\Book */
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td>' . $book->getIsbn() . '</td>';
            echo '<td>' . $book->getTitle() . '</td>';
            echo '<td>' . $book->getAuthor() . '</td>';
            echo '<td>' . $book->getPublisher() . '</td>';
            echo '<td>' . $book->getPublishYear() . '</td>';
            echo '<td>' . $book->getDescription() . '</td>';
            echo '<td>';
                if ($book->getCover() !== null) {
                    echo '<img class="w-100" src="uploads/' . $book->getCover() .'">';
                }
            echo '</td>';
            echo '<td>' . $book->getGenreId() . '</td>';
            echo '<td><button onclick="updateBookValue(\''. $book->getIsbn() . '\')">Update</button> <button onclick="deleteBookValue(\''. $book->getIsbn() . '\')">Delete</button> </td>';
            echo '</tr>';
        }
        $link = null;

        ?>
        </tbody>
    </table>
</div>
