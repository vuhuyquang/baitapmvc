<?php

class UserController extends BaseController
{
    private $UserModel;

    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->UserModel = new UserModel;
        // session_start();
        // if (empty($_SESSION['role']) && empty($_SESSION['roleName'])) {
        //     header('Location: http://localhost/baitapmvc/index.php?controller=page&action=getlogin');
        // }
    }

    public function index()
    {
        if (isset($_GET['pages'])) {
            $pages = $_GET['pages'];
        } else {
            $pages = 1;
        }
        $countItem = $this->UserModel->count();
        foreach ($countItem as $key => $value) {
            $sumCount = $value['COUNT(id)'];
            $countPages = ceil($sumCount / 3);
        }

        $students = $this->UserModel->join('users', 'departments', 'departmentid', 'id', $pages);
        $this->loadModel('DepartmentModel');
        $this->DepartmentModel = new DepartmentModel;
        $departments = $this->DepartmentModel->get();
        $this->view('users.index', ['students' => $students, 'departments' => $departments, 'pages' => $countPages, 'pagesPresent' => $pages]);
    }

    public function create()
    {
        
    }

    public function resize_image($file, $max_resolution)
    {
        if (file_exits($file)) {
            $original_image = imagecreatefromjpeg($file);
            $original_width = imagesx($original_image);
            $original_height = imagesx($original_image);

            $ratio = $max_resolution / $original_width;
            $new_width = $max_resolution;
            $new_height = $original_height * $ratio;

            if ($new_height > $max_resolution) {
                $ratio = $max_resolution / $original_height;
                $new_height = $max_resolution;
                $new_width = $original_width * $ratio;
            }
        }
    }

    public function store()
    {
        // if (isset($_FILES['avatar']) && $_FILES['avatar']['type'] == 'image/jpeg') {
        //     move_uploaded_file($_FILES['avatar']['tmp_name'], $_FILES['avatar']['name']);
        //     $file = $_FILES['avatar']['name'];
        //     $this->resize_image($file, "300");
        //     echo $file;
        // }
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