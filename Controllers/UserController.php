<?php
include 'ImageResize.php';
class UserController extends BaseController
{
    private $UserModel;
    use \Gumlet\ImageResize;

    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->UserModel = new UserModel;
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
        if (isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $targetFile = 'Assets/uploads/'.$fileName;
            $resizeImage = 'Assets/uploads/resize_'.$fileName;
            if ($fileSize>0) {
                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $image = new ImageResize($targetFile);
                    $image->resize(300, 300);
                    $image->save($resizeImage);
                }
            }  
        }

        $data = [
            'employeecode' => $_POST['employeecode'],
            'fullname' => $_POST['fullname'],
            'password' => md5($_POST['password']),
            'departmentid' => $_POST['departmentid'],
            'avatar' => $fileName,
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