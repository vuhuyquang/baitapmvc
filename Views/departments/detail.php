<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trang chủ</title>
        <link rel="icon" type="image/x-icon" href="https://tuyendung.rikkeisoft.com/favicon.ico">
        <style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Quicksand&display=swap');
*
{
	margin: 0;
	padding: 0;
	font-family: 'Open Sans', sans-serif;
	font-family: 'Quicksand', sans-serif;
}

	table {
		margin-top: 20px;
		width: 100%;
		text-align: center;
	}

	table th {
		background-color: #d55c32;
		height: 45px;
	}

	table td {
		background-color: #ffd4aa;
		height: 30px;
	}

	#top {
		height: auto;
		width: 100%;
		text-align: center;
	}

	#header {
		height: 30px;
		width: 100%;
		background-color: #b20000d4;
		text-align: right;
		right: 5px;
		color: white;
		line-height: 28px;
		letter-spacing: -1px;
	}

	#header a {
		text-decoration: none;
		color: white;
	}

	img {
		height: 80px;
		width: auto;
	}

	.heading {
		height: auto;
		width: 100%;
		font-size: 30px;
		text-align: center;
		padding-top: 40px;
		padding-bottom: 20px;
	}

	.btn-them {
		padding: 10px 12px;
		background-color: #28a745;
		color: white;
		border: 1px solid #28a745;
		border-radius: 5px;
		text-decoration: none;
		cursor: pointer;
	}

	.btn-them:hover {
		background-color: #228d3a;
	}

	i {
		color: black;
		font-size: 18px;
	}

	i:hover {
		opacity: 0.7;
	}

	a {
		text-decoration: none;
	}

	i:hover {
		opacity: 0.7;
	}

	table td:hover {
		background-color: #ffd4aacc;
	}

	.modal {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background-color: rgba(0, 0, 0, 0.7);
		display: none;
		align-items: center;
		justify-content: center;
	}

	.modal .modal-container {
		background-color: white;
		width: 54vw;
		position: relative;
		max-width: calc(100% - 32px);
		animation: kfmodal ease 0.5s;
	}

	.modal-header {
		background-color: #007696;
		height: 130px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 30px;
		color: white;
	}

	.body i {
		margin-right: 12px;
		font-size: 14px;
	}

	.modal-header i {
		color: white;
		font-weight: bold;
		margin-right: 16px;
		font-size: 24px;
	}

	.ti-close {
		position: absolute;
		right: 0;
		top: 0;
		color: white;
		padding: 12px;
		cursor: pointer;
		background-color: red;
		opacity: 0.8;
	}

	.ti-close:hover {
		opacity: 0.85;
	}

	.modal .body {
		padding: 16px 16px 16px 16px;
		padding-right: 38px;
	}

	.modal-label {
		display: block;
		font-size: 16px;
	}

	.modal-input {
		border: 1px solid #ccc;
		width: 100%;
		padding: 10px;
		font-size: 15px;
		margin-bottom: 24px;
		margin-top: 10px;
	}

	.modal-btn {
		background-color: #007696;
		border: none;
		color: white;
		width: 102.9%;
		font-size: 15px;
		text-transform: uppercase;
		padding: 18px;
		cursor: pointer;
	}

	.modal-btn:hover {
		opacity: 0.9;
	}

	button i {
		color: white;
		margin-left: 12px;
	}

	footer {
		text-align: right;
	}

	.open {
		display: flex;
	}

	@keyframes kfmodal {
		from {
			opacity: 0;
			transform: translateY(-150px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	select {
		border: 1px solid #ccc;
		width: 100%;
		padding: 10px;
		font-size: 15px;
		margin-bottom: 24px;
		margin-top: 10px;
	}
</style>
</head>
<body>
	<?php include('Views/layouts/header.php'); ?>
	<div class="heading">DANH SÁCH NHÂN VIÊN</div>
	<a class="js-add btn-them">Thêm mới khoa</a>
	<table>
		<tr>
			<th>STT</th>
			<th>Mã nhân viên</th>
			<th>Tên nhân viên</th>
            <th>Phòng ban</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
		<?php foreach ($students as $key => $student) :?>
		<tr>
			<td><?php echo($student['id']) ?></td>
			<td><?php echo $student['employeecode'] ?></td>
			<td><?php echo $student['fullname'] ?></td>
			<td><?php echo $student['departmentname'] ?></td>
			<td><a href="index.php?controller=user&action=edit&id=<?php echo $student['id'] ?>">Sửa</a></td>
			<td><a href="index.php?controller=user&action=destroy&id=<?php echo $student['id'] ?>">Xóa</a></td>
		</tr>
		<?php endforeach ?>
	</table>

	<div class="modal">
		<div class="modal-container">
			<div class="modal-close"><i class="ti-close"></i></div>
			<header class="modal-header"><i class="ti-bag"></i>THÊM MỚI NHÂN VIÊN</header>
			<div class="body">
				<form action="index.php?controller=user&action=store" method="POST">
				<label for="code" class="modal-label"><i class="ti-menu-alt"></i>Mã nhân viên</label>
				<input id="code" type="text" class="modal-input" name="employeecode" placeholder="Nhập mã nhân viên" required="" autocomplete="off">

				<label for="name" class="modal-label"><i class="ti-info"></i>Tên nhân viên</label>
				<input id="name" type="text" class="modal-input" name="fullname" placeholder="Nhập tên nhân viên" required="" autocomplete="off">

				<label for="name" class="modal-label"><i class="ti-info"></i>Mật khẩu</label>
				<input id="name" type="password" class="modal-input" name="password" placeholder="Nhập mật khẩu" required="" autocomplete="off">

				<label for="department" class="modal-label"><i class="ti-info"></i>Phòng ban</label>
				<select id="department" name="departmentid">
					<?php foreach ($departments as $key => $department): ?>
						<option value="<?php echo $department['id'] ?>"><?php echo $department['departmentname'] ?></option>
					<?php endforeach ?>
				</select>

				<label for="role" class="modal-label"><i class="ti-info"></i>Quyền</label>
				<select id="role" name="role">
						<option value="1">Nhân viên</option>
						<option value="2">Quản trị viên</option>
				</select>
				<button class="modal-btn">THÊM<i class="ti-check"></i></button>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const btnthem = document.querySelector('.js-add');
		const modal = document.querySelector('.modal');
		const btndong = document.querySelector('.modal-close');
		const formthem = document.querySelector('.modal-container');
		function hienthiform() {
			modal.classList.add('open');
		}
		function tatform() {
			modal.classList.remove('open');
		}
		btnthem.addEventListener('click', hienthiform);
		btndong.addEventListener('click', tatform);
		modal.addEventListener('click', tatform);
		formthem.addEventListener('click', function(event) {
			event.stopPropagation();
		});
	</script>
</body>
</html>