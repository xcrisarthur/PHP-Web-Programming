<div class="container">
<form action="" method="post">
    <div class="mb-3">
        <label for="genId" class="form-label">Name</label>
        <input type="text" class="form-control" id="genId" name="txtName">
    </div>
    <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
</form>
</div>

<div class="container mt-5">
    <table class="display" id="myTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        /* @var $genre \entity\Genre */
        foreach ($genres as $genre) {
            echo '<tr>';
            echo '<td>' . $genre->getId() . '</td>';
            echo '<td>' . $genre->getName() . '</td>';
            echo '<td>
<button onclick="updateGenreValue(\''. $genre->getId() . '\')">Update</button> 
<button onclick="deleteGenreValue(\''. $genre->getId() . '\')">Delete</button> </td>';
            echo '</tr>';
        }
        $link = null;

        ?>
        </tbody>
    </table>
</div>
