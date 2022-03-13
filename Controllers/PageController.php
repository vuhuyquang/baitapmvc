<?php

class PageController extends BaseController
{
    private $UserController;

    public function getlogin()
    {
        session_start();
        if (isset($_SESSION)) {
            session_destroy(); 
        }   
        $this->view('home');
    }

    public function login()
    {
        $employeecode = $_POST['employeecode'];
        $password = md5($_POST['password']);
        $this->loadModel('UserModel');
        $this->UserModel = new UserModel;
        $account = $this->UserModel->findWhere('employeecode', $employeecode);
        if ($account != null && $account['password'] == $password && $account['role'] == '1') {
            session_start();
            $_SESSION['roleName'] = $employeecode;
            $_SESSION['role'] = $account['role'];
            header('Location: http://localhost/baitapmvc/index.php?controller=user');
        } elseif ($account != null && $account['password'] == $password && $account['role'] == '2') {
            session_start();
            $_SESSION['roleName'] = $employeecode;
            $_SESSION['role'] = $account['role'];
            header('Location: http://localhost/baitapmvc/index.php?controller=user');
        } else {
            $this->getlogin();
        }
    }

}




?>