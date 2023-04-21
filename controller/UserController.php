<?php

namespace controller;

use dao\UserDaoImpl;

class UserController
{
    private $userDao;

    /**
     * @param $userDao
     */
    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index() {
        $signInPressed = filter_input(INPUT_POST, 'btnSignIn');
        if ($signInPressed) {
            $username = filter_input(INPUT_POST, 'txtUsername');
            $password = filter_input(INPUT_POST, 'txtPassword');
            $md5Password = md5($password);
            $user = new \entity\User();
            $user->setUsername($username);
            $user->setPassword($md5Password);
            $result = $this->userDao->login($user);
            if ($result != null && $user->getUsername() == $username) {
                $_SESSION['my_session'] = true;
                $_SESSION['session_user'] = $user->getName();
                header('location:index.php');
            } else {
                echo '<div class="bg-error"> Invalid Username and password </div>';
                echo $username;
                echo '</br>';
                echo $md5Password;
            }
        }
        include_once 'pages/login_page.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("location:index.php");
    }
}
