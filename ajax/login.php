<?php
include '../db/config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM assdt_users WHERE (email_id = '$username' OR mobile_number = '$username') AND is_active = 'ACTIVE'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['password']) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email_id'];
            $_SESSION['user_phone'] = $user['mobile_number'];

            $user_ip = $_SERVER['REMOTE_ADDR']; //store IP address in this variable

            mysqli_query($conn, "UPDATE assdt_users SET last_login_ip = '$user_ip' WHERE id = " . $user['id']);
            // Handle "Remember Me" functionality
            if (isset($_POST['remember'])) {
                setcookie('username', $username, time() + (86400 * 15), "/"); // 15days
            }

            echo 'success';
            exit;
        } else {
            echo 'Invalid password.';
            exit;
        }
    } else {
        echo 'User not found or inactive.';
        exit;
    }
}

