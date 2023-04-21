<?php
session_start();

include_once 'entity/Book.php';
include_once 'entity/Genre.php';
include_once 'entity/User.php';
include_once 'controller/GenreUpdateController.php';
include_once 'controller/BookController.php';
include_once 'controller/GenreController.php';
include_once 'controller/UserController.php';
include_once 'dao/BookDaoImpl.php';
include_once 'dao/GenreDaoImpl.php';
include_once 'dao/UserDaoImpl.php';
include_once 'util/PDOUtil.php';

include_once 'util/db_util.php';
//include_once 'db_function/genre_function.php';
//include_once 'db_function/user_function.php';
//include_once 'db_function/book_function.php';

if (!isset($_SESSION['my_session'])) {
    $_SESSION['my_session'] = false;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="scripts/command_script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="page">
    <?php
    if ($_SESSION['my_session']) {

    ?>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">PHP Proggraming</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=genre">Genre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=book">Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <div>
        <?php
        $menu = filter_input(INPUT_GET, "menu");
        switch ($menu){
            case 'genre';
                $genreController = new \controller\GenreController();
                $genreController->index();
                break;
            case 'book';
                $bookController = new \controller\BookController();
                $bookController->index();
                break;
            case 'genu';
                $genreUpdateController = new \controller\GenreUpdateController();
                $genreUpdateController->index();
                break;
            case 'booku';
                include_once 'pages/book_update_page.php';
                break;
            case 'logout';
                $userController = new \controller\UserController();
                $userController->logout();
                break;
            default;
                include_once 'pages/home.php';
        }
        ?>
    </div>
    <?php
    } else {
        $userController = new \controller\UserController();
        $userController->index();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>