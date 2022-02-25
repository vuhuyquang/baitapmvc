<?php

class UserController extends BaseController
{
    private $UserModel;

    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->UserModel = new UserModel;
    }

    public function index()
    {
        echo $this->UserModel->getAll();

        $hello = 'Hello, World!';
        $this->view('users.index', ['hello' => $hello]);
    }

    public function create()
    {
        echo __METHOD__;
    }

    public function store()
    {
        echo __METHOD__;
    }

    public function show()
    {
        echo __METHOD__;
    }

    public function edit()
    {
        echo __METHOD__;
    }

    public function update()
    {
        echo __METHOD__;
    }

    public function destroy()
    {
        echo __METHOD__;
    }

}




?>