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
        $students = $this->UserModel->join('users', 'departments', 'departmentid', 'id');
        $this->loadModel('DepartmentModel');
        $this->DepartmentModel = new DepartmentModel;
        $departments = $this->DepartmentModel->get();
        $this->view('users.index', ['students' => $students, 'departments' => $departments]);
    }

    public function create()
    {
        
    }

    public function store()
    {
        $data = [
            'employeecode' => $_POST['employeecode'],
            'fullname' => $_POST['fullname'],
            'password' => md5($_POST['password']),
            'departmentid' => $_POST['departmentid'],
            'role' => $_POST['role']
        ];
        $this->UserModel->insert($data);
        $this->index();
    }

    public function show()
    {
        $id = $_GET['id'];
        $students = $this->UserModel->findById($id);
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = $this->UserModel->findById($id);
        $this->loadModel('DepartmentModel');
        $this->DepartmentModel = new DepartmentModel;
        $departments = $this->DepartmentModel->get();
        $newArray = array('student' => $data, 'departments' => $departments);
        $this->view('users.edit', $newArray);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = [
            'employeecode' => $_POST['employeecode'],
            'fullname' => $_POST['fullname'],
            'password' => md5($_POST['password']),
            'departmentid' => $_POST['departmentid'],
            'role' => $_POST['role']
        ];
        $this->UserModel->update($id, $data);
        $this->index();
    }

    public function destroy()
    {
        $id = $_GET['id'];
        $this->UserModel->delete($id);
        $this->index();
    }

}




?>