<?php

?>

<div class="container">
    <form action="" method="post">
        <div class="mb-3">
            <label for="genId" class="form-label">Name</label>
            <input type="text" class="form-control" id="genId" name="txtName" value="<?php echo $genre->getName(); ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
    </form>
</div>