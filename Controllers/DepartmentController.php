<?php

class DepartmentController extends BaseController
{
    private $DepartmentModel;

    public function __construct()
    {
        $this->loadModel('DepartmentModel');
        $this->DepartmentModel = new DepartmentModel;
        session_start();
        if (!isset($_SESSION['role']) && !isset($_SESSION['roleName'])) {
            header('Location: http://localhost/baitapmvc/index.php?controller=page&action=getlogin');
        }
    }

    public function index()
    {
        if (isset($_GET['pages'])) {
            $pages = $_GET['pages'];
        } else {
            $pages = 1;
        }
        $countItem = $this->DepartmentModel->count();
        foreach ($countItem as $key => $value) {
            $sumCount = $value['COUNT(id)'];
            $countPages = ceil($sumCount / 10);
        }

        $departments = $this->DepartmentModel->get(['*'], $pages);
        $this->view('departments.index', ['departments' => $departments, 'pages' => $countPages]);
    }

    public function detail()
    {
        $id = $_GET['id'];
        $this->loadModel('UserModel');
        $this->UserModel = new UserModel;
        $users = $this->UserModel->findWhere('departmentid', $id);
        echo "<pre>";
        var_dump($users);
        echo "<pre>";
        $this->view('departments.detail');
    }

    public function create()
    {
        echo __METHOD__;
    }

    public function store()
    {
        $data = [
            'departmentcode' => $_POST['departmentcode'],
            'departmentname' => $_POST['departmentname']
        ];
        $this->DepartmentModel->insert($data);
        $this->index();
    }

    public function show()
    {
        $id = $_GET['id'];
        $departments = $this->DepartmentModel->findById($id);
        var_dump($departments);
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->DepartmentModel->findById($id);
        $this->view('departments.edit', $data);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = [
            'departmentcode' => $_POST['departmentcode'],
            'departmentname' => $_POST['departmentname']
        ];
        $this->DepartmentModel->update($id, $data);
        $this->index();
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $this->DepartmentModel->delete($id);
        $this->index();
    }

}




?>