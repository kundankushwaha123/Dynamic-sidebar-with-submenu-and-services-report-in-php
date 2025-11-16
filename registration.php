<?php
require 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

    $name   = $_POST['Name'];
    $email  = $_POST['Email'];
    $phone  = $_POST['Phone'];
    $password = trim($_POST['Password']);

    // Password Validation
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W_]/', $password)
    ) {
        echo "<script>alert('Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.');
        window.location.href = window.location.href;</script>";
        exit;
    }

    // Check if email or phone already exists
    $stmt = $conn->prepare("SELECT id FROM assdt_users WHERE email_id = ? OR mobile_number = ?");
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email or Phone already registered.');
        window.location.href = window.location.href;</script>";
        exit;
    }

    // Insert WITHOUT hashing
    $stmt = $conn->prepare("INSERT INTO assdt_users 
        (full_name, email_id, mobile_number, password, created_on, is_active) 
        VALUES (?, ?, ?, ?, NOW(), 'ACTIVE')");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful. You can now log in.');
        window.location.href='login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error during registration. Please try again.');
        window.location.href = window.location.href;</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<head>
	<title>Registration Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/style-responsive.css" rel="stylesheet" />
	<!-- font CSS -->

	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
</head>

<body>
	<div class="reg-w3">
		<div class="w3layouts-main">
			<h2>Register Now</h2>
			<form action="" method="post">
				<input type="text" class="ggg" name="Name" placeholder="NAME" required="">
				<input type="email" class="ggg" name="Email" placeholder="E-MAIL" required="">
				<input type="text" class="ggg" name="Phone" placeholder="PHONE" required="">
				<input type="password" class="ggg" name="Password" placeholder="PASSWORD" required="">
				<h4><input type="checkbox" />I agree to the Terms of Service and Privacy Policy</h4>
				<div class="clearfix"></div>
				<input type="submit" value="submit" name="register">
			</form>
			<p>Already Registered.<a href="index.php">Login</a></p>
		</div>
	</div>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="js/scripts.js"></script>
	<!-- <script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<script src="js/jquery.scrollTo.js"></script> -->
</body>

</html>